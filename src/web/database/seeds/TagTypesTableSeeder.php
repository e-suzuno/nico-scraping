<?php

use Illuminate\Database\Seeder;

class TagTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('tag_types')->delete();

        \DB::table('tag_types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'label' => '分類',
            ),
            1 =>
            array (
                'id' => 3,
                'label' => '管理者',
            ),
            2 =>
            array (
                'id' => 4,
                'label' => 'オートタグ',

            ),
            3 =>
            array (
                'id' => 5,
                'label' => 'システム',
            ),
            4 =>
            array (
                'id' => 100,
                'label' => 'オフィシャルコミック',
            ),
        ));


    }
}
