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
      $catalogs = Catalog
        ::join('posts', 'catalogs.id', '=', 'posts.ref_id')
        ->where("catalogs.user_id","<>",auth()->id())
        ->where("posts.type_id","=",21)
        ->whereNotIn('posts.id', function($query)
          {
            $query->select('post_id')
                  ->from('kposts')
                  ->where('user_id','=',auth()->id());
          })
        ->select('catalogs.*')
        ->latest('created_at')
        ->paginate(6);      

      return view('catalogs.show',compact('catalogs'));
    }
    else
    {
      $posts = Post        
      ::where("posts.user_id","<>",auth()->id())
      ->where("type_id","=",21)
      ->title($request->get('title'))
      ->whereNotIn('id', function($query)
        {
          $query->select('post_id')
                ->from('kposts')
                ->where('user_id','=',auth()->id());
        })
      ->latest('posts.created_at')
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
      //OJO AQUI FALTA MOSTRAR LOS SALVADOS
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

      return view('catalogs.show',compact('catalogs'));
    }
    else
    {
      $posts_created = Post  
        ::join('kposts', 'posts.id', '=', 'kposts.post_id')      
        ->where("posts.user_id","=",auth()->id())
        ->where("kposts.user_id","=",auth()->id())
        ->where("type_id","=",21)
        ->title($request->get('title'))
        ->select('posts.*','featured'); 

      $posts_saved = Post
        ::join('kposts', 'posts.id', '=', 'kposts.post_id')
        ->where("type_id","=",21)
        ->where("status_id","=",2)
        ->where("kposts.sent_by","=",auth()->id())
        ->where("kposts.user_id","=",auth()->id())
        ->title($request->get('title'))
        ->select('posts.*','featured');

      $posts_created->union($posts_saved);
      $querySql = $posts_created->toSql();

      $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts_created->getBindings());
      $posts = $query->orderBy('featured','DESC')->latest('created_at')->paginate(12); 

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
    	return view('catalogs.show',compact('catalogs'));
    }
    else
    {
      $posts = Post 
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')       
      ->where("posts.user_id","=",auth()->id())
      ->where("kposts.user_id","=",auth()->id())
      ->where("posts.type_id","=",21)
      ->title($request->get('title'))
      ->orderBy('kposts.featured','DESC')
      ->latest('posts.created_at')
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

  public function show_created_user(User $user, Request $request)
  {
    if(get_view('catalogs')=="ribbon")
    {
      $catalogs = Catalog
        ::join('posts', 'catalogs.id', '=', 'posts.ref_id')
        ->leftjoin('kposts', 'posts.id', '=', 'kposts.post_id')
        ->where("catalogs.user_id","=",$user->id)
        ->where("kposts.user_id","=",auth()->id())
        ->where("posts.type_id","=",21)
        ->orderBy('kposts.featured','DESC')
        ->latest('posts.created_at')
        ->select('catalogs.*','kposts.featured')
        ->paginate(6);      

      return view('catalogs.show',compact('catalogs'));
    }
    else
    {
      $posts = Post 
        ::leftjoin('kposts', 'posts.id', '=', 'kposts.post_id')
        ->where("kposts.user_id","=",auth()->id())       
        ->where("posts.user_id","=",$user->id)
        ->where("type_id","=",21)
        ->title($request->get('title'))
        ->orderBy('kposts.featured','DESC')
        ->latest('posts.created_at')
        ->select('posts.*','kposts.featured')
        ->paginate(12);

      $title = __('messages.created-catalogs-by')." ".$user->name;   
      $root = "created_catalogs";
      $buttons = "posts.buttons.created_catalogs"; 
      $subtitle = "";

      return view(get_view('catalogs'),compact(
        'posts','title','root','buttons','subtitle')); 
    }
  }

  public function show_catalog(Catalog $catalog)
  {
    $posts = $catalog->posts()
      ->leftjoin('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("kposts.user_id","=",auth()->id())
      ->orderBy('kposts.featured','DESC')
      ->latest('posts.created_at')
      ->select('posts.*','kposts.featured')
      ->paginate(12);

    $title = $catalog->name; 
    $root = "catalog";
    $ref_id = $catalog->id;
    $buttons = "posts.buttons.catalog_posts";
    $subtitle = "";

    return view(get_view(),compact(
        'posts','title','root','ref_id','catalog','buttons','subtitle'));

  	//return view('catalogs.catalog_show',compact('catalog','posts'));
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
