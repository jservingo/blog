<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function show(Tag $tag){
    	$posts = $tag->posts()->paginate(12);

    	$title = "Avisos del tag #$tag->name";
    	$root = "tag_posts";
    	$buttons = "posts.buttons.received_posts"; 
    	$subtitle = "";

    	return view(get_view(), compact('posts','title','root','buttons','subtitle'));
    }
}
