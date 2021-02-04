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
    $this->validate($request, [
      'description' => 'nullable',
      'position' => 'required',
      'audio' =>'nullable|file|mimes:audio/mpeg,mpga,mp3,wav,aac,ogg'
    ]);

    $filename = "";

    if($request->hasFile('audio')){
      $uniqueid = uniqid();
      //$original_name = $request->file('audio')->getClientOriginalName();
      //$size = $request->file('audio')->getSize();
      $extension = $request->file('audio')->getClientOriginalExtension();
      $filename = $post->id.'_'.Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
      //$audiopath = url('/storage/upload/files/audio/'.$filename);
      $path = $request->file('audio')->storeAs('public/posts/',$filename);
      //$all_audios = $audiopath;
    }

  	Audio::create([
  		'description' => request()->get('description'),
  		'position' => request()->get('position'),
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
    $this->validate($request, [
      'description' => 'required',
      'position' => 'required',
      'audio' =>'nullable|file|mimes:audio/mpeg,mpga,mp3,wav,aac,ogg'
    ]);

    $filename = "";

    if($request->hasFile('audio')){
      $uniqueid = uniqid();
      //$original_name = $request->file('audio')->getClientOriginalName();
      //$size = $request->file('audio')->getSize();
      $extension = $request->file('audio')->getClientOriginalExtension();
      $filename = $audio->post_id.'_'.Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
      //$audiopath = url('/storage/upload/files/audio/'.$filename);
      //$path = $request->file('audio')->storeAs('public/posts/',$filename);
      //$all_audios = $audiopath;
    }

    $audio->description = $request->get('description');
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
