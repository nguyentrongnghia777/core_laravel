<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
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
                'name' => 'Sản phẩm ' . $i,
                'description' => 'Mô tả cho sản phẩm số'.$i,
                'slug' => 'san-pham-'.$i,
                'quantity' => '2',
                'images' => 'image'.$i.'.png',
                'price' => '200000'
            ]);
        }

        DB::table('products')->insert($data);
    }
}
