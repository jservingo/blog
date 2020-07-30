<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Category;
use App\Catalog;
use App\Kpost;
use App\Page;
use App\Post;
use App\Type;
use App\User;
use App\Tag;

class CatalogsController extends Controller
{
  public function discover(Request $request)
  {
    if(get_view('catalogs')=="ribbon")
    {
      //OK
      $catalogs = Catalog
        ::join('posts', 'catalogs.id', '=', 'posts.ref_id')
        ->where("catalogs.user_id","<>",auth()->id())
        ->where("posts.type_id","=",21)
        ->published()
        ->title($request->get('title'))
        ->whereNotIn('posts.id', function($query)
          {
            $query->select('post_id')
                  ->from('kposts')
                  ->where('user_id','=',auth()->id());
          })
        ->select('catalogs.*')
        ->latest('published_at')
        ->paginate(6);      

      return view('catalogs.show',compact('catalogs'));
    }
    else
    {
      //OK
      $posts = Post        
      ::where("posts.user_id","<>",auth()->id())
      ->where("type_id","=",21)
      ->published()
      ->title($request->get('title'))
      ->whereNotIn('id', function($query)
        {
          $query->select('post_id')
                ->from('kposts')
                ->where('user_id','=',auth()->id());
        })
      ->latest('posts.published_at')
      ->paginate(12);

      $title = __('messages.discover-catalogs');   
      $root = "discover_catalogs";
      $buttons = "posts.buttons.discover_catalogs"; 
      $subtitle = "";

      return view(get_view('catalogs'),compact(
        'posts','title','root','buttons','subtitle')); 
    }
  }

  public function show_all(Request $request)
  {
    if(get_view('catalogs')=="ribbon")
    {
      //OK
      $catalogs = Catalog
        ::join('posts', 'catalogs.id', '=', 'posts.ref_id')
        ->leftjoin('kposts', 'posts.id', '=', 'kposts.post_id')
        ->where(function ($query) use ($request) {
            //Catálogos creados
            $query->where("catalogs.user_id","=",auth()->id())
                  ->where("kposts.user_id","=",auth()->id())
                  ->where("type_id","=",21)
                  ->where("posts.user_id","=",auth()->id())
                  ->hide()
                  ->title($request->get('title'));                            
        })->orWhere(function ($query) use ($request) {
            //Catálogos guardados
            $query->where("catalogs.user_id","=",auth()->id())
                  ->where("kposts.user_id","=",auth()->id())
                  ->where("type_id","=",21)
                  ->where("posts.user_id","<>",auth()->id())                  
                  ->whereIn('status_id',[0,2]) 
                  ->published()    
                  ->hide()             
                  ->title($request->get('title'));            
        })
        ->orderBy('kposts.featured','DESC')
        ->orderBy('kposts.order_num')
        ->latest('posts.published_at')
        ->select('catalogs.*','kposts.featured')
        ->paginate(6);      

      return view('catalogs.show',compact('catalogs'));
    }
    else
    {
      //OK
      $posts = Post  
        ::join('kposts', 'posts.id', '=', 'kposts.post_id')
        ->where(function ($query) use ($request) {
            //Catálogos creados
            $query->where("kposts.user_id","=",auth()->id())
                  ->where("type_id","=",21)
                  ->where("posts.user_id","=",auth()->id())
                  ->hide()
                  ->title($request->get('title'));                            
        })->orWhere(function ($query) use ($request) {
            //Catálogos guardados
            $query->where("kposts.user_id","=",auth()->id())
                  ->where("type_id","=",21)
                  ->where("posts.user_id","<>",auth()->id())                  
                  ->whereIn('status_id',[0,2]) 
                  ->published() 
                  ->hide()                
                  ->title($request->get('title'));            
        })
        ->orderBy('featured','DESC')
        ->orderBy('kposts.order_num')
        ->latest('published_at') 
        ->select('posts.*','featured')
        ->paginate(12);

      $title = __('messages.catalogs');   
      $root = "all_catalogs";
      $buttons = "posts.buttons.created_catalogs"; 
      $subtitle = "";

      return view(get_view('catalogs'),compact(
        'posts','title','root','buttons','subtitle')); 
    }
  }  

  public function show_created(Request $request)
  {
    if(get_view('catalogs')=="ribbon")
    {
      //OJO: Se quito hide()
      $catalogs = Catalog
        ::join('posts', 'catalogs.id', '=', 'posts.ref_id')
        ->leftjoin('kposts', 'posts.id', '=', 'kposts.post_id')
        ->where("catalogs.user_id","=",auth()->id())
        ->where("kposts.user_id","=",auth()->id())
        ->where("posts.type_id","=",21)
        ->title($request->get('title'))
        ->orderBy('kposts.featured','DESC')
        ->orderBy('kposts.order_num')
        ->latest('posts.published_at')
        ->select('catalogs.*','kposts.featured')
        ->paginate(6);   
      return view('catalogs.show',compact('catalogs'));
    }
    else
    {
      //OJO: Se quito hide()
      $posts = Post 
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')       
      ->where("posts.user_id","=",auth()->id())
      ->where("kposts.user_id","=",auth()->id())
      ->where("posts.type_id","=",21)
      ->title($request->get('title'))
      ->orderBy('kposts.featured','DESC')
      ->orderBy('kposts.order_num')
      ->latest('posts.published_at')
      ->select('posts.*','kposts.featured')
      ->paginate(12);

      $title = __('messages.created-catalogs');   
      $root = "created_catalogs";
      $buttons = "posts.buttons.created_catalogs"; 
      $subtitle = "";

      return view(get_view('catalogs'),compact(
        'posts','title','root','buttons','subtitle')); 
    }
  }

  public function show_created_by_user(User $user, Request $request)
  {
    if(get_view('catalogs')=="ribbon")
    {
      //OK
      $catalogs_saved = Catalog
        ::join('posts', 'catalogs.id', '=', 'posts.ref_id')
        ->leftjoin('kposts', 'posts.id', '=', 'kposts.post_id')
        ->where("catalogs.user_id","=",$user->id)
        ->where("kposts.user_id","=",auth()->id())
        ->where("posts.type_id","=",21)
        ->title($request->get('title'))
        ->published()
        ->hide()
        ->select('catalogs.*','kposts.featured');

      $catalogs_created = Catalog  
        ::join('posts', 'catalogs.id', '=', 'posts.ref_id')
        ->where("catalogs.user_id","=",$user->id)
        ->where("posts.type_id","=",21)
        ->title($request->get('title'))
        ->published()
        ->select('catalogs.*', DB::raw('0 as featured'));
           
      $catalogs_saved->union($catalogs_created);
      $querySql = $catalogs_saved->toSql();

      $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($catalogs_saved->getBindings());
      $catalogs = $query->orderBy('featured','DESC')->latest('published_at')->paginate(12);                 

      return view('catalogs.show',compact('catalogs'));
    }
    else
    {
      //OK
      $posts_saved = Post 
        ::leftjoin('kposts', 'posts.id', '=', 'kposts.post_id')
        ->where("kposts.user_id","=",auth()->id())       
        ->where("posts.user_id","=",$user->id)
        ->where("type_id","=",21)
        ->title($request->get('title'))
        ->published()
        ->hide()
        ->select('posts.*','kposts.featured');

      $posts_created = Post
      ::where("user_id","=",$user->id)
      ->where("type_id","=",21)
      ->title($request->get('title'))
      ->published()
      ->select('posts.*', DB::raw('0 as featured'));  

      $posts_saved->union($posts_created);
      $querySql = $posts_saved->toSql();

      $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts_saved->getBindings());
      $posts = $query->orderBy('featured','DESC')->latest('published_at')->paginate(12);

      $title = __('messages.created-catalogs-by')." ".$user->name;   
      $root = "created_catalogs";
      $buttons = "posts.buttons.created_catalogs"; 
      $subtitle = "";

      return view(get_view('catalogs'),compact(
        'posts','title','root','buttons','subtitle')); 
    }
  }

  public function show_catalog(Catalog $catalog, Request $request)
  {
    //OK
    $posts_offers = Post
      ::where("type_id","=",7)
      ->where("user_id","<>",auth()->id())
      ->publishedOffer()
      ->inRandomOrder()->limit(1)
      ->select('posts.*', DB::raw('1 as section'), DB::raw('1 as featured'), DB::raw('0 as position'));

    $posts_saved = $catalog->posts() 
      ->join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("kposts.user_id","=",auth()->id())
      ->title($request->get('title'))
      ->published() 
      ->hide()
      ->latest('posts.published_at')
      ->select('posts.*', DB::raw('2 as section'), 'kposts.featured', 'kposts.order_num as position'); 
  
    $posts_not_saved = $catalog->posts()
      ->title($request->get('title'))
      ->published()
      ->latest('posts.published_at')
      ->select('posts.*', DB::raw('3 as section'),  DB::raw('0 as featured'), 'posts.order_num as position');

    $posts = $posts_offers
      ->union($posts_saved) 
      ->union($posts_not_saved);

    $querySql = $posts->toSql();
    $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts->getBindings());
    $posts = $query->orderBy('section')->orderBy('featured','DESC')->orderBy('position')->latest('published_at')->paginate(12); 
      
    $title = $catalog->name; 
    $root = "catalog";
    $ref_id = $catalog->id;
    $buttons = "posts.buttons.catalog_posts";
    $subtitle = "";

    return view(get_view(),compact(
        'posts','title','root','ref_id','catalog','buttons','subtitle'));

    //return view('catalogs.catalog_show',compact('catalog','posts'));
  }

  public static function get_posts($catalog_id)
  {
    //OK
    $catalog = Catalog::find($catalog_id);

    $posts_offers = Post
      ::where("type_id","=",7)
      ->where("user_id","<>",auth()->id())
      ->publishedOffer()
      ->inRandomOrder()->limit(1)
      ->select('posts.*', DB::raw('1 as section'), DB::raw('1 as featured'));

    $posts_saved = $catalog->posts() 
      ->join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("kposts.user_id","=",auth()->id())
      ->published() 
      ->hide()
      ->orderBy('kposts.featured','DESC')
      ->latest('posts.published_at')
      ->select('posts.*', DB::raw('2 as section'), 'kposts.featured'); 
  
    $posts_not_saved = $catalog->posts()
      ->leftjoin('kposts', 'posts.id', '=', 'kposts.post_id')
      ->whereNull('kposts.post_id')
      ->published()
      ->latest('posts.published_at')
      ->select('posts.*', DB::raw('3 as section'),  DB::raw('0 as featured'));

    $posts = $posts_offers
      ->union($posts_saved) 
      ->union($posts_not_saved);

    $querySql = $posts->toSql();
    $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts->getBindings());
    $posts = $query->orderBy('section')->orderBy('featured','DESC')->latest('published_at')->paginate(12); 
  
    return $posts;
  }

  public function get_stats(Post $post)
  { 
    $catalog = Catalog
      ::where("id","=",$post->ref_id)
      ->first();

    $posts = Post 
      ::join('catalog_post', 'posts.id', '=', 'catalog_post.post_id')
      ->where("catalog_post.catalog_id","=",$catalog->id)
      ->count(); 

    echo json_encode($posts);
  }

  public function isOwner(Catalog $catalog)
  {
    if ($catalog->user_id == auth()->id())
      $response = "Y";
    else
      $response = "N";

    echo json_encode(array('success'=>true,'response'=>$response));
  }

  public function store(Request $request)
  {
    //$this->authorize('create', new Post);

    $this->validate($request, [
      'title' => 'required',
      'published_at' => Carbon::now()
    ]);

    $catalog = Catalog::create([
      'name' => $request->get('title'),
      'user_id' => auth()->id()
    ]);

    if ($request->has('category_id')) {
      $category = Category::find($request->get('category_id')); 
      $category->catalogs()->attach(
        $catalog->id, 
        array('user_id' => auth()->id())
      );
    } 
    
    $post = Post::create([
      'title' => $request->get('title'),
      'type_id' => 21,
      'ref_id' => $catalog->id,
      'user_id' => auth()->id(),
      'published_at' => Carbon::now()
    ]);

    $kpost = Kpost::create([
      'post_id' => $post->id,
      'user_id' => auth()->id(),
      'sent_by' => auth()->id(),
      'sent_at' => Carbon::now() 
    ]);

    echo json_encode(array('success'=>true,'post_id'=>$post->id));
  }

  public function edit($catalog_id)
  {
    $post = Post
      ::where("type_id","=",21)
      ->where("ref_id","=",$catalog_id)
      ->first();

    return view('posts.edit_post',[
      'post' => $post,
      'tags' => Tag::all(),
      'types' => Type::all()
    ]);
  }

  public function delete_catalog_from_category(Category $category, Post $post)
  {
    $catalog = Catalog
      ::where("id","=",$post->ref_id)
      ->first();

    if ($category->page->user_id != auth()->id() && $catalog->user_id != auth()->id())
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;
    }

    $category->catalogs()->detach($catalog->id); 

    echo json_encode(array('success'=>true));  
  }

  public function destroy(Post $post)
  {
    $catalog = Catalog
      ::where("id","=",$post->ref_id)
      ->first();

    if ($catalog && $catalog->user_id != auth()->id())
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;
    }

    //OJO: Solo se puede eliminar el catalogo si no ha sido 
    //guardado por ningún otro usuario. 
 
    //Eliminar todos los tags
    if ($post->tags)  
      $post->tags()->detach();
      
    //Eliminar todas las fotos
    foreach ($post->photos as $photo)
    {
      $photo->delete();
      Storage::disk('public')->delete($photo->url);
    }

    $post->delete();

    if ($catalog)
      $catalog->delete();

    echo json_encode(array('success'=>true));
  } 
}