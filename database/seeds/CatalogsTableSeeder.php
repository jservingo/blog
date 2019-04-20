<?php

use Illuminate\Database\Seeder;
use App\Catalog;

class CatalogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = new Catalog();
        $cat->name = 'Catálogo de Jorge'; // 1
        $cat->user_id = 1;
        $cat->save();
        $cat->posts()->attach(1, array('user_id' => 1));
        $cat->posts()->attach(2, array('user_id' => 1));
        $cat->posts()->attach(3, array('user_id' => 1));
        $cat->posts()->attach(4, array('user_id' => 1));
        $cat->posts()->attach(5, array('user_id' => 1));
        $cat->posts()->attach(6, array('user_id' => 1));
        $cat->posts()->attach(7, array('user_id' => 1));
        $cat->posts()->attach(8, array('user_id' => 1));

        $cat = new Catalog();
        $cat->name = 'Catálogo de Venezuela'; // 2
        $cat->user_id = 1;
        $cat->save();
        $cat->posts()->attach(1, array('user_id' => 1));
        $cat->posts()->attach(7, array('user_id' => 1));

        $cat = new Catalog();
        $cat->name = 'Catálogo de Musica'; // 3
        $cat->user_id = 1;
        $cat->save();
        $cat->posts()->attach(2, array('user_id' => 1));
        $cat->posts()->attach(5, array('user_id' => 1));
        $cat->posts()->attach(6, array('user_id' => 1));

        $cat = new Catalog();
        $cat->name = 'Catálogo de Noticias'; // 4
        $cat->user_id = 1;
        $cat->save();
        $cat->posts()->attach(3, array('user_id' => 1));
        $cat->posts()->attach(4, array('user_id' => 1));
        $cat->posts()->attach(8, array('user_id' => 1));

        $cat = new Catalog();
        $cat->name = 'Catálogo de Peter'; // 5
        $cat->user_id = 2;
        $cat->save();
        $cat->posts()->attach(9, array('user_id' => 2));
        $cat->posts()->attach(10, array('user_id' => 2));
    }
}
