<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tags')->delete();
        
        \DB::table('tags')->insert(array (
            0 => 
            array (
                'created_at' => '2019-09-27 14:43:58',
                'id' => 1,
                'label' => 'ユーザー',
                'tag_type_id' => 1,
                'updated_at' => '2019-09-27 14:43:58',
            ),
            1 => 
            array (
                'created_at' => '2019-09-27 14:41:30',
                'id' => 2,
                'label' => '少年マンガ',
                'tag_type_id' => 1,
                'updated_at' => '2019-09-27 14:41:30',
            ),
            2 => 
            array (
                'created_at' => '2019-09-27 14:43:33',
                'id' => 3,
                'label' => '少女マンガ',
                'tag_type_id' => 1,
                'updated_at' => '2019-09-27 14:43:33',
            ),
            3 => 
            array (
                'created_at' => '2019-09-27 14:43:35',
                'id' => 4,
                'label' => '青年マンガ',
                'tag_type_id' => 1,
                'updated_at' => '2019-09-27 14:43:35',
            ),
            4 => 
            array (
                'created_at' => '2019-09-27 14:43:40',
                'id' => 5,
                'label' => '4コママンガ',
                'tag_type_id' => 1,
                'updated_at' => '2019-09-27 14:43:40',
            ),
            5 => 
            array (
                'created_at' => '2019-09-27 14:43:31',
                'id' => 6,
                'label' => 'その他マンガ',
                'tag_type_id' => 1,
                'updated_at' => '2019-09-27 14:43:31',
            ),
            6 => 
            array (
                'created_at' => '2019-09-27 14:43:58',
                'id' => 7,
                'label' => 'ファンコミック',
                'tag_type_id' => 1,
                'updated_at' => '2019-09-27 14:43:58',
            ),
            7 => 
            array (
                'created_at' => '2019-10-04 02:17:42',
                'id' => 8,
                'label' => '管理人おすすめ',
                'tag_type_id' => 3,
                'updated_at' => '2019-10-04 02:17:43',
            ),
            8 => 
            array (
                'created_at' => '2019-10-03 16:36:39',
                'id' => 11,
                'label' => '異世界',
                'tag_type_id' => 4,
                'updated_at' => '2019-10-03 16:36:39',
            ),
            9 => 
            array (
                'created_at' => '2019-10-03 16:36:41',
                'id' => 12,
                'label' => 'ファンタジー',
                'tag_type_id' => 4,
                'updated_at' => '2019-10-03 16:36:41',
            ),
            10 => 
            array (
                'created_at' => '2019-10-03 16:36:57',
                'id' => 13,
                'label' => 'エロ',
                'tag_type_id' => 4,
                'updated_at' => '2019-10-03 16:36:57',
            ),
            11 => 
            array (
                'created_at' => '2019-10-03 16:42:47',
                'id' => 14,
                'label' => 'ロボット',
                'tag_type_id' => 4,
                'updated_at' => '2019-10-03 16:42:47',
            ),
            12 => 
            array (
                'created_at' => '2019-10-04 04:05:06',
                'id' => 15,
                'label' => '完結',
                'tag_type_id' => 5,
                'updated_at' => '2019-10-04 04:05:08',
            ),
        ));
        
        
    }
}