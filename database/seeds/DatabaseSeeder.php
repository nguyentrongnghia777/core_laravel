<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GroupsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UsersGroupsTableSeeder::class);
        $this->call(BlogsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
    }
}
