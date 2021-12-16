<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Artist;
use App\Kpost;
use App\Photo;
use App\Post;
use App\User;
use App\Tag;
use App\App;

class AppsController extends Controller
{
  public function discover(Request $request)
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
      ->title($request->get('title'))
      ->published()
      ->latest('posts.published_at')
      ->select('posts.*')
      ->paginate(12);

    $title = __('messages.discover-apps');   
    $root = "discover_apps";
    $buttons = "posts.buttons.discover_apps"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));
  }

  public function show_all(Request $request)
  {
    $posts_created = Post 
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->join('apps', 'ref_id', '=', 'apps.id')       
      ->where("apps.user_id","=",auth()->id())
      ->where("kposts.user_id","=",auth()->id())
      ->where("type_id","=",23)
      ->where("apps.parent_id","=",null)
      ->hide()
      ->title($request->get('title'))
      ->select('posts.*','featured','kposts.order_num as position');

    $posts_subscriptions = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->join('apps', 'ref_id', '=', 'apps.id')
      ->join('app_user', 'apps.id', '=', 'app_user.app_id')
      ->where("type_id","=",23)
      ->where("app_user.user_id","=",auth()->id())
      ->where("kposts.user_id","=",auth()->id())
      ->where("apps.parent_id","=",null)
      ->published()
      ->hide()
      ->title($request->get('title'))
      ->select('posts.*','featured','kposts.order_num as position');

    $posts_created->union($posts_subscriptions);
    $querySql = $posts_created->toSql();

    $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts_created->getBindings());
    $posts = $query->orderBy('featured','DESC')->orderBy('position')->latest('published_at')->paginate(12); 

    $title = __('messages.apps');   
    $root = "all_apps";
    $buttons = "posts.buttons.created_apps"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));
  }

  public function show_created(Request $request)
  {
    //OJO: Se quito hide()
  	$posts = Post 
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
  	  ->join('apps', 'ref_id', '=', 'apps.id')       
      ->where("apps.user_id","=",auth()->id())
      ->where("kposts.user_id","=",auth()->id())
      ->where("type_id","=",23)
      ->where("apps.parent_id","=",null)
      ->title($request->get('title'))
      ->orderBy('kposts.featured','DESC')
      ->latest('posts.published_at')
      ->select('posts.*','kposts.featured')
      ->paginate(12);

    $title = __('messages.created-apps');   
    $root = "created_apps";
    $buttons = "posts.buttons.created_apps"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));
  }

  public function show_created_by_user(User $user, Request $request)
  {
    $posts_saved = Post 
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->join('apps', 'ref_id', '=', 'apps.id') 
      ->where("apps.user_id","=",$user->id)
      ->where("kposts.user_id","=",auth()->id())
      ->where("type_id","=",23)
      ->where("apps.parent_id","=",null)
      ->title($request->get('title'))
      ->published()
      ->hide()
      ->select('posts.*','kposts.featured', 'kposts.order_num as position');
      
    $posts_created = Post
      ::join('apps', 'ref_id', '=', 'apps.id')
      ->where("apps.user_id","=",$user->id)
      ->where("type_id","=",23)
      ->where("apps.parent_id","=",null)
      ->whereNotIn('posts.id', function($query)
        {
          $query->select('post_id')
                ->from('kposts')
                ->where('user_id','=',auth()->id());
        }) 
      ->title($request->get('title'))
      ->published()
      ->select('posts.*', DB::raw('0 as featured'), 'posts.order_num as position');

    $posts_saved->union($posts_created);
    $querySql = $posts_saved->toSql();

    $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts_saved->getBindings());
    $posts = $query->orderBy('featured','DESC')->orderBy('position')->latest('published_at')->paginate(12);

    $title = __('messages.created-apps-by')." ".$user->name;   
    $root = "created_apps";
    $buttons = "posts.buttons.created_apps"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));
  }

  public function show_app(App $app, Request $request)
  {
    $apps = App
      ::where("parent_id","=",$app->id)
      ->get();

    if(count($apps) > 0) // Mostrar app subs
    {
      $posts_saved = Post 
        ::join('kposts', 'posts.id', '=', 'kposts.post_id')
        ->join('apps', 'ref_id', '=', 'apps.id') 
        ->where("kposts.user_id","=",auth()->id())      
        ->where("type_id","=",23)
        ->where("apps.parent_id","=",$app->id)
        ->select('posts.*','kposts.featured', 'kposts.order_num as position');

      $posts_not_saved = Post
        ::join('apps', 'ref_id', '=', 'apps.id') 
        ->where("type_id","=",23)
        ->where("apps.parent_id","=",$app->id)
        ->whereNotIn('posts.id', function($query)
          {
            $query->select('post_id')
                  ->from('kposts')
                  ->where('user_id','=',auth()->id());
          }) 
        ->select('posts.*', DB::raw('0 as featured'), 'posts.order_num as position');

      $posts_saved->union($posts_not_saved);
      $querySql = $posts_saved->toSql();

      $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts_saved->getBindings());
      $posts = $query->orderBy('featured','DESC')->orderBy('position')->latest('published_at')->paginate(12);  

      $title = $app->name;   
      $root = "app_subs";
      $buttons = "posts.buttons.app_subs"; 
      $subtitle = "";

      return view(get_view(),compact(
        'posts','title','root','buttons','subtitle','app'));
    }

    if($app->mode==1) // Mostrar pages
    {
      $posts_saved = Post
        ::join('kposts', 'posts.id', '=', 'kposts.post_id')  
        ->where("app_id","=",$app->id)
        ->where("type_id","=",22)
        ->where("kposts.user_id","=",auth()->id())
        ->published()
        ->hide()
        ->title($request->get('title'))      
        ->select('posts.*','kposts.featured', 'kposts.order_num as position');

      $posts_not_saved = Post
        ::where("app_id","=",$app->id)
        ->where("type_id","=",22)
        ->whereNotIn('posts.id', function($query)
          {
            $query->select('post_id')
                  ->from('kposts')
                  ->where('user_id','=',auth()->id());
          }) 
        ->published()
        ->title($request->get('title'))
        ->select('posts.*', DB::raw('0 as featured'), 'posts.order_num as position');

      $posts_saved->union($posts_not_saved);
      $querySql = $posts_saved->toSql();

      $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts_saved->getBindings());
      $posts = $query->orderBy('featured','DESC')->orderBy('position')->latest('published_at')->paginate(12);  

      $title = $app->name;   
      $root = "app_pages";
      $buttons = "posts.buttons.app_subs"; 
      $subtitle = "";

      return view(get_view(),compact(
        'posts','title','root','buttons','subtitle','app'));
    }     

    if($app->mode==2) // Mostrar api full
    {
      $title = $app->name;
      $buttons = ""; 
      $subtitle = "";
      $root = "app_api";
      return view('apps.show_full',compact(
        'app','title','root','buttons','subtitle'));
    }

    if($app->mode==3) // Mostrar api list
    {
      $title = $app->name;
      $buttons = ""; 
      $subtitle = "";
      $root = "app_api";
      return view('apps.show_list',compact(
        'app','title','root','buttons','subtitle'));
    }

    if($app->mode==4) // Mostrar api card
    {
      $title = $app->name;
      $buttons = ""; 
      $subtitle = "";
      $root = "app_api";
      return view('apps.show_card',compact(
        'app','title','root','buttons','subtitle'));
    }
  }

  public function show_subscribers(App $app, Request $request)
  {
    $posts = Post
      ::leftjoin('kposts', 'posts.id', '=', 'kposts.post_id')
      ->join('app_user', 'posts.user_id', '=', 'app_user.user_id')
      ->where("kposts.user_id","=",auth()->id())
      ->where("app_user.app_id","=",$app->id)
      ->where("type_id","=",24)
      ->published()
      ->hide()
      ->title($request->get('title'))
      ->orderBy('kposts.featured','DESC')
      ->latest('posts.published_at')
      ->select('posts.*','kposts.featured')
      ->paginate(12);  

    $title = "$app->name"." ".__('messages.subscribers');
    $root = "app_subscribers";
    $buttons = "posts.buttons.app_subscribers";
    $subtitle = "";     

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function get_stats(Post $post)
  { 
    $app = App
      ::where("id","=",$post->ref_id)
      ->first(); 

    $subscriptions = App
      ::join('app_user', 'apps.id', '=', 'app_user.app_id')
      ->where("app_user.app_id","=",$app->id)
      ->count();
      
    echo json_encode($subscriptions); 
  }

  public function get_post(Request $request)
  {
    //YA NO SE USA (ELIMINAR)
    $app_id = $request->get('app_id');
    $title = $request->get('title');

    $post = Post
      ::where("app_id","=",$app_id)
      ->where("title","=",$title)
      ->first();

    if ($post)
      echo json_encode(array('success'=>true,'post_id'=>$post->id));
    else
      echo json_encode(array('success'=>false));
  }  

  public function search_posts($app_id, $q)
  {
    //Buscar en todos los posts guardados
    $posts = Post
      ::where("app_id","=",$app_id)
      ->where("title",'like',$q.'%')
      ->get();

    $rposts = array();

    foreach($posts as $post)
    {
      //Obtener tags
      $str_tags = "";
      $tags = $post->tags;
      foreach($tags as $tag)
      {
        if ($str_tags=="")
          $str_tags = $str_tags.$tag->name;
        else
          $str_tags = $str_tags.",".$tag->name;
      }

      //Obtener imagen previamente guardada
      if ($post->photos->count() >= 1)
        $img = $post->photos->first()->url;

      //Crear post temporal para mostrar
      $post = array(
        "id" => $post->id,
        "title" => $post->title, 
        "excerpt" => $post->excerpt,
        "footnote" => $post->footnote, 
        "img" => $img,
        "source" => $post->source,
        "custom_type" => $post->custom_type,
        "tags" => $str_tags
      );

      array_push($rposts, $post); 
    } 

    $result['rows'] = $rposts;
    echo json_encode($result);
  } 

  function get_posts(App $app)
  {
    $posts = Post
      ::with('photos')
      ->with('tags')
      ->where("type_id","=",8)
      ->where("app_id","=",$app->id)
      ->where("user_id","=",$app->user_id)
      ->where("views",">",3)
      ->inRandomOrder()     
      ->limit(120)
      ->get();

    echo json_encode($posts);
  }

  public function save_app_post(Request $request)
  {    
    $app_id = $request->get('app_id');
    $title = $request->get('title');
    $excerpt = $request->get('excerpt');
    $img = $request->get('img');
    $tags = $request->get('tags');
    $links = $request->get('links');
    $footnote = $request->get('footnote');
    $date = $request->get('date');
    $user = $request->get('user');
    $source = $request->get('source');
    $custom_type = $request->get('custom_type');

    if ($app_id == 4)
    {
      //Todos los posts de la aplicación LastFm ya fueron guardados
      echo json_encode(array('success'=>true));
      return;
    }

    //Buscar post de la app
    $post = Post
      ::where("app_id","=",$app_id)
      ->where("source","=",$source)
      ->first();

    //Buscar el owner de la app
    $app = App::find($app_id);

    //Si el post no existe hay que crearlo
    //OJO El usuario debería ser el administrador de la App
    if (! $post)
    { 
      $post = Post::create([
        'title' => $title,
        'excerpt' => $excerpt,
        'body' => '<a href="'.$source.'" target="_blank">source</a>',        
        'footnote' => $footnote,
        'links' => $links,
        'type_id' => 8,
        'user_id' => $app->user_id,
        'custom_type' => $custom_type,
        'app_id' => $app_id,
        'source' => $source,
        'views' => 4,
        'published_at' => Carbon::now('UTC')
      ]);

      Photo::create([
        'url' => $request->get('img'),
        'post_id' => $post->id,
        'user_id' => $app->user_id
      ]);

      //Eliminar tags del post
      $post->tags()
        ->wherePivot('post_id', '=', $post->id)
        ->wherePivot('user_id', '=', $app->user_id)
        ->detach();
      
      //Agregar tags al post
      $tags = explode(',',$request->get('tags'));
      if(!empty($tags))
      {
        foreach ($tags as $tag_str)
        {
          if (strlen($tag_str) >= 3)
          {
            $tag_str = trim(preg_replace('/\s+/', '', $tag_str));
            $tag = Tag::where('name', $tag_str)->first();
            if($tag)
            {
              if (! $post->tags->contains($tag->id))
                $post->tags()->attach($tag->id, array('user_id' => $app->user_id));
            }            
            else
            {
              $tag = Tag::create([
                'name' => $tag_str
              ]);
              $post->tags()->attach($tag->id, array('user_id' => $app->user_id));
            }
          }
        }
      }

      $kpost = Kpost::create([
        'post_id' => $post->id,
        'user_id' => $app->user_id,
        'sent_by' => $app->user_id,
        'sent_at' => Carbon::now('UTC') 
      ]);
    }
    
    if (!$post->kpost)
    {
      $kpost = Kpost::create([
        'post_id' => $post->id,
        'status_id' => 2,
        'user_id' => auth()->id(),
        'sent_by' => auth()->id(),
        'sent_at' => Carbon::now('UTC') 
      ]);
    }

    echo json_encode(array('success'=>true,'post_id'=>$post->id));
  }

  public function store(Request $request)
  {
    //$this->authorize('create', new Post);

    //Solamente el usuario kopedia puede crear apps
    if (auth()->id() != 11)
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;
    } 

    $pages = Post
      ::where("type_id","=",22)
      ->where("app_id","=",$request->get('parent_id'))
      ->get();

    if(count($pages) > 0) 
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;
    } 

    $this->validate($request, [
      'title' => 'required',
      'published_at' => Carbon::now('UTC')
    ]);

    $app = App::create([
      'name' => $request->get('title'),
      'user_id' => auth()->id(),
      'parent_id' => $request->get('parent_id'),
      'mode' => 1
    ]);
    
    $post = Post::create([
      'title' => $request->get('title'),
      'type_id' => 23,
      'ref_id' => $app->id,
      'user_id' => auth()->id(),
      'published_at' => Carbon::now('UTC')
    ]);

    $kpost = Kpost::create([
      'post_id' => $post->id,
      'user_id' => auth()->id(),
      'sent_by' => auth()->id(),
      'sent_at' => Carbon::now('UTC') 
    ]);

    echo json_encode(array('success'=>true,'post_id'=>$post->id));
  }

  public function edit($app_id)
  {
    $post = Post
      ::where("type_id","=",23)
      ->where("ref_id","=",$app_id)
      ->first();

    return view('posts.edit_post',[
      'post' => $post,
      'tags' => Tag::all(),
      'types' => Type::all()
    ]);
  }

  public function destroy(Post $post)
  {
    $app = App
      ::where("id","=",$post->ref_id)
      ->first();

    if ($app && $app->user_id != auth()->id())
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;
    } 

    $apps = App
      ::where("parent_id","=",$app->id)
      ->get();

    if (count($apps) > 0)
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;
    }

    $pages = Post
      ::where("type_id","=",22)
      ->where("app_id","=",$app->id)
      ->get();

    if (count($pages) > 0)
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;
    }

    // OJO: Solo se puede eliminar una app si no ha sigo 
    // guardada por ningún otro usuario  

    //Eliminar todos los tags
    if ($post->tags)
      $post->tags()->detach();
      
    //Eliminar todas las fotos
    foreach ($post->photos as $photo)
    {
      $photo->delete();
      Storage::disk('public')->delete($photo->url);
    }

    //Eliminar kpost de la pagina
    /*
    $kpost = Kpost
      ::where("post_id","=",$post->id)
      ->where("user_id","=",auth()->id())
      ->first(); 

    if ($kpost)
      $kpost->delete();  
    */
    
    $post->delete();

    if ($app)
      $app->delete();

    echo json_encode(array('success'=>true));
  } 
}


