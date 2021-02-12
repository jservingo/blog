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
  	/*
  	$this->validate(request(), [
  		'photo'=>'required|image|max:3072'
  	]);
  	*/

    //Validación del audio
    /*
    $this->validate($request, [
      'description' => 'required',
      'audio' =>'nullable|mimes:audio/mpeg,mpga,mp3,wav,aac,ogg'
    ]);
    */

    if ($request->filled('url'))
      $filename = $request->get('url');
    else 
      $filename = "";

    if ($request->filled('position'))
      $position = $request->get('position');
    else 
      $position = 0;

    if($request->hasFile('audio')){
      $faudio = $request->file('audio');
      //$original_name = $audio->getClientOriginalName();
      //$size = $audio->getSize();
      $extension = $faudio->getClientOriginalExtension();
      $filename = $post->id.'_'.Carbon::now()->format('Ymd').'_'.$rand().'.'.$extension;
      //$filename = $request->file('audio')->store('posts','public');
      $faudio->move(public_path('posts'), $filename);
    }

  	Audio::create([
  		'description' => $request->get('description'),
  		'position' => $position,
      'url' => $filename,
  		'post_id' => $post->id,
      'user_id' => auth()->id()
  	]);

  	echo json_encode(array('success'=>true));
  }

  public function update(Audio $audio, Request $request)
  {
    //$this->authorize('update',$post);

    //Validación del audio
    /*
    $this->validate($request, [
      'audio' =>'nullable|mimes:audio/mpeg,mpga,mp3,wav,aac,ogg'
    ]);
    */

    if ($request->filled('url'))
      $filename = $request->get('url');
    else 
      $filename = "";

    if($request->hasFile('audio')){
      $faudio = $request->file('audio');
      //$original_name = $request->file('audio')->getClientOriginalName();
      //$size = $request->file('audio')->getSize();
      $extension = $faudio->getClientOriginalExtension();
      $filename = $faudio->post_id.'_'.Carbon::now()->format('Ymd').'_'.$rand().'.'.$extension;
      //$filename = $request->file('audio')->store('posts','public');
      $faudio->move(public_path('posts'), $filename);
    }

    if ($request->filled('description'))
      $audio->description = $request->get('description');
    if ($request->filled('position'))
      $audio->position = $request->get('position');
    $audio->url = $filename;
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
