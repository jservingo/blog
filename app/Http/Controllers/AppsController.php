<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Kpost;
use App\Post;
use App\App;

class AppsController extends Controller
{
  public function show_created()
  {
  	$posts = Post 
  	  ::join('apps', 'ref_id', '=', 'apps.id')       
      ->where("apps.user_id","=",auth()->id())
      ->where("type_id","=",23)
      ->where("apps.parent_id","=",null)
      ->select('posts.*')
      ->latest('posts.created_at')
      ->paginate(12);

    $title = "Created apps";   
    $root = "created_apps";
    $buttons = "posts.buttons.created_apps"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));
  }

  public function show_app(App $app)
  {
    $apps = App
      ::where("parent_id","=",$app->id)
      ->get();

    if($app->name == "TVmaze")
    {
      $title = "App: $app->name";
      $buttons = ""; 
      $subtitle = "";
      $root = "app_api";
      return view('apps.show_app',compact(
        'app','title','root','buttons','subtitle'));
    }
    elseif(count($apps) > 0)
    {
			$posts = Post 
  	  ::join('apps', 'ref_id', '=', 'apps.id')       
      ->where("apps.user_id","=",auth()->id())
      ->where("type_id","=",23)
      ->where("apps.parent_id","=",$app->id)
      ->select('posts.*')
      ->latest('posts.created_at')
      ->paginate(12);

	    $title = "App: $app->name";   
	    $root = "app_subs";
	    $buttons = "posts.buttons.app_subs"; 
      $subtitle = "";

	    return view(get_view(),compact(
	      'posts','title','root','buttons','subtitle'));
	  }
	  else
	  {
			$posts = Post  
			::join('pages', 'ref_id', '=', 'pages.id')      
      ->where("type_id","=",22)
      ->where("pages.app_id","=",$app->id)
      ->select('posts.*')
      ->latest('posts.created_at')
      ->paginate(12);

	    $title = "App pages: $app->name";   
	    $root = "app_pages";
	    $buttons = "posts.buttons.app_subs"; 
      $subtitle = "";

	    return view(get_view(),compact(
	      'posts','title','root','buttons','subtitle'));
	  }     	
  }

  public function save_app_post(Request $request)
  {
    //Buscar post de la app
    $app_id = $request->get('app_id');
    $title = $request->get('title');
    $excerpt = $request->get('excerpt');
    $img = $request->get('img');
    $tags = $request->get('tags');
    $footnote = $request->get('footnote');
    $date = $request->get('date');
    $user = $request->get('user');
    $source = $request->get('source');
    $custom_type = $request->get('custom_type');

    $post = Post
      ::where("app_id","=",$app_id)
      ->where("source","=",$source)
      ->first();

    //Si el post no existe hay que crearlo
    //OJO El usuario debería ser el administrador de la App
    if (! $post)
    {
      $app = App::find($app_id);

      $post = Post::create([
        'title' => $title,
        'excerpt' => $excerpt,
        'body' => 'source:'.$source,
        'footnote' => $footnote,
        'type_id' => 27,
        'user_id' => $app->owner->id,
        'custom_type' => $custom_type,
        'app_id' => $app_id,
        'source' => $source,
        'published_at' => Carbon::now()
      ]);
    }

    $kpost = Kpost::create([
      'post_id' => $post->id,
      'user_id' => auth()->id(),
      'sent_by' => auth()->id(),
      'sent_at' => Carbon::now() 
    ]);

    echo json_encode(array('success'=>true,'post_id'=>$post->id));
  }
}
