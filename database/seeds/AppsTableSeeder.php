<?php

use Illuminate\Database\Seeder;
use App\App;

class AppsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $app = new App();  //1
        $app->name = 'Komusic';
        $app->user_id = 1;
        $app->parent_id = null;
        $app->save();
        //Subscripciones a la app
        $app->subscribers()->attach(1);
        $app->subscribers()->attach(2);

        $app = new App();  //2
        $app->name = 'Kopedia';
        $app->user_id = 1;
        $app->parent_id = null;
        $app->save();
        //Subscripciones a la app
        $app->subscribers()->attach(1);
        $app->subscribers()->attach(2);

        $app = new App();  //3
        $app->name = 'Tecnologia';
        $app->user_id = 1;
        $app->parent_id = 2;
        $app->save();
        //Subscripciones a la app
        $app->subscribers()->attach(1);
        $app->subscribers()->attach(2);

        $app = new App();  //4
        $app->name = 'Educación';
        $app->parent_id = 2;
        $app->user_id = 1;
        $app->save();
        //Subscripciones a la app
        $app->subscribers()->attach(1);
        $app->subscribers()->attach(2);

        $app = new App();  //5
        $app->name = 'Software Development';
        $app->parent_id = 3;
        $app->user_id = 1;
        $app->save();
        //Subscripciones a la app
        $app->subscribers()->attach(1);
        $app->subscribers()->attach(2);

        $app = new App();  //6
        $app->name = 'Marketing';
        $app->parent_id = 3;
        $app->user_id = 1;
        $app->save();
        //Subscripciones a la app
        $app->subscribers()->attach(1);
        $app->subscribers()->attach(2);

        $app = new App();  //7
        $app->name = 'Hosting';
        $app->parent_id = 3;
        $app->user_id = 1;
        $app->save();
        //Subscripciones a la app
        $app->subscribers()->attach(1);
        $app->subscribers()->attach(2);
    }
}
