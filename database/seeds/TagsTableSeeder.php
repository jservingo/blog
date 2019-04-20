<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tags
        $tag = new Tag;
        $tag->name = "Venezuela"; // 1
        $tag->save();

        $tag = new Tag;
        $tag->name = "Musica"; // 2
        $tag->save();

        $tag = new Tag;
        $tag->name = "Arte"; // 3
        $tag->save();

        $tag = new Tag;
        $tag->name = "Noticias"; // 4
        $tag->save();    
    }
}
