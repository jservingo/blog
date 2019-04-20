<?php

use Illuminate\Database\Seeder;
use App\Page;
use App\Category;
use App\Catalog;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = new Page();  //1
        $page->name = 'Página de Jorge';
        $page->user_id = 1;
        $page->save();
        //Subscripciones a páginas
        $page->subscribers()->attach(2);

        $cat = new Category();
        $cat->name = 'General';
        $cat->page_id = 1;
        $cat->save();        
        //Catálogos  de Jorge
        $cat->catalogs()->attach(1, array('user_id' => 1));
        $cat->catalogs()->attach(2, array('user_id' => 1));
        $cat->catalogs()->attach(3, array('user_id' => 1));
        $cat->catalogs()->attach(4, array('user_id' => 1));

        $page = new Page(); //2
        $page->name = 'Página de Peter';
        $page->user_id = 2;
        $page->save();
        //Subscripciones a páginas
        $page->subscribers()->attach(1);

        $cat = new Category();
        $cat->name = 'General';
        $cat->page_id = 2;
        $cat->save();
        //Catálogos de Peter
        $cat->catalogs()->attach(5, array('user_id' => 2));

        $page = new Page(); //3
        $page->name = 'New Wave';
        $page->user_id = 1;
        $page->app_id = 1;
        $page->save();

        $cat = new Category();
        $cat->name = 'General';
        $cat->page_id = 3;
        $cat->save();

        $page = new Page(); //4
        $page->name = 'The Cure';
        $page->user_id = 1;
        $page->app_id = 1;
        $page->save();

        $cat = new Category();
        $cat->name = 'Discografía';
        $cat->page_id = 4;
        $cat->save();

        $page = new Page(); //5
        $page->name = 'Queen';
        $page->user_id = 1;
        $page->app_id = 1;
        $page->save();

        $cat = new Category();
        $cat->name = 'Discografía';
        $cat->page_id = 5;
        $cat->save();

        $page = new Page(); //6
        $page->name = 'Laravel';
        $page->user_id = 1;
        $page->app_id = 5;
        $page->save();

        $cat = new Category();
        $cat->name = 'General';
        $cat->page_id = 6;
        $cat->save();

        $page = new Page(); //7
        $page->name = 'Frontend';
        $page->user_id = 1;
        $page->app_id = 5;
        $page->save(); 

        $cat = new Category();
        $cat->name = 'General';
        $cat->page_id = 7;
        $cat->save();       
    }
}
