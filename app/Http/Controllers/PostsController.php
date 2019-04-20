<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Catalog;
use App\Kpost;
use App\Post;
use App\Type;
use App\Tag;

class PostsController extends Controller
{
  public function show(Post $post)
  {
  	if ($post->isPublished() || auth()->check())
  	{
  		return view(get_view(),compact('post'));
  	}

  	abort (404);
  }

  public function show_received($status_id=0,$type=0)
  {
  	//Falta el type ***OJO***
    $posts = Post
  		::join('kposts', 'posts.id', '=', 'kposts.post_id')
  		->where("status_id","=",$status_id)
  		->where("kposts.user_id","=",auth()->id())
      ->select('posts.*')
      ->latest('kposts.created_at')
  		->paginate(12);	
      
    switch ($status_id)
    {
      case 0:
        $title = "Received posts";
        $root = 'received_posts';
        $buttons = "posts.buttons.received_posts";
        break;
      case 1:
        $title = "Discarded posts";
        $root = "discarded_posts";
        $buttons = "posts.buttons.discarded_posts";
        break;
      case 2:
        $title = "Saved posts";
        $root = 'saved_posts';
        $buttons = "posts.buttons.saved_posts";
        break;
    }

    $subtitle = "";

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_sent($type=0)
  {   
    //Falta el type ***OJO***
    //Falta posts.buttons.sent_posts
    $posts = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("kposts.sent_by","=",auth()->id())
      ->select('posts.*')
      ->latest('kposts.created_at')
      ->paginate(12);  

    $title = "Sent posts";
    $root = "sent_posts";
    $buttons = "posts.buttons.sent_posts";
    $subtitle = "";     

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_created($type=0)
  {  	
  	//Falta el type ***OJO***
    $posts = Post  //::join('kposts', 'posts.id', '=', 'kposts.post_id')  		
  		::where("posts.user_id","=",auth()->id())
      ->latest('posts.created_at')
  		->paginate(12);

    $title = "Created posts";
    $root = "created_posts";
    $buttons = "posts.buttons.created_posts"; 
    $subtitle = "";	

  	return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_recent()
  {   
    if(isset($_COOKIE['recentviews']))
    {
      $recentviews = $_COOKIE['recentviews']; 
      $recent = explode(',',$recentviews);

      $posts = Post
        ::whereIn('id', $recent)
        ->orderByRaw(\DB::raw("FIELD(id, ".$recentviews.")"))
        ->paginate(12);
    }
    else
    {
      $posts = Post
        ::where('type_id',"=",99)
        ->paginate(12);
    }

    $title = "Recently viewed";
    $root = "created_posts";
    $buttons = "posts.buttons.created_posts"; 
    $subtitle = "";    

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_post(Post $post)
  {
    return view('posts.show_post',compact('post'));
  }

  public function store(Request $request)
  {
    //$this->authorize('create', new Post);

    $this->validate($request, [
      'title' => 'required',
      'type_id' => 'required',
      'published_at' => Carbon::now()
    ]);
    
    $post = Post::create([
      'title' => $request->get('title'),
      'type_id' => $request->get('type_id'),
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

  public function edit(Post $post)
  {
    //$this->authorize('update',$post);

    return view('posts.edit_post',[
      'post' => $post,
      'tags' => Tag::all(),
      'types' => Type::all()
    ]);
  }

  public function update(Post $post, Request $request)
  {
    $this->authorize('update',$post);

    //Validación del post
    $this->validate($request, [
        'title' => 'required',
        'body' => 'required',
        'type_id' => 'required',
        'excerpt' => 'required'
        ]);

    $post->title = $request->get('title');
    $post->excerpt = $request->get('excerpt');
    $post->body = $request->get('body');
    $post->url = $request->get('url');
    $post->iframe = $request->get('iframe');    
    $post->published_at = Carbon::parse($request->get('published_at'));
    $post->rating_mode = $request->get('rating_mode');    
    $post->cstr_privacy = $request->get('cstr_privacy');
    $post->cstr_restricted = $request->get('cstr_restricted');
    $post->cstr_allow_comments = $request->get('cstr_allow_comments');
    $post->cstr_colaborative = $request->get('cstr_colaborative');
    $post->save();

    //Eliminar tags del post
    $post->tags()
      ->wherePivot('post_id', '=', $post->id)
      ->wherePivot('user_id', '=', auth()->id())
      ->detach();
    
    //Agregar tags al post
    $tags = explode(',',$request->get('tags'));
    if(!empty($tags))
    {
      foreach ($tags as $tag_str)
      {
        $tag = Tag::where('name', trim($tag_str))->first();
        if($tag)
          $post->tags()->attach($tag->id, array('user_id' => auth()->id()));
      }
    }  

    if ($post->kpost)
    {
      $kpost = $post->kpost;
      $kpost->observation = $request->get('observation');
      $kpost->footnote = $request->get('footnote');
      $kpost->featured = $request->get('featured');  
      $kpost->save();
    }  

    if ($post->isCatalog())
    {
      $catalog = $post->catalog;
      if ($catalog)
      {
        $catalog->name = $post->title;
        $catalog->cstr_privacy = $post->cstr_privacy;
        $catalog->cstr_restricted = $post->cstr_restricted;
        $catalog->cstr_colaborative = $post->cstr_colaborative;
        $catalog->save();
      }
    }

    if ($post->isPage())
    {
      $page = $post->page;
      if ($page)
      { 
        $page->name = $post->title; 
        $page->cstr_privacy = $post->cstr_privacy;
        $page->cstr_restricted = $post->cstr_restricted;
        $page->cstr_colaborative = $post->cstr_colaborative;
        $page->cstr_allow_subscribers = $request->get('cstr_allow_subscribers');
        $page->cstr_show_subscribers = $request->get('cstr_show_subscribers');
        $page->cstr_main_page = $request->get('cstr_main_page');
        $page->save();
      }
    }

    if ($post->isUser())
    {
      $user = $post->user;
      if ($user)
      { 
        //OJO Falta actualizar el usuario
      }
    }

    //$post->update($request->all()); //En el modelo post utilizar fillable
    //$post->tags()->sync($request->get('tags'));
    //return back()->with('flash','Tu aviso ha sido guardado');
    /*
    return redirect()
        ->route('admin.posts.edit', $post)
        ->with('flash','El aviso ha sido guardado');
    */
    echo json_encode(array('success'=>true));
  }

  public function update_likes(Post $post, $mode)
  {
    $kpost = $post->kpost;
    if (! $kpost)
    {
      echo json_encode(array('success'=>false,'msg'=>'Ud. debe guardar el post antes de realizar esta operación.'));
      return;
    }

    if ($mode=="up")
    {
      $kpost->rating_points = 1;
      $kpost->save();
      $post->rating_points = $post->rating_points + 1;
      $post->save();
    }
    else
    {
      $kpost->rating_points = 0;
      $kpost->save();
      $post->rating_points = $post->rating_points - 1;
      $post->save();
    }

    $likes = format_num($post->rating_points); 

    echo json_encode(array('success'=>true,'likes'=>$likes));      
  }

  public function save_post(Request $request)
  {
    //Obtener kpost asociado al post
    $post = Post::find($request->get('post_id'));
    $kpost = $post->kpost;

    if ($kpost)
    {
      //cambiar status del kpost
      $kpost->status_id = 2; 
      $kpost->save();
    }
    else
    {
      //crear kpost
      $kpost = Kpost::create([
        'post_id' => $post->id,
        'status_id' => 2,
        'user_id' => auth()->id(),
        'sent_by' => auth()->id(),
        'sent_at' => Carbon::now()
      ]);    
    } 

    echo json_encode(array('success'=>true));  
  }

  public function discard_post(Request $request)
  {
    //Obtener kpost asociado al post
    $post = Post::find($request->get('post_id'));
    $kpost = $post->kpost;

    if ($kpost)
    {
      //cambiar status del kpost
      $kpost->status_id = 1; 
      $kpost->save();
    }
    else
    {
      //crear kpost
      $kpost = Kpost::create([
        'post_id' => $post->id,
        'status_id' => 1,
        'user_id' => auth()->id(),
        'sent_by' => auth()->id(),
        'sent_at' => Carbon::now()
      ]);    
    } 

    echo json_encode(array('success'=>true));  
  }

  public function store_recent(Request $request)
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
        $post_id = $request->get('post_id');
        break;
      case 21:
      case 22:
      case 23:
      case 24:
      case 25:
        $ref_id = $request->get('ref_id');
        $post = Post
          ::where("type_id","=",$type_id)
          ->where("ref_id","=",$ref_id)
          ->first();
        $post_id = $post->id;  
        break;        
    }

    if(isset($_COOKIE['recentviews']))
    {
      $recentviews = $_COOKIE['recentviews']; 
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
    } 
    else 
    {
      $recentviews = $post_id;
    }

    // save the cookie
    setcookie('recentviews', $recentviews, time()+(86400*30));      

    echo json_encode(array('success'=>true));
  }

  public function delete_post_from_catalog(Catalog $catalog, Post $post)
  {
    if ($catalog->user_id != auth()->id() && $post->user_id != auth()->id())
    {
      echo json_encode(array('success'=>false,'msg'=>'Ud. no está autorizado para realizar esta operación.'));
      return;
    }

    $catalog->posts()->detach($post->id); 

    echo json_encode(array('success'=>true));  
  } 

  public function destroy(Post $post)
  {
    //$this->authorize('delete',$post);

    if ($post->user_id != auth()->id())
    {
      echo json_encode(array('success'=>false,'msg'=>'Ud. no está autorizado para realizar esta operación.'));
      return;
    }

    //OJO: Solo se puede eliminar el post si no ha sido
    //guardado por ningun otro usuario 

    if ($post->isCatalog())
    {
      echo json_encode(array('success'=>false,'msg'=>'Ud. no está autorizado para realizar esta operación.'));
      return;  
    }

    if ($post->isPage())
    {
      echo json_encode(array('success'=>false,'msg'=>'Ud. no está autorizado para realizar esta operación.'));
      return;  
    }    

    if ($post->isApp())
    {
      echo json_encode(array('success'=>false,'msg'=>'Ud. no está autorizado para realizar esta operación.'));
      return;  
    }

    if ($post->isUser())
    {
      echo json_encode(array('success'=>false,'msg'=>'Ud. no está autorizado para realizar esta operación.'));
      return;  
    }

    if ($post->isCompany())
    {
      echo json_encode(array('success'=>false,'msg'=>'Ud. no está autorizado para realizar esta operación.'));
      return;  
    }

    //Eliminar todos los tags
    if ($post->tags) 
      $post->tags()->detach();
      
    //Eliminar todas las fotos
    foreach ($post->photos as $photo)
    {
      $photo->delete();
      Storage::disk('public')->delete($photo->url);
    }

    //Eliminar kpost del post
    /*
    $kpost = Kpost
      ::where("post_id","=",$post->id)
      ->where("user_id","=",auth()->id())
      ->first(); 

    if ($kpost)
      $kpost->delete();  
    */

    $post->delete();

    /*
    return redirect()
      ->route('admin.posts.index')
      ->with('flash','El aviso ha sido eliminado');
    */

    echo json_encode(array('success'=>true));    
  }   
}
