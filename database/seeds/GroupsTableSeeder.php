<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            [
                'name' => 'admin',
                'description' => 'admin',
            ],
            [
                'name' => 'member',
                'description' => 'member',
            ]
        ]);
    }
}
