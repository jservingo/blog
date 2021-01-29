<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonetsysController extends Controller
{
		public function index()
    {
    	return view('konetsys.show');
    }	
    
    public function about()
    {
    	return view('konetsys.about');
    }

    public function support()
    {
    	return view('konetsys.support');
    }

    public function contact()
    {
    	return view('konetsys.contact');
    }
}
