<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Kpost;
use App\Page;
use App\Post;
use App\User;
use App\Tag;
use App\App;

class SubscriptionsController extends Controller
{
  public function show_subscriptions()
  {
    //Estas son las subscripciones a Pages    
    $posts_pages = Post
      ::join('pages', 'ref_id', '=', 'pages.id')
      ->join('page_user', 'pages.id', '=', 'page_user.page_id')
      ->where("type_id","=",22)
      ->where("page_user.user_id","=",auth()->id())
      ->orderBy('pages.name', 'asc')
      ->select('posts.*');

    //Estas son las subscripciones a Apps
    $posts_apps = Post
      ::join('apps', 'ref_id', '=', 'apps.id')
      ->join('app_user', 'apps.id', '=', 'app_user.app_id')
      ->where("type_id","=",23)
      ->where("app_user.user_id","=",auth()->id())
      ->where("apps.parent_id","=",null)
      ->orderBy('apps.name', 'asc')
      ->select('posts.*');
    
    $posts_apps->union($posts_pages);
    $querySql = $posts_apps->toSql();

    $query = Post::from(DB::raw("($querySql) as a"))->select('a.*')->addBinding($posts_apps->getBindings());
    $posts = $query->paginate(12); 

    $title = "Subscriptions";  
    $root = "subscriptions";
    $buttons = "posts.buttons.subscriptions";
    $subtitle = "";
    
    return view(get_view(),compact(
      'posts','title','root','buttons','subtitle'));

    /*
    $query = "
      ( SELECT P.*
        FROM posts P
          LEFT JOIN apps A ON (P.ref_id = A.id)  
          LEFT JOIN app_user U ON (A.id = U.app_id)
        WHERE 1 = 1
          AND P.type_id = 23
          AND U.user_id = {USER_ID}
          AND ISNULL(A.parent_id)

        UNION ALL

        SELECT P.*
        FROM posts P
          LEFT JOIN pages G ON (P.ref_id = G.id)
          LEFT JOIN page_user U ON (G.id = U.page_id)
        WHERE 1 = 1
          AND P.type_id = 22
          AND U.user_id = {USER_ID}
  
        
      ) AS VIEW_RESULT
    ";

    $user_id = auth()->id();
    $query = str_replace("{USER_ID}", $user_id, $query);
    $posts = DB::table(DB::raw($query))->paginate(4);
    $posts = \App\Post::hydrate($posts); 

    $pages = User
        ::find(auth()->id())
        ->subscriptions()
        ->orderBy('name', 'ASC')
        ->paginate();          

    return view('subscriptions.subscriptions_show',compact('pages'));
    */
  }

  public function add_subscription(Request $request)
  {
    $post_id = $request->get('post_id');
    $post = Post::find($post_id);

    if ($post->isPage())
    {
      $page_id = $post->ref_id;
      $page = Page::find($page_id);
      if (! $page->subscribers()->where('user_id', auth()->id())->exists())
        $page->subscribers()->attach(auth()->id());
    }
    elseif ($post->isApp())
    {
      $app_id = $post->ref_id;
      $app = App::find($app_id);
      if (! $app->subscribers()->where('user_id', auth()->id())->exists())
        $app->subscribers()->attach(auth()->id());
    }

    $kpost = Kpost::firstOrcreate([
      'post_id' => $post->id,
      'user_id' => auth()->id(),
      'sent_by' => auth()->id(),
      'sent_at' => Carbon::now() 
    ]);

    echo json_encode(array('success'=>true));
  }

  public function destroy(Post $post)
  {
    if ($post->type_id==22)
    {
      $page = Page::find($post->ref_id);

      $page->subscribers()
        ->wherePivot('user_id', '=', auth()->id())
        ->detach();
    }
    elseif ($post->type_id==23)
    {
      $app = App::find($post->ref_id);

      $app->subscribers()
        ->wherePivot('user_id', '=', auth()->id())
        ->detach();
    }

    //Eliminar kpost de la subscripcion
    $kpost = Kpost
      ::where("post_id","=",$post->id)
      ->where("user_id","=",auth()->id())
      ->first(); 

    if ($kpost)
      $kpost->delete(); 

    echo json_encode(array('success'=>true));
  } 
}
