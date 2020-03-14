<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function show(Tag $tag, Request $request){
    	//OJO AQUI FALTA MOSTRAR LOS POSTS ORDENADOS
    	$posts = $tag->posts()
    		->title($request->get('title'))
    		->paginate(12);

    	$title = "#$tag->name";
    	$root = "tag_posts";
    	$buttons = "posts.buttons.received_posts"; 
    	$subtitle = "";

    	return view(get_view(), compact('posts','title','root','buttons','subtitle'));
    }
}
