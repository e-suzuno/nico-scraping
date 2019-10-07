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


        $this->call(ConfigsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(TagTypesTableSeeder::class);

     //   $this->call(NicoComicsTableSeeder::class);
    }
}
