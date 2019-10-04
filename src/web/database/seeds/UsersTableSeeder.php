<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10) . '@example.com',
            'password' => bcrypt('password'),
        ]);

        \DB::table('users')->insert([
            'name' => "管理者",
            'email' => 'suzuno3700@gmail.com',
            'password' => bcrypt('password'),
        ]);


    }
}
