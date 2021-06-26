<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Post;

class PagesPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post; 
        $post->title = "Página de Jorge";
        $post->excerpt = "Página";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 22;
        $post->ref_id = 1;
        $post->user_id = 1;
        $post->save();

        $post = new Post; 
        $post->title = "Página de Peter";
        $post->excerpt = "Página";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 22;
        $post->ref_id = 2;
        $post->user_id = 2;
        $post->save();

        $post = new Post; 
        $post->title = "New Wave";
        $post->excerpt = "Página";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 22;
        $post->ref_id = 3;
        $post->user_id = 2;
        $post->save();

        $post = new Post; 
        $post->title = "The Cure";
        $post->excerpt = "Página";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 22;
        $post->ref_id = 4;
        $post->user_id = 2;
        $post->save();

        $post = new Post; 
        $post->title = "Queen";
        $post->excerpt = "Página";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 22;
        $post->ref_id = 5;
        $post->user_id = 1;
        $post->save();

        $post = new Post; 
        $post->title = "Laravel";
        $post->excerpt = "Página";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 22;
        $post->ref_id = 6;
        $post->user_id = 1;
        $post->save();

        $post = new Post; 
        $post->title = "Frontend";
        $post->excerpt = "Página";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 22;
        $post->ref_id = 7;
        $post->user_id = 1;
        $post->save();

        /* QUITAR ESTO (OJO)
        $post = new Post; 
        $post->title = "Página de Peter";
        $post->excerpt = "Subscripción";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 23;
        $post->ref_id = 2;
        $post->user_id = 1;
        $post->save();

        $post = new Post; 
        $post->title = "Página de Jorge";
        $post->excerpt = "Subscripción";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 23;
        $post->ref_id = 1;
        $post->user_id = 2;
        $post->save();
        */
    }
}
