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
      ->where('name', '=', $q)  //like $q.'%'
      ->orderBy('artists.updated_at', 'DESC')
      ->get();

    echo json_encode($artists);
  }

  public function destroy($mbid)
  {
    //$this->authorize('delete',$post);

    if (auth()->id() != 10)
    {
      echo json_encode(array('success'=>false,'msg'=>'Ud. no está autorizado para realizar esta operación.'));
      return;
    }

    $artist = Artist
      ::where("mbid","=",$mbid)
      ->first();

    $artist->delete();

    echo json_encode(array('success'=>true));  
  }  
}
