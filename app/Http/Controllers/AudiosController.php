<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Audio;
use App\Post;

class AudiosController extends Controller
{
  public function get_audios(Post $post)
  { 
  	$result = array();

  	$total = Audio
      ::where("post_id","=",$post->id)
      ->count();
    $result["total"] = $total;

    $audios = Audio
      ::where("post_id","=",$post->id)
      ->orderBy('position')
      ->latest('created_at')
      ->get();
    $result["rows"] = $audios;

    return $result;
  }

  public function store(Post $post, Request $request) 
  {
  	/*
  	$this->validate(request(), [
  		'photo'=>'required|image|max:3072'
  	]);
  	*/

    //date('mdYHis').uniqid().
    //->store('posts','public')
  	Audio::create([
  		'url' => request()->file('url'),
  		'description' => request()->get('description'),
  		'position' => request()->get('position'),
  		'post_id' => $post->id,
      'user_id' => auth()->id()
  	]);

  	echo json_encode(array('success'=>true));
  }

  public function update(Audio $audio, Request $request)
  {
    //$this->authorize('update',$post);

    //Validación del post
    $this->validate($request, [
        'url' => 'required',
        'description' => 'required',
        'position' => 'required'
        ]);

    $audio->description = $request->get('description');
    $audio->position = $request->get('position');
    $audio->save();

    echo json_encode(array('success'=>true));
  }

  public function destroy(Audio $audio)
  {
      $audio->delete();
      
      Storage::disk('public')->delete($audio->url);

      echo json_encode(array('success'=>true));
  }
}
