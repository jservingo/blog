<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artist;
use App\Post;

class ArtistsController extends Controller
{
  function generate_artists()
  {
    return;
    set_time_limit(36000);
    error_reporting(0);

    $fp = fopen("mbid/artists.txt", 'r');

    $i = 1;
    $fo = fopen("mbid/artists".$i.".txt", 'a');
  
    $j=0;
    while (!feof($fp)) 
    {
      $line = fgets($fp);
      if (strlen($line)>1)
      {
        $all = explode("\t",$line);
        fwrite($fo, $all[1]."\t".$all[2]."\n");
        $j=$j+1;
        if ($j>=15379)
        {
          $j=0;
          $i=$i+1;
          fclose($fo);
          $fo = fopen("mbid/artists".$i.".txt", 'a');
        }
      }  
    }
    fclose($fp);
    fclose($fo);
  }

  function create_artists($i)
  {
    return;
    set_time_limit(36000);
    error_reporting(0);

    $fp = fopen("mbid/artists".$i.".txt", 'r');

    while (!feof($fp)) {
      $line = fgets($fp);
      $all = explode("\t",$line);
      $artist = Artist::firstOrCreate([
        'mbid' => $all[0],
        'name' => $all[1]
      ]);
    }
  }

  //******************************************************************

  function create_posts()
  {
    $artists = Artist
      ::where('artists.status_id', '=', '1')
      ->get();

    $api_key = "8fcc4758809b19662cdb6fab49ff689b";
    $custom_type = "Artist";
    $app_id = 4;
    $num = 0;

    foreach($artists as $artist) {    
     if ($num <= 10)
     {  
      $mbid = $artist->mbid;
      $title = $artist->name;
      $img = "/img/music.png";
      $source = $artist->url;
      $url_image = "";
      $links = "";
      $tags = "Music";
      $footnote = "";
      $url_artist = 'http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&mbid='+mbid+'&api_key='+api_key;
      $xml = simplexml_load_file($url_artist);
      $excerpt = $xml->{'artist'}->{'bio'}->{'summary'};
      $url = $xml->{'artist'}->{'bio'};
      $body = $xml->{'artist'}->{'content'};
      $url = $xml->{'artist'}->{'bio'};
      $tags_artist = $xml->{'artist'}->{'tags'};
      foreach($tags_artist->children() as $tag) {
        $tags = $tags.",".$tag->name;
      } 
      $url_artist = "http://musicbrainz.org/ws/2/artist/".$mbid."?inc=url-rels";
      $xml = simplexml_load_file($url_artist);
      $links_artist = $xml->{'artist'}->{'relation-list'};
      foreach($links_artist->children() as $link) {
        $links = $links."<a href='".$link->attributes()->{'type'}."' target='_blank'>".$link->target."</a> ";
        if ($link->attributes()->{'type'} == "image")
          $url_image = $link->{'target'}; 
      }
      if ($url_image != "")
        $img = getImage($url_image);

      //Buscar post de la app
      $post = Post
        ::where("app_id","=",$app_id)
        ->where("source","=",$source)
        ->first();

      //Buscar el owner de la app
      $app = App::find($app_id);

      //Si el post no existe hay que crearlo
      //OJO El usuario debería ser el administrador de la App
      if (! $post)
      { 
        $post = Post::create([
          'title' => $title,
          'excerpt' => $excerpt,
          'body' => '<a href="'.$source.'" target=_blank">'.$body.'<br><br>'.$links.'</a>',        
          'footnote' => $footnote,
          'links' => $links,
          'type_id' => 8,
          'user_id' => $app->user_id,
          'custom_type' => $custom_type,
          'app_id' => $app_id,
          'source' => $source,
          'published_at' => Carbon::now('UTC')
        ]);

        Photo::create([
          'url' => $img,
          'post_id' => $post->id,
          'user_id' => $app->user_id
        ]);

        //Eliminar tags del post
        $post->tags()
          ->wherePivot('post_id', '=', $post->id)
          ->wherePivot('user_id', '=', $app->user_id)
          ->detach();
        
        //Agregar tags al post
        $tags = explode(',',$tags);
        if(!empty($tags))
        {
          foreach ($tags as $tag_str)
          {
            if (strlen($tag_str) >= 3)
            {
              $tag_str = trim(preg_replace('/\s+/', '', $tag_str));
              $tag = Tag::where('name', $tag_str)->first();
              if($tag)
                $post->tags()->attach($tag->id, array('user_id' => $app->user_id));
              else
              {
                $tag = Tag::create([
                  'name' => $tag_str
                ]);
                $post->tags()->attach($tag->id, array('user_id' => $app->user_id));
              }
            }
          }
        }

        $kpost = Kpost::create([
          'post_id' => $post->id,
          'user_id' => $app->user_id,
          'sent_by' => $app->user_id,
          'sent_at' => Carbon::now('UTC') 
        ]);

        $num = $num + 1;
      }
      
      if (!$post->kpost)
      {
        $kpost = Kpost::create([
          'post_id' => $post->id,
          'status_id' => 2,
          'user_id' => auth()->id(),
          'sent_by' => auth()->id(),
          'sent_at' => Carbon::now('UTC') 
        ]);
      }
     }      
    }
  }      
  
  public function generate_top_artists($page)
  {
    $fp = fopen("topArtists/topArtists_".$page.".txt", 'w');

    $xml = simplexml_load_file("http://ws.audioscrobbler.com/2.0/?method=chart.gettopartists&page=".$page."&api_key=803afb32787f065f4facd38eebe3af52");
    $items = $xml->{'artists'}->{'artist'};

    foreach($items as $artist)
    {
      $element = $artist->mbid;
      $isEmpty = !count($element->xpath('(.)[./node()|./@*]'));
      if($isEmpty) {
        fwrite($fp, "not found".",".$artist->name."\n");
      }
      else {      
        fwrite($fp, $artist->mbid.",".$artist->name."\n");
      }
    }

    fclose($fp);

    return("Done generate page ".$page);
  }

  public function validate_top_artists($page)
  {
    $file = "topArtists/topArtists_".$page.".txt";
    $fp = fopen($file,'r');
    
    $not_found = 0;
    $validated = 0;
    $revalidated = 0;
    $created = 0;
    
    while ($line = fgets($fp)) {
      $item = explode(',', $line);
      $mbid = $item[0];
      $name = $item[1];
      if ($mbid == "not found") {
        $not_found = $not_found + 1;
      }
      else
      {
        //Buscar mbid en BD de artists
        $artist = Artist
          ::where('mbid', '=', $mbid) 
          ->first();  
        if ($artist)
        {
          if ($artist->status_id == 0)
          {  
            $artist->status_id = 1;
            $artist->save();
            $validated = $validated + 1;
          }
          else
          {
            $revalidated = $revalidated + 1;
          }
        }
        else 
        {
          $artist = Artist::firstOrCreate([
            'mbid' => $mbid,
            'name' => $name,
            'status_id' => 1
          ]);
          $created = $created + 1;
        }
      }     
    }

    fclose($fp);

    return("Done validate page ".$page." not_found:".$not_found." validated:".$validated." revalidated:".$revalidated." created:".$created); 
  }

  public function view_top_artists($page)
  {
    // NO SE USA
    // FALTA guardar la salida y generar el archivo de salida
    $file = "topArtists/topArtists_".$page.".txt";
    $fp = fopen($file,'r');
    
    $resp = "";
    while ($line = fgets($fp)) {
       $artist = explode(',', $line);
       $mbid = $artist[0];
       $name = $artist[1];
       $resp = $resp."mbid:".$mbid. " name:".$name."<BR>";
    }

    fclose($fp);

    //$content = \View::make('resp')->with('resp', $resp);
    //return \Response::make($content, '200')->header('Content-Type', 'plain/txt');

    return view('resp',compact('page','resp'));
  }

  //******************************************************************

  function get_all()
  {
    // ESTO YA NO SE USA (ELIMINAR)
  	$artists = Post
      ::where("type_id","=",8)
      ->where("app_id","=",4)
      ->where("user_id","=",10)     
      ->orderBy('updated_at', 'DESC')
      ->limit(100)
      ->get();

    echo json_encode($artists);
  }

  function get_image(Request $request)
  {
    $url_image = $request->get('url_image');
    $src = "/img/music.png";    
    $doc = new \DOMDocument();
    @$doc->loadHTMLFile($url_image);
    if ($doc)
    {  
      $xpath = new \DOMXpath($doc);
      if ($xpath)
      {
        $imgs = $xpath->query("//img");
        if ($imgs)
        {
          $img = $imgs->item(0);
          if ($img)
            $src = $img->getAttribute("src");        
        }
      }
    }
    echo json_encode($src);
  }

  function getImage(Request $request)
  {
    $url_image = $request->get('url_image');
    $src = "/img/music.png";    
    $doc = new \DOMDocument();
    @$doc->loadHTMLFile($url_image);
    if ($doc)
    {  
      $xpath = new \DOMXpath($doc);
      if ($xpath)
      {
        $imgs = $xpath->query("//img");
        if ($imgs)
        {
          $img = $imgs->item(0);
          if ($img)
            $src = $img->getAttribute("src");        
        }
      }
    }
    return($src);
  }

  public function show_post($mbid)
  {
    //Mostrar post en una ventana popup
    return view('apps.show_post_LastFm',[
      'mbid' => $mbid,
    ]);
  }

  function search($q)
  {
    $artists = Artist
      ::leftjoin('posts', 'artists.post_id', '=', 'posts.id')
      ->leftjoin('photos', 'artists.post_id', '=', 'photos.post_id')
      ->where('artists.name', 'like', $q.'%')  //like $q.'%'
      ->where('artists.status_id', '<>', '0')
      ->orderBy('artists.name')
      ->get();

    /*
    if (auth()->id() == 10)
    {
      //Search all records
    }
    else
    {
      $artists = Artist
        ::leftjoin('posts', 'artists.post_id', '=', 'posts.id')
        ->leftjoin('photos', 'artists.post_id', '=', 'photos.post_id')
        ->where('name', 'like', $q.'%')  //like $q.'%'
        ->where('status_id', '=', 2) //Saved
        ->orderBy('artists.name')
        ->get();
    }
    */

    echo json_encode($artists);
  }

  public function save_post(Request $request)
  {
    /*
    if (auth()->id() != 10)
    {
      echo json_encode(array('success'=>false,'msg'=>'Ud. no está autorizado para realizar esta operación.'));
      return;
    }
    */
    
    $artist = Artist
      ::where("mbid","=",$request->get('mbid'))
      ->first();

    $artist->status_id = 2;
    $artist->post_id = $request->get('post_id');
    $artist->save();

    echo json_encode(array('success'=>true));
  }

  public function destroy($mbid)
  {
    //$this->authorize('delete',$post);

    if (auth()->id() != 10)
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;
    }

    $artist = Artist
      ::where("mbid","=",$mbid)
      ->first();

    $artist->status_id = 1;
    $artist->save();

    //$artist->delete();

    echo json_encode(array('success'=>true));  
  }  
}
