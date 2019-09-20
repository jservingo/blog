<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artist;
use App\Post;

class ArtistsController extends Controller
{
  function generate_artists()
  {
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
  	$artists = Post
      ::where("type_id","=",8)
      ->where("app_id","=",4)
      ->where("user_id","=",10)     
      ->orderBy('updated_at', 'DESC')
      ->limit(100)
      ->get();

    echo json_encode($artists);
  }

  function search($q)
  {
    $artists = Artist
      ::leftjoin('posts', 'artists.post_id', '=', 'posts.id')
      ->where('name', 'like', $q.'%')
      ->orderBy('artists.updated_at', 'DESC')
      ->get();

    echo json_encode($artists);
  }
}
