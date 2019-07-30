<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Kpost;
use App\Post;
use App\App;

class AppsController extends Controller
{
  public function discover()
  {
    $posts = Post 
      ::join('apps', 'ref_id', '=', 'apps.id')       
      ->where("apps.user_id","<>",auth()->id())
      ->where("type_id","=",23)
      ->where("apps.parent_id","=",null)
      ->whereNotIn('apps.id', function($query)
        {
          $query->select('app_id')
                ->from('app_user')
                ->where('user_id','=',auth()->id());
        })
      ->select('posts.*')
      ->latest('posts.created_at')
      ->paginate(12);

    $title = "Discover apps";   
    $root = "discover_apps";
    $buttons = "posts.buttons.discover_apps"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));
  }

  public function show_all()
  {
    $posts_created = Post 
      ::join('apps', 'ref_id', '=', 'apps.id')       
      ->where("apps.user_id","=",auth()->id())
      ->where("type_id","=",23)
      ->where("apps.parent_id","=",null)
      ->select('posts.*')
      ->latest('posts.created_at');

    $posts_subscriptions = Post
      ::join('apps', 'ref_id', '=', 'apps.id')
      ->join('app_user', 'apps.id', '=', 'app_user.app_id')
      ->where("type_id","=",23)
      ->where("app_user.user_id","=",auth()->id())
      ->where("apps.parent_id","=",null)
      ->orderBy('apps.name', 'asc')
      ->select('posts.*');

    $posts_created->union($posts_subscriptions);
    $querySql = $posts_created->toSql();

    $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts_created->getBindings());
    $posts = $query->paginate(12); 

    $title = "Apps";   
    $root = "created_apps";
    $buttons = "posts.buttons.created_apps"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));
  }

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
      $title = $app->name;
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
      ->where("type_id","=",23)
      ->where("apps.parent_id","=",$app->id)
      ->select('posts.*')
      ->latest('posts.created_at')
      ->paginate(12);

	    $title = $app->name;   
	    $root = "app_subs";
	    $buttons = "posts.buttons.app_subs"; 
      $subtitle = "";

	    return view(get_view(),compact(
	      'posts','title','root','buttons','subtitle','app'));
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

	    $title = $app->name;   
	    $root = "app_pages";
	    $buttons = "posts.buttons.app_subs"; 
      $subtitle = "";

	    return view(get_view(),compact(
	      'posts','title','root','buttons','subtitle','app'));
	  }     	
  }

  public function show_subscribers(App $app)
  {
    $posts = Post
      ::join('app_user', 'posts.user_id', '=', 'app_user.user_id')
      ->where("app_user.app_id","=",$app->id)
      ->where("type_id","=",24)
      ->select('posts.*')
      ->latest('app_user.created_at')
      ->paginate(12);  

    $title = "$app->name subscribers";
    $root = "app_subscribers";
    $buttons = "posts.buttons.app_subscribers";
    $subtitle = "";     

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
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
        'user_id' => $app->user_id,
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
