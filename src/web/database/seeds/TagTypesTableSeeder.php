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
                'created_at' => '2019-10-04 04:02:57',
                'id' => 1,
                'label' => '分類',
                'updated_at' => '2019-10-04 04:02:58',
            ),
            1 => 
            array (
                'created_at' => '2019-10-04 04:02:59',
                'id' => 3,
                'label' => '管理者',
                'updated_at' => '2019-10-04 04:02:59',
            ),
            2 => 
            array (
                'created_at' => '2019-10-04 04:03:00',
                'id' => 4,
                'label' => 'オートタグ',
                'updated_at' => '2019-10-04 04:03:00',
            ),
            3 => 
            array (
                'created_at' => '2019-10-04 04:03:01',
                'id' => 5,
                'label' => 'システム',
                'updated_at' => '2019-10-04 04:03:01',
            ),
            4 => 
            array (
                'created_at' => '2019-10-04 04:03:02',
                'id' => 100,
                'label' => 'オフィシャルコミック',
                'updated_at' => '2019-10-04 04:03:03',
            ),
        ));
        
        
    }
}