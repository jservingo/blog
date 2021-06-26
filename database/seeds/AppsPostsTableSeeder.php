<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Post;

class AppsPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post; 
        $post->title = "Komusic";
        $post->excerpt = "App";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 23;
        $post->ref_id = 1;
        $post->user_id = 1;
        $post->save();

        $post = new Post; 
        $post->title = "Kopedia";
        $post->excerpt = "App";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 23;
        $post->ref_id = 2;
        $post->user_id = 1;
        $post->save();

        $post = new Post; 
        $post->title = "Tecnología";
        $post->excerpt = "App";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 23;
        $post->ref_id = 3;
        $post->user_id = 1;
        $post->save();

        $post = new Post; 
        $post->title = "Educación";
        $post->excerpt = "App";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 23;
        $post->ref_id = 4;
        $post->user_id = 1;
        $post->save();

        $post = new Post; 
        $post->title = "Software Developing";
        $post->excerpt = "App";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 23;
        $post->ref_id = 5;
        $post->user_id = 1;
        $post->save();

        $post = new Post; 
        $post->title = "Marketing";
        $post->excerpt = "App";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 23;
        $post->ref_id = 6;
        $post->user_id = 1;
        $post->save();

        $post = new Post; 
        $post->title = "Hosting";
        $post->excerpt = "App";
        $post->published_at = Carbon::now('UTC');
        $post->type_id = 23;
        $post->ref_id = 7;
        $post->user_id = 1;
        $post->save();
    }
}
