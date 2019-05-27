<?php

namespace App\Http\Controllers;

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
  public function discover()
  {
    if(get_view('catalogs')=="ribbon")
    {
      $catalogs = Catalog
        ::where("user_id","<>",auth()->id())
        ->latest('created_at')
        ->paginate(6);      

      return view('catalogs.show',compact('catalogs'));
    }
    else
    {
      $posts = Post        
      ::where("posts.user_id","<>",auth()->id())
      ->where("type_id","=",21)
      ->latest('posts.created_at')
      ->paginate(12);

      $title = "Discover catalogs";   
      $root = "discover_catalogs_posts";
      $buttons = "posts.buttons.discover_catalogs"; 
      $subtitle = "";

      return view(get_view('catalogs'),compact(
        'posts','title','root','buttons','subtitle')); 
    }
  }

  public function show_created()
  {
    if(get_view('catalogs')=="ribbon")
    {
    	$catalogs = Catalog
    		::where("user_id","=",auth()->id())
        ->latest('created_at')
    		->paginate(6);  		

    	return view('catalogs.show',compact('catalogs'));
    }
    else
    {
      $posts = Post        
      ::where("posts.user_id","=",auth()->id())
      ->where("type_id","=",21)
      ->latest('posts.created_at')
      ->paginate(12);

      $title = "Created catalogs";   
      $root = "created_catalogs_posts";
      $buttons = "posts.buttons.created_catalogs"; 
      $subtitle = "";

      return view(get_view('catalogs'),compact(
        'posts','title','root','buttons','subtitle')); 
    }
  }

  public function show_catalog(Catalog $catalog)
  {
    $posts = $catalog->posts()->paginate(12);

    $title = "Catalog: ".$catalog->name; 
    $root = "catalog";
    $ref_id = $catalog->id;
    $buttons = "posts.buttons.catalog_posts";
    $subtitle = "";

    return view(get_view(),compact(
        'posts','title','root','ref_id','catalog','buttons','subtitle'));

  	//return view('catalogs.catalog_show',compact('catalog','posts'));
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

  public function delete_catalog_from_category(Category $category, Catalog $catalog)
  {
    if ($category->page->user_id != auth()->id() && $catalog->user_id != auth()->id())
    {
      echo json_encode(array('success'=>false,'msg'=>'Ud. no está autorizado para realizar esta operación.'));
      return;
    }

    $category->catalogs()->detach($catalog->id); 

    echo json_encode(array('success'=>true));  
  }

  public function destroy(Catalog $catalog)
  {
    if ($catalog->user_id != auth()->id())
    {
      echo json_encode(array('success'=>false,'msg'=>'Ud. no está autorizado para realizar esta operación.'));
      return;
    }

    //OJO: Solo se puede eliminar el catalogo si no ha sido 
    //guardado por ningún otro usuario. 

    $post = Post
      ::where("type_id","=",21)
      ->where("ref_id","=",$catalog->id)
      ->first();

    if($post)
    {  
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
    }

    $catalog->delete();

    echo json_encode(array('success'=>true));
  } 
}
