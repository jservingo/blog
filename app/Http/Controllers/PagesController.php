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
      ->title($request->get('title'))
      ->whereNotIn('ref_id', function($query)
        {
          $query->select('page_id')
                ->from('page_user')
                ->where('user_id','=',auth()->id());
        })
      ->latest('posts.created_at')
      ->paginate(12);

    $title = __('messages.discover-pages');   
    $root = "discover_pages";
    $buttons = "posts.buttons.discover_pages"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));

    /*
    $pages = Page
        ::where("user_id","=",auth()->id())
        ->orderBy('featured', 'DESC')
        ->orderBy('position', 'ASC')
        ->latest('created_at')
        ->paginate();           

    return view('pages.pages_show',compact('pages'));
    */
  }

  public function show_all(Request $request)
  {
    $posts_created = Post  
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')      
      ->where("posts.user_id","=",auth()->id())
      ->where("kposts.user_id","=",auth()->id())
      ->where("type_id","=",22)
      ->title($request->get('title'))
      ->select('posts.*','featured');

    $posts_subscriptions = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->join('pages', 'ref_id', '=', 'pages.id')
      ->join('page_user', 'pages.id', '=', 'page_user.page_id')
      ->where("type_id","=",22)
      ->where("page_user.user_id","=",auth()->id())
      ->where("kposts.user_id","=",auth()->id())
      ->title($request->get('title'))
      ->select('posts.*','featured');

    $posts_created->union($posts_subscriptions);
    $querySql = $posts_created->toSql();

    $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts_created->getBindings());
    $posts = $query->orderBy('featured','DESC')->latest('created_at')->paginate(12); 

    $title = __('messages.pages');   
    $root = "all_pages";
    $buttons = "posts.buttons.created_pages"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));
  }  

  public function show_created(Request $request)
  {
    $posts = Post  
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')      
      ->where("posts.user_id","=",auth()->id())
      ->where("kposts.user_id","=",auth()->id())
      ->where("posts.type_id","=",22)
      ->title($request->get('title'))
      ->orderBy('kposts.featured', 'DESC')
      ->latest('posts.created_at')
      ->select('posts.*')
      ->paginate(12);

    $title = __('messages.created-pages');   
    $root = "created_pages";
    $buttons = "posts.buttons.created_pages"; 
    $subtitle = "";

    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));

    /*
    $pages = Page
        ::where("user_id","=",auth()->id())
        ->orderBy('featured', 'DESC')
        ->orderBy('position', 'ASC')
        ->latest('created_at')
        ->paginate();           

    return view('pages.pages_show',compact('pages'));
    */
  }

  public function show_created_user(User $user, Request $request)
  {
    $posts = Post
      ::leftjoin('kposts', 'posts.id', '=', 'kposts.post_id')        
      ->where("posts.user_id","=",$user->id)
      ->where("kposts.user_id","=",auth()->id())
      ->where("type_id","=",22)
      ->title($request->get('title'))
      ->orderBy('kposts.featured','DESC')
      ->latest('posts.created_at')
      ->select('posts.*','kposts.featured')
      ->paginate(12);

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
      //OJO FALTA PASAR LOS CATALOGOS ORDENADOS Y
      //EN catalogs.ribbon_view FALTA ORDENAR LOS POSTS
      $catalogs = Catalog
        ::join('posts', 'catalogs.id', '=', 'posts.ref_id')
        ->leftjoin('kposts', 'posts.id', '=', 'kposts.post_id')
        ->where("catalogs.user_id","=",auth()->id())
        ->where("kposts.user_id","=",auth()->id())
        ->where("posts.type_id","=",21)
        ->orderBy('kposts.featured','DESC')
        ->latest('posts.created_at')
        ->select('catalogs.*','kposts.featured')
        ->paginate(6); 

      return view('pages.show_category',compact('page','category','reset_categories_tree'));
    }
    else
    {
      $posts = Post 
        ::leftjoin('kposts', 'posts.id', '=', 'kposts.post_id')
        ->join('catalog_category', 'posts.ref_id', '=', 'catalog_category.catalog_id')
        ->where("kposts.user_id","=",auth()->id())
        ->where("posts.type_id","=",21)
        ->where("catalog_category.category_id","=",$category_id)
        ->title($request->get('title'))
        ->orderBy('kposts.featured','DESC')
        ->latest('posts.created_at')
        ->select('posts.*','kposts.featured')
        ->paginate(12);

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
      ->title($request->get('title'))
      ->orderBy('kposts.featured','DESC')
      ->latest('posts.created_at')
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
      'published_at' => Carbon::now()
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
