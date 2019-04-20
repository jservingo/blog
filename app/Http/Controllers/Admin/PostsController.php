<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Catalog;
use App\Post;
use App\Type;
use App\Tag;

class PostsController extends Controller
{
    public function index()
    {
        //No se utiliza PostPolicy (se quitó before)
        if (auth()->user()->hasPermissionTo('view_posts'))
        {
    	    $posts = Post::all();
    	    return view('admin.posts.index',compact('posts'));
        }
        else
        {
            $posts = auth()->user()->posts;
            return view('admin.posts.index',compact('posts'));
        }
    }

    public function store(Request $request)
    {
        $this->authorize('create', new Post);

        $this->validate($request, ['title' => 'required']);
        //$post = Post::create(['title' => $request->get('title')]);
        $post = Post::create([
            'title' => $request->get('title'),
            'user_id' => auth()->id()
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $this->authorize('update',$post);

        /*
        $types = Type::all();
        $tags = Tag::all();
        return view('admin.posts.edit',compact('post','types','tags'));
        */

        return view('admin.posts.edit',[
            'post' => $post,
            'tags' => Tag::all(),
            'types' => Type::all()
        ]);
    }

    public function update(Post $post, Request $request)
    {
        $this->authorize('update',$post);

        /* Validación del post (NO HACE FALTA)
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'type_id' => 'required',
            'excerpt' => 'required'
            ]);
        */

        /*
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->iframe = $request->get('iframe');
        $post->excerpt = $request->get('excerpt');
        $post->published_at = Carbon::parse($request->get('published_at'));
        $post->type_id = $request->get('type_id');
        $post->save();
        */
        
        $post->update($request->all()); //En el modelo post utilizar fillable
        
        /* OJO VOLVER A PONER
        $post->tags()->sync($request->get('tags'));
        */

        //return back()->with('flash','Tu aviso ha sido guardado');
        
        return back();

        /*
        return redirect()
            ->route('admin.posts.edit', $post)
            ->with('flash','El aviso ha sido guardado');
        */
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);

        //Eliminar todos los tags
        $post->tags()->detach();
        
        //Eliminar todas las fotos
        foreach ($post->photos as $photo)
        {
            $photo->delete();
            Storage::disk('public')->delete($photo->url);
        }

        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('flash','El aviso ha sido eliminado');
    }

    /*
    public function store(Request $request)
    {
    	//return $request->all();

    	//Validación del post
    	$this->validate($request, [
    		'title' => 'required',
    		'body' => 'required',
    		'type' => 'required',
    		'excerpt' => 'required'
    		]);

    	$post = new Post();
    	$post->title = $request->get('title');
    	$post->body = $request->get('body');
    	$post->excerpt = $request->get('excerpt');
    	$post->published_at = Carbon::parse($request->get('published_at'));
    	$post->type_id = $request->get('type');
    	$post->save();

    	$post->tags()->attach($request->get('tags'));
    	return back()->with('flash','Tu aviso fue registrado');
    }
    */

    /* Se dejo de utilizar 
    public function create()
    {
        $types = Type::all();
        $tags = Tag::all();
        return view('admin.posts.create',compact('types','tags'));
    }
    */
}
