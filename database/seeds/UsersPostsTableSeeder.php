<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Post;

class UsersPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post; //11
        $post->title = "Jorge Servin";
        $post->excerpt = "Perfil";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 24;
        $post->ref_id = 1;
        $post->user_id = 1;
        $post->save();

        $post = new Post; //12
        $post->title = "Peter Dexter";
        $post->excerpt = "Perfil";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 24;
        $post->ref_id = 2;
        $post->user_id = 2;
        $post->save();

        $post = new Post; //13
        $post->title = "Alejandro Gomez";
        $post->excerpt = "Perfil";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 24;
        $post->ref_id = 3;
        $post->user_id = 3;
        $post->save();

        $post = new Post; //14
        $post->title = "Carlos Gomez";
        $post->excerpt = "Perfil";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 24;
        $post->ref_id = 4;
        $post->user_id = 4;
        $post->save();

        $post = new Post; //15
        $post->title = "Luis Diaz";
        $post->excerpt = "Perfil";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 24;
        $post->ref_id = 5;
        $post->user_id = 5;
        $post->save();

        $post = new Post; //16
        $post->title = "Alfredo Gomez";
        $post->excerpt = "Perfil";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 24;
        $post->ref_id = 6;
        $post->user_id = 6;
        $post->save();
    }
}
