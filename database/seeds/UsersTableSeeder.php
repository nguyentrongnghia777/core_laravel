<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'nguyen trong nghia',
                'email' => 'nguyentrongnghia77@gmail.com',
                'password' => '$2y$10$QC7An67rk5GnQ6agyL0VxehEXsEfPRwjILWqW/tqO.5DVxlqKUaHO', //123123
            ],
            [
                'name' => 'dang khoa',
                'email' => 'nguyentrongnghia777@gmail.com',
                'password' => '$2y$10$QC7An67rk5GnQ6agyL0VxehEXsEfPRwjILWqW/tqO.5DVxlqKUaHO', //123123
            ]
        ]);    
    }
}
