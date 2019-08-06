<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Photo;
use App\Post;

class PhotosController extends Controller
{
    public function store(Post $post) 
    {
    	$this->validate(request(), [
    		'photo'=>'required|image|max:3072'
    	]);

    	Photo::create([
    		'url' => request()->file('photo')->store('posts','public'),
    		'post_id' => $post->id,
            'user_id' => auth()->id()
    	]);
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
        
        Storage::disk('public')->delete($photo->url);

        return back()->with('flash','Foto eliminada');
    }
}
