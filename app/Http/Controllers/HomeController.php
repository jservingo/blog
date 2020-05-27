<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App as Kapp;
use App\Contact;
use App\Catalog;
use App\Kpost;
use App\Page;
use App\Post;
use App\Type;
use App\User;
use Redirect;
use App\App;
use App\Tag;
use App\Ad;

class HomeController extends Controller
{
	public function index(Request $request)
  {
		// Verificamos que el usuario no esta autenticado
		if (Auth::check())
		{
		    // Si esta autenticado lo mandamos al home.
		    return view('home.show');
		}	
    $mode = $request->has('register') ? 'register' : 'login';
	  return view('home.show_login',compact('mode'));
  }

  public function login()
  {
    // Verificamos que el usuario no esta autenticado
    if (Auth::check())
    {
        // Si esta autenticado lo mandamos al home.
        return view('home.show');
    } 
    $mode = 'login';
    return view('home.show_login',compact('mode'));
  }

  public function register()
  {
    // Verificamos que el usuario no esta autenticado
    if (Auth::check())
    {
        // Si esta autenticado lo mandamos al home.
        return view('home.show');
    } 
    $mode = 'register';
    return view('home.show_login',compact('mode'));
  }

  public function change_language(Request $request)
  {
    $lang = $request->get('lang');
    Kapp::setLocale($lang);

    //Save language
    $user = auth()->user();
    $user->language = $lang;
    $user->save();

    session()->put('locale', $lang);
    return redirect()->back();
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

  // Show

  public function show_recommendations(Request $request)
  {
    $posts_pages = Post
      ::where("user_id","<>",auth()->id())
      ->where("type_id","=",22)  
      ->title($request->get('title'))  
      ->published()  
      ->whereNotIn('ref_id', function($query)
        {
          $query->select('page_id')
                ->from('page_user')
                ->where('user_id','=',auth()->id());
        })
      ->select('posts.*');

    $posts_apps = Post 
      ::join('apps', 'ref_id', '=', 'apps.id')       
      ->where("apps.user_id","<>",auth()->id())
      ->where("type_id","=",23)
      ->where("apps.parent_id","=",null)
      ->title($request->get('title'))
      ->published()
      ->whereNotIn('apps.id', function($query)
        {
          $query->select('app_id')
                ->from('app_user')
                ->where('user_id','=',auth()->id());
        })
      ->select('posts.*');

    $posts_apps->union($posts_pages);
    $querySql = $posts_apps->toSql();

    $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts_apps->getBindings());
    $posts = $query->latest('published_at')->paginate(12); 

    $title = __('messages.recommendations');
    $root = 'received_posts';
    $buttons = "posts.buttons.received_posts";
    $subtitle = "";

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_offers(Request $request)
  {
    $posts = Post
      //::join('kposts', 'posts.id', '=', 'kposts.post_id')
      //->where("status_id","=",0)
      ::where("type_id", "=", 7)
      ->where("user_id","<>",auth()->id()) 
      ->title($request->get('title'))   
      ->published()  
      ->latest('published_at')
      ->paginate(12); 

    $title = __('messages.offers');
    $root = 'received_posts';
    $buttons = "posts.buttons.received_posts";
    $subtitle = "";

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_favorites(Request $request)
  {
    $posts = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("kposts.featured", "=", 1)
      ->where("kposts.user_id","=",auth()->id())
      ->published()
      ->hide()
      ->title($request->get('title'))
      ->latest('published_at')
      ->select('posts.*','kposts.featured')
      ->paginate(12); 

    $title = __('messages.favorites');
    $root = 'received_posts';
    $buttons = "posts.buttons.received_posts";
    $subtitle = "";

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_most_viewed(Request $request)
  {
    $posts = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("kposts.views",">",0)
      ->where("kposts.user_id","=",auth()->id())
      ->published()
      ->hide()
      ->title($request->get('title'))
      ->orderBy('kposts.views', 'DESC')  
      ->select('posts.*')      
      ->paginate(12); 

    $result['rows'] = $posts;

    $title = __('messages.most-viewed');
    $root = 'received_posts';
    $buttons = "posts.buttons.received_posts";
    $subtitle = "";

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_recent_views()
  {   
    $user = auth()->user();

    $recentviews = $user->recentviews; 
    $recent = explode(',',$recentviews);

    $posts = Post
      ::whereIn('id', $recent)
      ->orderByRaw(\DB::raw("FIELD(id, ".$recentviews.")"))
      ->paginate(12);

    $title = __('messages.recently-viewed');
    $root = "created_posts";
    $buttons = "posts.buttons.created_posts"; 
    $subtitle = "";    

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  //Gets 

  public function get_recent_views()
  {   
    $user = auth()->user();

    $recentviews = $user->recentviews; 
    $recent = explode(',',$recentviews);

    $posts = Post::with('owner')        
      ->whereIn('id', $recent)
      ->orderByRaw(\DB::raw("FIELD(id, ".$recentviews.")"))
      ->limit(100)
      ->get();

    $result['rows'] = $posts;

    echo json_encode($result);
  }

  public function get_recommendations()
  {
    $posts_pages = Post
      ::where("user_id","<>",auth()->id())
      ->where("type_id","=",22) 
      ->published()     
      ->whereNotIn('ref_id', function($query)
        {
          $query->select('page_id')
                ->from('page_user')
                ->where('user_id','=',auth()->id());
        })
      ->latest('published_at');

    $posts_apps = Post 
      ::join('apps', 'ref_id', '=', 'apps.id')       
      ->where("apps.user_id","<>",auth()->id())
      ->where("type_id","=",23)
      ->where("apps.parent_id","=",null)
      ->published()
      ->whereNotIn('apps.id', function($query)
        {
          $query->select('app_id')
                ->from('app_user')
                ->where('user_id','=',auth()->id());
        })
      ->select('posts.*')
      ->latest('posts.published_at');

    $posts_apps->union($posts_pages);
    $querySql = $posts_apps->toSql();

    $query = Post::with('owner')->from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts_apps->getBindings());
    $posts = $query->latest('published_at')->get(); 

    $result['rows'] = $posts;

    echo json_encode($result);
  }

  public function get_offers()
  { 
    $posts = Post::with('owner')
      //->join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("type_id","=",7)
      ->where("user_id","<>",auth()->id())
      ->published()
      ->latest('published_at')
      ->limit(100)
      ->get(); 

    $result['rows'] = $posts;

    echo json_encode($result);
  }

  public function get_alerts()
  { 
    $posts = Post::with('owner')
      ->join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where(function ($query) {
          $query->where("status_id","=",0)
            ->where("kposts.user_id","=",auth()->id())
            ->where("kposts.sent_by","<>",auth()->id())
            ->where("posts.type_id", "=", 4)
            ->published()
            ->hide();
      })->orWhere(function ($query) {
          $query->where("status_id","=",0)
            ->where("kposts.user_id","=",auth()->id())
            ->where("kposts.sent_by","<>",auth()->id())
            ->where("posts.type_id", "=", 6)
            ->published()
            ->hide();
      })
      ->latest('posts.published_at')
      ->select('posts.*')
      ->limit(100)
      ->get();

    $result['rows'] = $posts;

    echo json_encode($result);
  }

  public function get_random_offers($num)
  { 
    $posts = Post::with('owner')
      //->join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("type_id","=",7)
      ->where("user_id","<>",auth()->id())
      ->published()
      ->inRandomOrder()
      ->limit($num)
      ->get(); 

    $result['rows'] = $posts;

    echo json_encode($result);
  }

  public function get_favorites()
  { 
    $posts = Post::with('owner')
      ->join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("kposts.featured", "=", 1)
      ->where("kposts.user_id","=",auth()->id())
      ->published()
      ->hide()
      ->latest('published_at')
      ->select('posts.*')      
      ->limit(100)
      ->get(); 

    $result['rows'] = $posts;

    echo json_encode($result);
  }

  public function get_most_viewed()
  { 
    $posts = Post::with('owner')
      ->join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("kposts.views",">",0)
      ->where("kposts.user_id","=",auth()->id())
      ->published()
      ->hide()
      ->orderBy('kposts.views', 'DESC')
      ->select('posts.*')
      ->limit(100)
      ->get();

    $result['rows'] = $posts;

    echo json_encode($result); 
  }

  public function get_user_stats()
  { 
    $received = Kpost
      ::where("status_id","=",0)
      ->where("user_id","=",auth()->id())
      ->where("kposts.sent_by","<>",auth()->id())
      ->count();

    $notifications = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("status_id","=",0)
      ->where("kposts.user_id","=",auth()->id())
      ->where("kposts.sent_by","<>",auth()->id())
      ->where("posts.type_id", "=", 4)
      ->published()
      ->hide()
      ->count();

    $alerts = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("status_id","=",0)
      ->where("kposts.user_id","=",auth()->id())
      ->where("kposts.sent_by","<>",auth()->id())
      ->where("posts.type_id", "=", 6)
      ->published()
      ->hide()
      ->count();

    $contacts = Contact
      ::where("user_id","=",auth()->id())
      ->count();

    $apps = App
      ::where("user_id","=",auth()->id())
      ->where("parent_id","=",null)
      ->count(); 

    $pages = Page
      ::where("user_id","=",auth()->id())
      ->count(); 

    $catalogs = Catalog
      ::where("user_id","=",auth()->id())
      ->count(); 

    $posts = Post
      ::where("user_id","=",auth()->id())
      ->where("type_id","<=",20)
      ->published()
      ->count(); 

    $apps_subscriptions = App
      ::join('app_user', 'apps.id', '=', 'app_user.app_id')
      ->where("app_user.user_id","=",auth()->id())
      ->where("parent_id","=",null)
      ->count();

    $pages_subscriptions = Page
      ::join('page_user', 'pages.id', '=', 'page_user.page_id')
      ->where("page_user.user_id","=",auth()->id())
      ->count();

    $result = array("received"=>$received, 
                    "notifications"=>$notifications,
                    "alerts"=>$alerts,   
                    "contacts"=>$contacts,
                    "apps"=>$apps,
                    "pages"=>$pages,
                    "catalogs"=>$catalogs,
                    "posts"=>$posts,
                    "apps_subscriptions"=>$apps_subscriptions,
                    "pages_subscriptions"=>$pages_subscriptions                    
                    ); 
      
    echo json_encode($result); 
  }

  public function get_ad($position1, $position2)
  {
    $now = date('Y-m-d');
    
    $ad = Ad
      ::where('valid_from', '<=', $now)
      ->where('valid_until', '>=', $now)
      ->whereBetween('position', [$position1, $position2])
      ->inRandomOrder()->first();

    echo json_encode($ad);
  }

  public function store_recent_views(Request $request)
  {
    $type_id = $request->get('type_id');
    switch ($type_id)
    {
      case 1:
      case 2:
      case 3:
      case 4:
      case 5:
      case 6:
      case 7:
      case 8:
      case 9:
        $post_id = $request->get('post_id');
        $post = Post::find($post_id);
        break;
      case 21:
      case 22:
      case 23:
      case 24:
      case 25:
      case 26:
      case 27:
        $ref_id = $request->get('ref_id');
        $post = Post
          ::where("type_id","=",$type_id)
          ->where("ref_id","=",$ref_id)
          ->first();
        $post_id = $post->id;  
        break;        
    }

    //update views de kposts
    $kpost = $post->kpost;
    if ($kpost)
    {
      $kpost->views = $kpost->views + 1;
      $kpost->timestamps = false;
      $kpost->save();      
    }

    //update views de posts
    $post->views = $post->views + 1;
    $post->timestamps = false;
    $post->save();

    //update recent views
    $user = auth()->user();

    if ($user->recentviews)
    {
      $recentviews = $user->recentviews;
      $recent = explode(',',$recentviews);
      //Si el post existe, quitarlo
      if (($key = array_search($post_id, $recent)) !== false) {
        unset($recent[$key]);
      }
      //Quitar excesos
      while (count($recent)>120)
        array_pop($recent);
      //Añadir al inicio
      array_unshift($recent, $post_id);
      //Convertir a string
      $recentviews = implode(',',$recent);
      $user->recentviews = $recentviews;
    }
    else
    {
      $user->recentviews = $post_id;
    }

    $user->timestamps = false;
    $user->save();

    echo json_encode(array('success'=>true));
  }  
}
