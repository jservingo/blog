<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;

class TypesController extends Controller
{
    public function show(Type $type){
    	$posts = $type->posts()->paginate(12);

    	$title = $type->name;
    	$root = "type_posts";
    	$buttons = "posts.undefined"; 
    	$subtitle = "";

    	return view(get_view(), compact('posts','title','root','buttons','subtitle'));
    }
}
