<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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

class PagesController extends Controller
{
  public function home()
  {
    return view('home.show');
  }

  public function discover(Request $request)
  {
    $posts = Post        
      ::where("posts.user_id","<>",auth()->id())
      ->where("type_id","=",22)      
      ->whereNotIn('ref_id', function($query)
        {
          $query->select('page_id')
                ->from('page_user')
                ->where('user_id','=',auth()->id());
        })
      ->title($request->get('title'))
      ->published()
      ->latest('posts.published_at')
      ->paginate(12);

    $title = __('messages.discover-pages');   
    $root = "discover_pages";
    $buttons = "posts.buttons.discover_pages"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));
  }

  public function show_all(Request $request)
  {
    $posts_created = Post  
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')      
      ->where("posts.user_id","=",auth()->id())
      ->where("kposts.user_id","=",auth()->id())
      ->where("type_id","=",22)
      ->hide()
      ->title($request->get('title'))
      ->select('posts.*','featured');

    $posts_subscriptions = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->join('pages', 'ref_id', '=', 'pages.id')
      ->join('page_user', 'pages.id', '=', 'page_user.page_id')
      ->where("type_id","=",22)
      ->where("page_user.user_id","=",auth()->id())
      ->where("kposts.user_id","=",auth()->id())
      ->published()
      ->hide()
      ->title($request->get('title'))
      ->select('posts.*','featured');

    $posts_created->union($posts_subscriptions);
    $querySql = $posts_created->toSql();

    $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts_created->getBindings());
    $posts = $query->orderBy('featured','DESC')->latest('published_at')->paginate(12); 

    $title = __('messages.pages');   
    $root = "all_pages";
    $buttons = "posts.buttons.created_pages"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));
  }  

  public function show_created(Request $request)
  {
    //OJO: Se quito hide()
    $posts = Post  
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')      
      ->where("posts.user_id","=",auth()->id())
      ->where("kposts.user_id","=",auth()->id())
      ->where("posts.type_id","=",22)
      ->title($request->get('title'))
      ->orderBy('kposts.featured', 'DESC')
      ->latest('posts.published_at')
      ->select('posts.*')
      ->paginate(12);

    $title = __('messages.created-pages');   
    $root = "created_pages";
    $buttons = "posts.buttons.created_pages"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));
  }

  public function show_created_by_user(User $user, Request $request)
  {
    $posts_saved = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')        
      ->where("posts.user_id","=",$user->id)
      ->where("kposts.user_id","=",auth()->id())
      ->where("type_id","=",22)
      ->published()
      ->hide()
      ->title($request->get('title'))      
      ->select('posts.*','kposts.featured', 'kposts.order_num as position');

    $posts_created = Post
      ::where("user_id","=",$user->id)
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

    $posts_saved->union($posts_created);
    $querySql = $posts_saved->toSql();

    $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts_saved->getBindings());
    $posts = $query->orderBy('featured','DESC')->orderBy('position')->latest('published_at')->paginate(12);

    $title = __('messages.created-pages-by')." ".$user->name;   
    $root = "created_pages";
    $buttons = "posts.buttons.created_pages"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));
  }

  public function show_page(Page $page)
  {
    return view('pages.page_show',compact('page'));
  }  

  public function show_page_category(Page $page, $category_id, Request $request)
  {
    if ($category_id==0)
    {
      $reset_categories_tree = true;
      $category = Category        
      ::where("page_id","=",$page->id)
      ->where("parent_id","=",null)
      ->orderBy('name')
      ->first();
      $category_id = $category->id;
    }
    else
    {
      $reset_categories_tree = false;
      $category = Category::find($category_id);  
    }

    if(get_view('catalogs')=="ribbon")
    {
      $catalogs_saved = Catalog 
        ::join('catalog_category', 'catalog_category.catalog_id', '=', 'catalogs.id')
        ->join('posts', 'posts.ref_id', '=', 'catalogs.id')
        ->join('kposts', 'kposts.post_id', '=', 'posts.id')    
        ->where("catalog_category.category_id","=",$category_id)
        ->where("posts.type_id","=",21)
        ->where("kposts.user_id","=",auth()->id())
        ->published()
        ->hide()      
        ->title($request->get('title'))
        ->select('catalogs.*', 'kposts.featured', 'kposts.order_num as position', 'posts.published_at as published');

      $catalogs_not_saved = Catalog 
        ::join('catalog_category', 'catalog_category.catalog_id', '=', 'catalogs.id')
        ->join('posts', 'posts.ref_id', '=', 'catalogs.id')   
        ->where("catalog_category.category_id","=",$category_id)
        ->where("posts.type_id","=",21)    
        ->whereNotIn('posts.id', function($query)
          {
            $query->select('post_id')
                  ->from('kposts')
                  ->where('user_id','=',auth()->id());
          })     
        ->published()
        ->title($request->get('title'))
        ->select('catalogs.*', DB::raw('0 as featured'), 'posts.order_num as position', 'posts.published_at as published');

      $catalogs_saved->union($catalogs_not_saved);
      $querySql = $catalogs_saved->toSql();

      $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($catalogs_saved->getBindings());
      $catalogs = $query->orderBy('featured','DESC')->orderBy('position')->latest('published')->paginate(6);

      return view('pages.show_category',compact('page','category','catalogs','reset_categories_tree'));
    }
    else
    {
      //OK
      $posts_saved = Post 
        ::join('kposts', 'posts.id', '=', 'kposts.post_id')
        ->join('catalog_category', 'posts.ref_id', '=', 'catalog_category.catalog_id')        
        ->where("catalog_category.category_id","=",$category_id)
        ->where("posts.type_id","=",21)
        ->where("kposts.user_id","=",auth()->id())
        ->published()
        ->hide()      
        ->title($request->get('title'))
        ->select('posts.*', 'kposts.featured', 'kposts.order_num as position');

      $posts_not_saved = Post  
        ::join('catalog_category', 'posts.ref_id', '=', 'catalog_category.catalog_id')
        ->where("catalog_category.category_id","=",$category_id)
        ->where("posts.type_id","=",21)
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

      $title = $page->name; 
      $subtitle = $category->name; 
      $root = "page_category";
      $buttons = "posts.buttons.page_category"; 

      return view(get_view('catalogs'),compact(
        'posts','title','root','buttons','subtitle','page','category','reset_categories_tree'));       
    }  
  }

  public function show_subscribers(Page $page, Request $request)
  {
    $posts = Post
      ::leftjoin('kposts', 'posts.id', '=', 'kposts.post_id')
      ->join('page_user', 'posts.user_id', '=', 'page_user.user_id')
      ->where("kposts.user_id","=",auth()->id())
      ->where("page_user.page_id","=",$page->id)
      ->where("type_id","=",24)
      ->published()
      ->hide()      
      ->title($request->get('title'))
      ->orderBy('kposts.featured','DESC')
      ->latest('posts.published_at')
      ->select('posts.*','kposts.featured')
      ->paginate(12);  

    $title = $page->name." ".__('messages.subscribers');
    $root = "page_subscribers";
    $buttons = "posts.buttons.page_subscribers";
    $subtitle = "";     

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function get_stats(Post $post)
  { 
    $page = Page
      ::where("id","=",$post->ref_id)
      ->first();

    $catalogs = Category 
      ::join('catalog_category', 'categories.id', '=', 'catalog_category.category_id')
      ->where("categories.page_id","=",$page->id)
      ->count(); 

    echo json_encode($catalogs);
  }

  public function change_user(Page $page, $user_id)
  {
    $page->user_id = $user_id;
    $page->save();

    $post = $page->post;
    $kpost = $post->kpost;

    $post->user_id = $user_id;
    $post->save();
    
    if ($kpost)
    {
      $kpost->user_id = $user_id;
      $kpost->sent_by = $user_id;
      $kpost->save();
    }

    foreach ($page->categories as $category)
    {
      foreach ($category->catalogs as $catalog)
      {
        $catalog->user_id = $user_id;
        $catalog->save();

        $post = $catalog->post;
        $kpost = $post->kpost;

        $post->user_id = $user_id;
        $post->save();

        if ($kpost)
        {
          $kpost->user_id = $user_id;
          $kpost->sent_by = $user_id;
          $kpost->save();
        }

        foreach ($catalog->posts as $post)
        {
          $kpost = $post->kpost;

          $post->user_id = $user_id;
          $post->save();
          
          if ($kpost)
          {
            $kpost->user_id = $user_id;
            $kpost->sent_by = $user_id;
            $kpost->save();
          }
        }
      }
    }
  }

  public function allocate(Request $request)
  {
    if (auth()->id() <> 11) //Kopedia
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;
    }

    $post_id = $request->get('post_id');
    $app_id = $request->get('app_id');    

    $post = Post::find($post_id);    
    $post->app_id = $app_id;
    $post->save();  

    $page = Page
      ::where("id","=",$post->ref_id)
      ->first();
    $page->app_id = $app_id;
    $page->save();

    echo json_encode(array('success'=>true));
  }


  public function isOwner(Page $page)
  {
    if ($page->user_id == auth()->id())
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
      'published_at' => Carbon::now('UTC')
    ]);

    $page = Page::create([
      'name' => $request->get('title'),
      'user_id' => auth()->id()
    ]);

    $category = Category::create([
      'name' => "General",
      'page_id' => $page->id
    ]);
    
    $post = Post::create([
      'title' => $request->get('title'),
      'type_id' => 22,
      'ref_id' => $page->id,
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

  public function edit($page_id)
  {
    $post = Post
      ::where("type_id","=",22)
      ->where("ref_id","=",$page_id)
      ->first();

    return view('posts.edit_post',[
      'post' => $post,
      'tags' => Tag::all(),
      'types' => Type::all()
    ]);
  }

  public function destroy(Post $post)
  {
    $page = Page
      ::where("id","=",$post->ref_id)
      ->first();

    if ($page && $page->user_id != auth()->id())
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;
    } 

    // OJO: Solo se puede eliminar una página si no ha sigo 
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

    if ($page)
      $page->delete();

    echo json_encode(array('success'=>true));
  } 
}
