<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;

class TypesController extends Controller
{
    public function show(Type $type, Request $request){
    	//OJO AQUI FALTA MOSTRAR LOS POSTS ORDENADOS
    	$posts = $type->posts()
    		->title($request->get('title'))
    		->paginate(12);

    	$title = $type->name;
    	$root = "type_posts";
    	$buttons = "posts.undefined"; 
    	$subtitle = "";

    	return view(get_view(), compact('posts','title','root','buttons','subtitle'));
    }
}
