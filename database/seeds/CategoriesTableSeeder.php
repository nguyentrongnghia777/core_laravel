<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
                'name' => 'Thể loại ' . $i,
                'desc' => 'Mô tả cho thể loại số'.$i,
            ]);
        }

        DB::table('categories')->insert($data);
    }
}
