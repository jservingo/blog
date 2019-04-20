<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Group;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();  //1
        $user->name = 'Jorge';
        $user->email = 'jservingo@gmail.com';
        $user->password = bcrypt('castalia');
        $user->save();

        $user = new User();  //2
        $user->name = 'Peter';
        $user->email = 'peterdexter11@gmail.com';
        $user->password = bcrypt('castalia');
        $user->save();

        $user = new User();  //3
        $user->name = 'Alejandro';
        $user->email = 'alejando@gmail.com';
        $user->password = bcrypt('castalia');
        $user->save();

        $user = new User(); //4
        $user->name = 'Carlos';
        $user->email = 'carlos@gmail.com';
        $user->password = bcrypt('castalia');
        $user->save();

        $user = new User();  //5
        $user->name = 'Luis';
        $user->email = 'luis@gmail.com';
        $user->password = bcrypt('castalia');
        $user->save();

        $user = new User();  //6
        $user->name = 'Alfredo';
        $user->email = 'alfredo@gmail.com';
        $user->password = bcrypt('castalia');
        $user->save();
    }
}
