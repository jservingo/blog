<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Redirect;

class HomeController extends Controller
{
	public function index(Request $request)
  {
		// Verificamos que el usuario no esta autenticado
		if (Auth::check())
		{
		    // Si esta autenticado lo mandamos al home.
		    return view('home.main');
		}	
    $mode = $request->has('register') ? 'register' : 'login';
	  return view('home.show',compact('mode'));
  }

  public function login()
  {
    // Verificamos que el usuario no esta autenticado
    if (Auth::check())
    {
        // Si esta autenticado lo mandamos al home.
        return view('home.main');
    } 
    $mode = 'login';
    return view('home.show',compact('mode'));
  }

  public function register()
  {
    // Verificamos que el usuario no esta autenticado
    if (Auth::check())
    {
        // Si esta autenticado lo mandamos al home.
        return view('home.main');
    } 
    $mode = 'register';
    return view('home.show',compact('mode'));
  }

  public function set_message(Request $request)
  {
  	$type = $request->get('type');
  	$message = $request->get('message');

  	//Session::set('msg_type', $type);
  	\Session::flash('msgtype', $type);
  	\Session::flash('message', $message);

  	echo json_encode(array('success'=>true));
  }

  public function set_view(Request $request)
  {
    $view = $request->get('view');
    $root = $request->get('root');
    session(['view_'.$root => $view]);
    
    echo json_encode(array('success'=>true));
  }
}
