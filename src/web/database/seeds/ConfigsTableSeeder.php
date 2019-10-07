<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('configs')->delete();

        \DB::table('configs')->insert(array (
            0 =>
            array (
                'id' => 1,
                'scraping_num' => 1,
                'created_at' => '2019-10-04 15:11:38',
                'updated_at' => '2019-10-04 16:08:04',
            ),
        ));


    }
}
