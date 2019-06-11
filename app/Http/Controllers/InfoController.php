<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class InfoController extends Controller
{
    public function home()
    {
    	$posts = Post::published()->paginate();
    	return view('info.show', compact('posts'));
    }

    public function about()
    {
    	return view('info.about');
    }

    public function archive()
    {
    	return view('info.archive');
    }

    public function contact()
    {
    	return view('info.contact');
    }
}
