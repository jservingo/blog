<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clipboard;
use App\Category;
use App\Catalog;
use App\Contact;
use App\Group;
use App\Kpost;
use App\Post;

class ClipboardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function copy_catalog(Request $request)
    {
        //Se obtiene el post asociado al catalogo
        $post = Post
            ::where("type_id","=",21)
            ->where("ref_id","=",$request->get('ref_id'))
            ->first();

        //Eliminar post del clipboard
        $res = Clipboard
            ::where("post_id","=",$post->id)
            ->where("user_id","=",auth()->id())
            ->delete();

        //Agregar post al clipboard
        $clipboard = Clipboard::create([
            'post_id' => $post->id,
            'user_id' => auth()->id()
        ]);

        echo json_encode(array('success'=>true));
    }

    public function copy_post(Request $request)
    {
        $post_id = $request->get('post_id');

        //Eliminar post del clipboard
        $res = Clipboard
            ::where("post_id","=",$post_id)
            ->where("user_id","=",auth()->id())
            ->delete();

        //Agregar post al clipboard
        $clipboard = Clipboard::create([
            'post_id' => $post_id,
            'user_id' => auth()->id()
        ]);

        echo json_encode(array('success'=>true));
    }

    public function paste_catalog_to_category(Request $request)
    {
        $category = Category::find($request->get('category_id'));
        $selected = $request->get('selected');

        foreach ($selected as $catalog_id)
        {
            //$catalog->posts->contains($post)
            //$catalog->posts()->where('post_id', $post_id)->exists()
            if (! $category->catalogs()->where('catalog_id', $catalog_id)->exists()) {
                $category->catalogs()->attach(
                    $catalog_id, 
                    array('user_id' => auth()->id())
                );
            }
        }
        echo json_encode(array('success'=>true));
    }

    public function paste_post_to_catalog(Request $request)
    {        
        $catalog = Catalog::find($request->get('catalog_id'));
        $selected = $request->get('selected');
        //$catalog->posts()->syncWithoutDetaching($selected);

        foreach ($selected as $post_id)
        {
            //$catalog->posts->contains($post)
            //$catalog->posts()->where('post_id', $post_id)->exists()
            if (! $catalog->posts()->where('post_id', $post_id)->exists()) {
                $catalog->posts()->attach(
                    $post_id, 
                    array('user_id' => auth()->id())
                );
            }
        }

        echo json_encode(array('success'=>true));
    }

    public function paste_post_to_contacts(Request $request)
    {        
        $user_id = auth()->id();
        $selected = $request->get('selected');

        foreach ($selected as $post_id)
        {
            $post = Post::find($post_id);
            $user_ref = $post->ref_id;
            $contact = Contact::firstOrCreate([
                'user_id' => $user_id,
                'user_ref' => $user_ref
                ]
            );
            //if ($request->has('group_id'))
            $group_id = $request->get('group_id');
            if ($group_id != 0) {
                $group = Group::find($group_id);
                if (! $group->contacts()->where('user_id', $user_ref)->exists()) {
                    $group->contacts()->attach($user_ref);
                }
            }
        }

        echo json_encode(array('success'=>true));
    }

    public function get_posts(){
        // Fetch all records
        $posts = Clipboard
            ::join('posts', 'clipboards.post_id', '=', 'posts.id')
            ->where("clipboards.user_id","=",auth()->id())
            ->latest('clipboards.created_at')
            ->select('posts.*')
            ->get();

        $result['rows'] = $posts;

        echo json_encode($result);
    }

    public function get_catalogs(){
        // Fetch all records
        $catalogs = Clipboard
            ::join('posts', 'clipboards.post_id', '=', 'posts.id')
            ->where("clipboards.user_id","=",auth()->id())
            ->where("posts.type_id","=",21)
            ->join('catalogs', 'posts.ref_id', '=', 'catalogs.id')  
            ->latest('clipboards.created_at')                      
            ->select('catalogs.*')
            ->get();

        $result['rows'] = $catalogs;

        echo json_encode($result);
    }

    public function get_contacts(){
        // Fetch all records
        $posts = Clipboard
            ::join('posts', 'clipboards.post_id', '=', 'posts.id')
            ->where("clipboards.user_id","=",auth()->id())
            ->where("posts.type_id","=",24)
            ->latest('clipboards.created_at')
            ->select('posts.*')
            ->get();

        $result['rows'] = $posts;

        echo json_encode($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
