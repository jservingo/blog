<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(UsersPostsTableSeeder::class);
        $this->call(CatalogsTableSeeder::class);
        $this->call(CatalogsPostsTableSeeder::class);
        $this->call(AppsTableSeeder::class);
        $this->call(AppsPostsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(PagesPostsTableSeeder::class);
        $this->call(KpostsTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
    }
}
