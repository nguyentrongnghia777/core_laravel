<?php

use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $data = [];

        for ($i = 1; $i < 20; $i++) {
            array_push($data, [
                'name' => 'bai ' . $i,
                'user_id' => 1,
                'avatar_url' => 'test'
            ]);
        }

        DB::table('blogs')->insert($data);   
    }
}
