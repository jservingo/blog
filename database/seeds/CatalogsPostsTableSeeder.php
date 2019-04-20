<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Post;

class CatalogsPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post; 
        $post->title = "Catálogo de Jorge";
        $post->excerpt = "Catálogo";
        $post->published_at = Carbon::now();
        $post->type_id = 21;
        $post->ref_id = 1;
        $post->user_id = 1;
        $post->save();

        $post = new Post; 
        $post->title = "Catálogo de Venezuela";
        $post->excerpt = "Catálogo";
        $post->published_at = Carbon::now();
        $post->type_id = 21;
        $post->ref_id = 2;
        $post->user_id = 1;
        $post->save();

        $post = new Post; 
        $post->title = "Catálogo de Musica";
        $post->excerpt = "Catálogo";
        $post->published_at = Carbon::now();
        $post->type_id = 21;
        $post->ref_id = 3;
        $post->user_id = 1;
        $post->save();

        $post = new Post; 
        $post->title = "Catálogo de Noticias";
        $post->excerpt = "Catálogo";
        $post->published_at = Carbon::now();
        $post->type_id = 21;
        $post->ref_id = 4;
        $post->user_id = 1;
        $post->save();

        $post = new Post; 
        $post->title = "Catálogo de Peter";
        $post->excerpt = "Catálogo";
        $post->published_at = Carbon::now();
        $post->type_id = 21;
        $post->ref_id = 5;
        $post->user_id = 2;
        $post->save();
    }
}
