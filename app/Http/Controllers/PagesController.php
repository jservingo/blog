<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Category;
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
    return view('home.home_show');
  }

  public function show_created()
  {
    $posts = Post        
      ::where("posts.user_id","=",auth()->id())
      ->where("type_id","=",22)
      ->latest('posts.created_at')
      ->paginate(12);

    $title = "Created pages";   
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

  public function show_page(Page $page)
  {
    return view('pages.page_show',compact('page'));
  }

  public function show_page_category(Page $page, $category_id)
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
      return view('pages.show_category',compact('page','category','reset_categories_tree'));
    }
    else
    {
      $posts = Post 
      ::join('catalog_category', 'posts.ref_id', '=', 'catalog_category.catalog_id')       
      ->where("posts.type_id","=",21)
      ->where("catalog_category.category_id","=",$category_id)
      ->select('posts.*')
      ->latest('posts.created_at')
      ->paginate(12);

      $title = "Page: ".$page->name; 
      $subtitle = "Category: ".$category->name; 
      $root = "page_category";
      $buttons = "posts.buttons.page_category"; 

      return view(get_view('catalogs'),compact(
        'posts','title','root','buttons','subtitle','page','category','reset_categories_tree'));       
    }  
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

    if ($page->user_id != auth()->id())
    {
      echo json_encode(array('success'=>false,'msg'=>'Ud. no está autorizado para realizar esta operación.'));
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

    $page->delete();

    echo json_encode(array('success'=>true));
  } 
}
