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
                'id' => 1,
                'label' => 'ユーザー',
                'tag_type_id' => 1,
                'created_at' => '2019-09-27 14:43:58',
                'updated_at' => '2019-09-27 14:43:58',
            ),
            1 => 
            array (
                'id' => 2,
                'label' => '少年マンガ',
                'tag_type_id' => 1,
                'created_at' => '2019-09-27 14:41:30',
                'updated_at' => '2019-09-27 14:41:30',
            ),
            2 => 
            array (
                'id' => 3,
                'label' => '少女マンガ',
                'tag_type_id' => 1,
                'created_at' => '2019-09-27 14:43:33',
                'updated_at' => '2019-09-27 14:43:33',
            ),
            3 => 
            array (
                'id' => 4,
                'label' => '青年マンガ',
                'tag_type_id' => 1,
                'created_at' => '2019-09-27 14:43:35',
                'updated_at' => '2019-09-27 14:43:35',
            ),
            4 => 
            array (
                'id' => 5,
                'label' => '4コママンガ',
                'tag_type_id' => 1,
                'created_at' => '2019-09-27 14:43:40',
                'updated_at' => '2019-09-27 14:43:40',
            ),
            5 => 
            array (
                'id' => 6,
                'label' => 'その他マンガ',
                'tag_type_id' => 1,
                'created_at' => '2019-09-27 14:43:31',
                'updated_at' => '2019-09-27 14:43:31',
            ),
            6 => 
            array (
                'id' => 7,
                'label' => 'ファンコミック',
                'tag_type_id' => 1,
                'created_at' => '2019-09-27 14:43:58',
                'updated_at' => '2019-09-27 14:43:58',
            ),
            7 => 
            array (
                'id' => 8,
                'label' => '管理人おすすめ',
                'tag_type_id' => 3,
                'created_at' => '2019-10-04 02:17:42',
                'updated_at' => '2019-10-04 02:17:43',
            ),
            8 => 
            array (
                'id' => 9,
                'label' => '異世界',
                'tag_type_id' => 4,
                'created_at' => '2019-10-03 16:36:39',
                'updated_at' => '2019-10-03 16:36:39',
            ),
            9 => 
            array (
                'id' => 10,
                'label' => 'ファンタジー',
                'tag_type_id' => 4,
                'created_at' => '2019-10-03 16:36:41',
                'updated_at' => '2019-10-03 16:36:41',
            ),
            10 => 
            array (
                'id' => 11,
                'label' => 'ロボット',
                'tag_type_id' => 4,
                'created_at' => '2019-10-03 16:42:47',
                'updated_at' => '2019-10-03 16:42:47',
            ),
            11 => 
            array (
                'id' => 15,
                'label' => '完結',
                'tag_type_id' => 5,
                'created_at' => '2019-10-04 04:05:06',
                'updated_at' => '2019-10-04 04:05:08',
            ),
            12 => 
            array (
                'id' => 16,
                'label' => '試し読み',
                'tag_type_id' => 5,
                'created_at' => '2019-10-08 01:05:36',
                'updated_at' => '2019-10-08 01:05:37',
            ),
            13 => 
            array (
                'id' => 17,
                'label' => '暴力的描写',
                'tag_type_id' => 5,
                'created_at' => '2019-10-08 01:05:55',
                'updated_at' => '2019-10-08 01:05:54',
            ),
            14 => 
            array (
                'id' => 18,
                'label' => '性的',
                'tag_type_id' => 5,
                'created_at' => '2019-10-08 01:06:11',
                'updated_at' => '2019-10-08 01:06:13',
            ),
        ));
        
        
    }
}