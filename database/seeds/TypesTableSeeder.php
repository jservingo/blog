<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new Type;
    	$type->name = "Photo gallery"; // 1
    	$type->save();

    	$type = new Type;
    	$type->name = "iframe"; // 2
    	$type->save();

        $type = new Type;
        $type->name = "Text"; // 3
        $type->save();

        $type = new Type;
        $type->name = "Notification"; // 4
        $type->save();

        $type = new Type;
        $type->name = "Web page"; // 5
        $type->save();

        $type = new Type;
        $type->name = "Reserved 6"; // 6
        $type->save();

        $type = new Type;
        $type->name = "Reserved 7"; // 7
        $type->save();

        $type = new Type;
        $type->name = "Reserved 8"; // 8
        $type->save();

        $type = new Type;
        $type->name = "Reserved 9"; // 9
        $type->save();

        $type = new Type;
        $type->name = "Reserved 10"; // 10
        $type->save();

        $type = new Type;
        $type->name = "Reserved 11"; // 11
        $type->save();

        $type = new Type;
        $type->name = "Reserved 12"; // 12
        $type->save();

        $type = new Type;
        $type->name = "Reserved 13"; // 13
        $type->save();

        $type = new Type;
        $type->name = "Reserved 14"; // 14
        $type->save();

        $type = new Type;
        $type->name = "Reserved 15"; // 15
        $type->save();

        $type = new Type;
        $type->name = "Reserved 16"; // 16
        $type->save();

        $type = new Type;
        $type->name = "Reserved 17"; // 17
        $type->save();

        $type = new Type;
        $type->name = "Reserved 18"; // 18
        $type->save();

        $type = new Type;
        $type->name = "Reserved 19"; // 19
        $type->save();

        $type = new Type;
        $type->name = "Reserved 20"; // 20
        $type->save();
    	
        $type = new Type;
        $type->name = "Catalog"; // 21
        $type->save();

        $type = new Type;
        $type->name = "Page"; // 22
        $type->save();

        $type = new Type;
        $type->name = "App"; // 23
        $type->save();        

        $type = new Type;
        $type->name = "User"; // 24
        $type->save();

        $type = new Type;
        $type->name = "Company"; // 25
        $type->save();

        $type = new Type;
        $type->name = "Offer"; // 26
        $type->save();

        $type = new Type;
        $type->name = "Custom"; // 27
        $type->save();
    }
}
