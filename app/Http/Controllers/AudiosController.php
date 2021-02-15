<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
    $this->validate($request, [
      'description' => 'required'
    ]);

    if ($request->filled('position'))
      $position = $request->get('position');
    else 
      $position = 0;

  	Audio::create([
  		'description' => $request->get('description'),
  		'position' => $position,
      'url' => '',
  		'post_id' => $post->id,
      'user_id' => auth()->id()
  	]);

  	echo json_encode(array('success'=>true));
  }

  public function update(Audio $audio, Request $request)
  {
    //$this->authorize('update',$post);
    
    if ($request->filled('description'))
      $audio->description = $request->get('description');
    if ($request->filled('position'))
      $audio->position = $request->get('position');
    $audio->save();

    echo json_encode(array('success'=>true));
  }

  public function upload(Request $request)
  {
    /*
    $this->validate($request, [
      'audio' =>'nullable|mimes:audio/mpeg,mpga,mp3,wav,aac,ogg'
    ]);
    */

    $audio = Audio::find($request->get('audio_id'));

    if($request->hasFile('audio')){
      $file = $request->file('audio');
      $name = $file->getClientOriginalName();      
      $size = $file->getSize();
      $extension = $file->getClientOriginalExtension();
      $filename = $audio->post->id.'_'.$audio->id.'_'.$name.$extension;
      $path = $file->storeAs('public/posts/', $filename);
      $audio->url = $filename;
      $audio->save();     
    }

    return back()->with('flash','Uploaded audio');
  }

  public function destroy(Audio $audio)
  {
      $audio->delete();
      
      Storage::disk('public')->delete($audio->url);

      echo json_encode(array('success'=>true));
  }
}
