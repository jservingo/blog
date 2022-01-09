<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Contact;
use App\Catalog;
use App\Kpost;
use App\Page;
use App\Post;
use App\Type;
use App\User;
use App\App;
use App\Tag;

class PostsController extends Controller
{

  public function export()
  {
    //Se excluyen todos los post de tipo Custom
    $posts = Post        
      ::where("type_id","<>",8)
      ->get();

    $fp = fopen("export/posts.csv", 'w');

    foreach($posts as $post)
    {
      $row = array( $post->id,
                    $post->title,
                    $post->excerpt,
                    $post->body,
                    $post->iframe,
                    $post->links,
                    $post->footnote,
                    $post->publish_at,
                    $post->user_id,
                    $post->type_id,
                    $post->ref_id,
                    $post->source,
                    $post->app_id,
                    $post->custom_type,
                    $post->url,
                    $post->likes,
                    $post->views,
                    $post->order_num,
                    $post->action_button_type,
                    $post->action_buttom_color,
                    $post->action_buttom_text,
                    $post->action_buttom_link,
                    $post->valid_from,
                    $post->valid_until,
                    $post->rating_mode,
                    $post->rating_points,
                    $post->rating_num,
                    $post->rating,
                    $post->sent_num,
                    $post->saved_num,
                    $post->cstr_privacy,
                    $post->cstr_restricted,
                    $post->cstr_colaborative,
                    $post->cstr_send_massive,
                    $post->cstr_allow_comments,
                    $post->created_at,
                    $post->updated_at
                  );
      fputcsv($fp, $row, ",");
    } 

    //move back to beginning of file
    fseek($fp, 0);
        
    //output all remaining data on a file pointer
    fpassthru($fp);
  }   

  public function discover(Request $request)
  {
    $posts = Post        
      ::where("posts.user_id","<>",auth()->id())
      ->where("type_id","<=",20)
      ->whereNotIn('id', function($query)
        {
          $query->select('post_id')
                ->from('kposts')
                ->where('user_id','=',auth()->id());
        })
      ->title($request->get('title'))
      ->published()
      ->latest('posts.published_at')
      ->paginate(12);

    $title = __('messages.discover-posts');   
    $root = "created_posts";
    $buttons = "posts.buttons.created_posts"; 
    $subtitle = "";

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show(Post $post)
  {
    //ELIMINAR ESTA FUNCION PORQUE YA NO SE USA (OJO)
  	if ($post->isPublished() || auth()->check())
  	{
  		return view(get_view(),compact('post'));
  	}

  	abort (404);
  }

  public function show_received($status_id=0,$type=0,Request $request)
  {
  	//Falta el type ***OJO***
    $posts = Post
  		::join('kposts', 'posts.id', '=', 'kposts.post_id')
  		->where("status_id","=",$status_id)
      ->where("kposts.sent_by","<>",auth()->id())
  		->where("kposts.user_id","=",auth()->id())
      ->title($request->get('title'))
      ->published()
      ->hide()      
      ->orderBy('kposts.featured','DESC')
      ->latest('posts.published_at')
      ->select('posts.*','kposts.featured')
  		->paginate(12);	
      
    switch ($status_id)
    {
      case 0:
        $title = __('messages.received-posts');
        $root = 'received_posts';
        $buttons = "posts.buttons.received_posts";
        break;
      case 1:
        $title = __('messages.discarded-posts');
        $root = "discarded_posts";
        $buttons = "posts.buttons.discarded_posts";
        break;
      case 2:
        $title = __('messages.saved-posts');
        $root = 'saved_posts';
        $buttons = "posts.buttons.saved_posts";
        break;
    }

    $subtitle = "";

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_sent($type=0,Request $request)
  {   
    //Falta el type ***OJO***
    //Falta posts.buttons.sent_posts
    $posts = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("kposts.sent_by","=",auth()->id())
      ->where("kposts.user_id","<>",auth()->id())
      ->hide()
      ->title($request->get('title'))
      ->orderBy('kposts.featured','DESC')
      ->latest('posts.published_at')
      ->select('posts.*','kposts.featured')
      ->paginate(12);  

    $title = __('messages.sent-posts');
    $root = "sent_posts";
    $buttons = "posts.buttons.sent_posts";
    $subtitle = "";     

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_all($type=0,Request $request)
  { 
    $posts_created = Post  
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("kposts.user_id","=",auth()->id())
      ->where("posts.user_id","=",auth()->id())
      ->where("type_id","<=",20)
      ->hide()
      ->title($request->get('title'))
      ->select('posts.*','featured');

    $posts_saved = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where(function ($query) use ($request) {
          $query->where("type_id","<=",20)
                ->orWhere("type_id","=",24);
        })
      ->where("status_id","=",2)
      ->where("kposts.sent_by","=",auth()->id())
      ->where("kposts.user_id","=",auth()->id()) 
      ->published() 
      ->hide()
      ->title($request->get('title'))
      ->select('posts.*','featured');

    $posts_created->union($posts_saved);
    $querySql = $posts_created->toSql();

    $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts_created->getBindings());
    $posts = $query->orderBy('featured','DESC')->latest('published_at')->paginate(12); 

    $title = __('messages.posts');
    $root = "created_posts";
    $buttons = "posts.buttons.created_posts"; 
    $subtitle = ""; 
      
    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_created($type=0,Request $request)
  {  	
  	//Falta el type ***OJO***
    //OJO: Se quito hide()
    $posts = Post  
  		::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("posts.user_id","=",auth()->id())
      ->where("kposts.user_id","=",auth()->id())
      ->where("posts.type_id","<=",20)  
      ->title($request->get('title'))    
      ->orderBy('kposts.featured','DESC')
      ->latest('posts.published_at')
      ->select('posts.*','kposts.featured')
      ->paginate(12);

    $title = __('messages.created-posts');
    $root = "created_posts";
    $buttons = "posts.buttons.created_posts"; 
    $subtitle = "";	

  	return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_created_by_user(User $user, $type=0, Request $request)
  {   
    //Falta el type ***OJO***
    $posts_saved = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')        
      ->where("posts.user_id","=",$user->id)
      ->where("kposts.user_id","=",auth()->id())
      ->where(function ($query) use ($request) {
          $query->where("type_id","<=",20)
                ->orWhere("type_id","=",24);
        })
      ->published()
      ->hide()
      ->title($request->get('title'))
      ->select('posts.*','kposts.featured', 'kposts.order_num as position');

    $posts_created = Post
      ::where("user_id","=",$user->id)
      ->where("type_id","<=",20)
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

    $title = __('messages.created-posts-by')." ".$user->name;
    $root = "created_posts";
    $buttons = "posts.buttons.created_posts"; 
    $subtitle = ""; 

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_notifications(Request $request)
  {
    $posts = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("status_id","=",0)
      ->where("kposts.user_id","=",auth()->id())
      ->where("kposts.sent_by","<>",auth()->id())
      ->where("posts.type_id", "=", 4)
      ->title($request->get('title'))
      ->published()
      ->hide()
      ->orderBy('kposts.featured','DESC')
      ->latest('posts.published_at')
      ->select('posts.*','kposts.featured')
      ->paginate(12); 

    $title = __('messages.notifications');
    $root = 'notifications';
    $buttons = "posts.buttons.received_posts";
    $subtitle = "";

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_alerts(Request $request)
  {
    $posts = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where("status_id","=",0)
      ->where("kposts.user_id","=",auth()->id())
      ->where("kposts.sent_by","<>",auth()->id())
      ->where("posts.type_id", "=", 6)
      ->title($request->get('title'))
      ->published()
      ->hide()
      ->orderBy('kposts.featured','DESC')
      ->latest('posts.published_at')
      ->select('posts.*','kposts.featured')
      ->paginate(12); 

    $title = __('messages.alerts');
    $root = 'alerts';
    $buttons = "posts.buttons.received_posts";
    $subtitle = "";

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_alerts_notifications(Request $request)
  {
    $posts = Post
      ::join('kposts', 'posts.id', '=', 'kposts.post_id')
      ->where(function ($query) use ($request) {
          $query->where("status_id","=",0)
                ->where("kposts.user_id","=",auth()->id())
                ->where("kposts.sent_by","<>",auth()->id())
                ->where("posts.type_id", "=", 4)
                ->title($request->get('title'));
      })->orWhere(function ($query) use ($request) {
          $query->where("status_id","=",0)
                ->where("kposts.user_id","=",auth()->id())
                ->where("kposts.sent_by","<>",auth()->id())
                ->where("posts.type_id", "=", 6)
                ->title($request->get('title'));
      })  
      ->published()
      ->hide()
      ->orderBy('kposts.featured','DESC')
      ->latest('posts.published_at')
      ->select('posts.*','kposts.featured')
      ->paginate(12); 

    $title = __('messages.alerts-notifications');
    $root = 'alerts';
    $buttons = "posts.buttons.received_posts";
    $subtitle = "";

    return view(get_view(),compact('posts','title','root','buttons','subtitle'));
  }

  public function show_post(Post $post)
  {
    return view('posts.show_post',compact('post'));
  }

  public function show_user(User $user)
  {
    $post = $user->post;
    return view('posts.show_post',compact('post'));
  }

  public function show_iframe(Post $post)
  {
    //$this->authorize('update',$post);

    return view('posts.show_iframe',[
      'post' => $post,
      'tags' => Tag::all(),
      'types' => Type::all()
    ]);
  }

  public function store(Request $request)
  {
    //$this->authorize('create', new Post);

    $this->validate($request, [
      'title' => 'required',
      'type_id' => 'required',
      'published_at' => Carbon::now('UTC')
    ]);
    
    $post = Post::create([
      'title' => $request->get('title'),
      'type_id' => $request->get('type_id'),
      'user_id' => auth()->id(),
      'published_at' => Carbon::now('UTC')
    ]);

    $kpost = Kpost::create([
      'post_id' => $post->id,
      'user_id' => auth()->id(),
      'sent_by' => auth()->id(),
      'sent_at' => Carbon::now('UTC') 
    ]);

    $catalog_id = $request->get('catalog_id');
    if ($catalog_id !=0 )
    {
      $catalog = Catalog::find($catalog_id);
      $catalog->posts()->attach(
        $post->id, 
        array('user_id' => auth()->id())
      );
    }

    echo json_encode(array('success'=>true,'post_id'=>$post->id));
  }

  public function edit_footer(Post $post)
  {
    //$this->authorize('update',$post);

    return view('posts.edit_footer',[
      'post' => $post,
      'tags' => Tag::all(),
      'types' => Type::all()
    ]);
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

  public function update_footer(Post $post, Request $request)
  {
    $kpost = $post->kpost;
    $kpost->excerpt = $request->get('excerpt');
    $kpost->observation = $request->get('observation');
    $kpost->footnote = $request->get('footnote');
    $kpost->featured = $request->get('featured'); 
    $kpost->hide = $request->get('hide');
    $kpost->order_num = $request->get('order_num'); 
    $kpost->save();

    echo json_encode(array('success'=>true));
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
    $body = $request->get('body');
    if ($post->source == "@fmath")
    {
      $body = html_entity_decode($body);
      $body = str_replace("<br />","",$body);
      $body = str_replace("<p>","",$body);
      $body = str_replace("</p>","",$body);
    }
    $post->body = $body;
    $post->url = $request->get('url');
    $post->iframe = $request->get('iframe'); 
    if ($post->user_id == auth()->id())
    {
      $post->footnote = $request->get('footnote');
    }  
    $post->order_num = $request->get('order_num');
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
        if (strlen($tag_str) >= 3)
        {
          $tag_str = trim(preg_replace('/\s+/', '', $tag_str));
          $tag = Tag::where('name', $tag_str)->first();
          if($tag)
          {
            if (! $post->tags->contains($tag->id))
              $post->tags()->attach($tag->id, array('user_id' => auth()->id()));
          }
          else
          {
            $tag = Tag::create([
              'name' => $tag_str
            ]);
            $post->tags()->attach($tag->id, array('user_id' => auth()->id()));
          }
        }
      }
    }  

    if ($post->kpost)
    {
      $kpost = $post->kpost;
      $kpost->observation = $request->get('observation');
      $kpost->footnote = $request->get('footnote');
      $kpost->featured = $request->get('featured'); 
      $kpost->hide = $request->get('hide');
      $kpost->order_num = $request->get('order_num'); 
      $kpost->save();
    }  

    if ($post->isCatalog())
    {
      $catalog = $post->catalog;
      if ($catalog)
      {
        $catalog->name = $post->title;
        $catalog->save();
      }
    }

    if ($post->isPage())
    {
      $page = $post->page;
      if ($page)
      { 
        $page->name = $post->title; 
        $page->cstr_allow_subscribers = $request->get('cstr_allow_subscribers');
        $page->cstr_show_subscribers = $request->get('cstr_show_subscribers');
        $page->cstr_main_page = $request->get('cstr_main_page');
        $page->save();
      }
    }

    if ($post->isApp())
    {
      $app = $post->app;
      if ($app)
      { 
        $app->name = $post->title; 
        $app->save();
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
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;
    }

    if ($mode=="up")
    {
      $kpost->likes = 1;
      $kpost->save();
      $post->likes = $post->likes + 1;
      $post->save();
    }
    else
    {
      $kpost->likes = 0;
      $kpost->save();
      $post->likes = $post->likes - 1;
      $post->save();
    }

    $likes = format_num($post->likes); 

    echo json_encode(array('success'=>true,'likes'=>$likes));      
  }

  public function isOwner(Post $post)
  {
    if ($post->user_id == auth()->id())
      $response = "Y";
    else
      $response = "N";

    echo json_encode(array('success'=>true,'response'=>$response));
  }

  public function isSaved(Post $post)
  {
    if ($post->kpost)
      $response = "Y";
    else
      $response = "N";

    echo json_encode(array('success'=>true,'response'=>$response));
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
        'order_num' => $post->order_num,
        'status_id' => 2,
        'user_id' => auth()->id(),
        'sent_by' => auth()->id(),
        'sent_at' => Carbon::now('UTC')
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
        'sent_at' => Carbon::now('UTC')
      ]);    
    } 

    echo json_encode(array('success'=>true));  
  }

  public function delete_post_from_catalog(Catalog $catalog, Post $post)
  {
    if ($catalog->user_id != auth()->id() && $post->user_id != auth()->id())
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;
    }

    $catalog->posts()->detach($post->id); 

    echo json_encode(array('success'=>true));  
  } 

  public function destroy(Post $post)
  {
    //$this->authorize('delete',$post);

    //Eliminar kpost si el post no le pertenece al usuario
    //Advertir si el post fue agregado a un catálogo del usuario (OJO)
    if ($post->user_id != auth()->id())
    {
      //Obtener kpost asociado al post si fue guardado
      $kpost = $post->kpost;
      //Eliminar el kpost
      if ($kpost)
        $kpost->delete();

      echo json_encode(array('success'=>true));
      return;
    }

    //OJO: Solo se puede eliminar el post si no ha sido
    //guardado por ningun otro usuario 

    if ($post->isCatalog())
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;  
    }

    if ($post->isPage())
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;  
    }    

    if ($post->isApp())
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;  
    }

    if ($post->isUser())
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
      return;  
    }

    if ($post->isCompany())
    {
      echo json_encode(array('success'=>false,'msg'=>__('messages.you-are-not-authorized')));
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
