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
                'label' => '少年マンガ',
                'tag_type_id' => 1,
                'created_at' => '2019-09-27 14:41:30',
                'updated_at' => '2019-09-27 14:41:30',
            ),
            1 => 
            array (
                'id' => 2,
                'label' => 'ニコニコ漫画（公式）',
                'tag_type_id' => 100,
                'created_at' => '2019-09-27 14:41:30',
                'updated_at' => '2019-09-27 14:41:30',
            ),
            2 => 
            array (
                'id' => 3,
                'label' => 'その他マンガ',
                'tag_type_id' => 1,
                'created_at' => '2019-09-27 14:43:31',
                'updated_at' => '2019-09-27 14:43:31',
            ),
            3 => 
            array (
                'id' => 4,
                'label' => '少女マンガ',
                'tag_type_id' => 1,
                'created_at' => '2019-09-27 14:43:33',
                'updated_at' => '2019-09-27 14:43:33',
            ),
            4 => 
            array (
                'id' => 5,
                'label' => '青年マンガ',
                'tag_type_id' => 1,
                'created_at' => '2019-09-27 14:43:35',
                'updated_at' => '2019-09-27 14:43:35',
            ),
            5 => 
            array (
                'id' => 6,
                'label' => '4コママンガ',
                'tag_type_id' => 1,
                'created_at' => '2019-09-27 14:43:40',
                'updated_at' => '2019-09-27 14:43:40',
            ),
            6 => 
            array (
                'id' => 7,
                'label' => 'ユーザー',
                'tag_type_id' => 1,
                'created_at' => '2019-09-27 14:43:58',
                'updated_at' => '2019-09-27 14:43:58',
            ),
            7 => 
            array (
                'id' => 8,
                'label' => 'ファンコミック',
                'tag_type_id' => 1,
                'created_at' => '2019-09-27 14:43:58',
                'updated_at' => '2019-09-27 14:43:58',
            ),
            8 => 
            array (
                'id' => 9,
                'label' => 'クラブサンデーぷらす',
                'tag_type_id' => 100,
                'created_at' => '2019-09-27 16:05:07',
                'updated_at' => '2019-09-27 16:05:07',
            ),
            9 => 
            array (
                'id' => 10,
                'label' => 'ウラ裏サンデー',
                'tag_type_id' => 100,
                'created_at' => '2019-09-27 16:05:07',
                'updated_at' => '2019-09-27 16:05:07',
            ),
            10 => 
            array (
                'id' => 11,
                'label' => 'ジャンプSQ.ニコニコ静画出張所',
                'tag_type_id' => 100,
                'created_at' => '2019-09-27 16:21:51',
                'updated_at' => '2019-09-27 16:21:51',
            ),
            11 => 
            array (
                'id' => 12,
                'label' => 'ビッグガンガンおかわり',
                'tag_type_id' => 100,
                'created_at' => '2019-09-27 16:26:46',
                'updated_at' => '2019-09-27 16:26:46',
            ),
            12 => 
            array (
                'id' => 13,
                'label' => 'となりのヤンジャン！',
                'tag_type_id' => 100,
                'created_at' => '2019-09-27 16:27:37',
                'updated_at' => '2019-09-27 16:27:37',
            ),
            13 => 
            array (
                'id' => 14,
                'label' => '水曜日のシリウス',
                'tag_type_id' => 100,
                'created_at' => '2019-09-27 16:28:07',
                'updated_at' => '2019-09-27 16:28:07',
            ),
            14 => 
            array (
                'id' => 15,
                'label' => 'ガンガンちゃんねる',
                'tag_type_id' => 100,
                'created_at' => '2019-09-27 16:30:08',
                'updated_at' => '2019-09-27 16:30:08',
            ),
            15 => 
            array (
                'id' => 16,
                'label' => '月刊のアクション',
                'tag_type_id' => 100,
                'created_at' => '2019-09-27 17:17:56',
                'updated_at' => '2019-09-27 17:17:56',
            ),
            16 => 
            array (
                'id' => 17,
                'label' => 'いま、グランドジャンプって!!',
                'tag_type_id' => 100,
                'created_at' => '2019-09-27 17:52:23',
                'updated_at' => '2019-09-27 17:52:23',
            ),
            17 => 
            array (
                'id' => 18,
                'label' => 'マーガレット×別マ創刊50周年記念U-20まんが賞',
                'tag_type_id' => 100,
                'created_at' => '2019-10-02 10:46:01',
                'updated_at' => '2019-10-02 10:46:01',
            ),
            18 => 
            array (
                'id' => 19,
                'label' => 'ニコニコでも少年ジャンプ＋',
                'tag_type_id' => 100,
                'created_at' => '2019-10-02 10:46:26',
                'updated_at' => '2019-10-02 10:46:26',
            ),
            19 => 
            array (
                'id' => 20,
                'label' => 'comip!',
                'tag_type_id' => 100,
                'created_at' => '2019-10-02 12:04:01',
                'updated_at' => '2019-10-02 12:04:01',
            ),
            20 => 
            array (
                'id' => 21,
                'label' => '電撃大王',
                'tag_type_id' => 100,
                'created_at' => '2019-10-02 16:46:55',
                'updated_at' => '2019-10-02 16:46:55',
            ),
            21 => 
            array (
                'id' => 22,
                'label' => '電撃だいおうじ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-02 16:46:55',
                'updated_at' => '2019-10-02 16:46:55',
            ),
            22 => 
            array (
                'id' => 23,
                'label' => '週漫電子',
                'tag_type_id' => 100,
                'created_at' => '2019-10-02 16:47:31',
                'updated_at' => '2019-10-02 16:47:31',
            ),
            23 => 
            array (
                'id' => 24,
                'label' => '電撃マオウ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-02 16:47:47',
                'updated_at' => '2019-10-02 16:47:47',
            ),
            24 => 
            array (
                'id' => 25,
                'label' => 'ニコニコGANMA!',
                'tag_type_id' => 100,
                'created_at' => '2019-10-02 16:49:50',
                'updated_at' => '2019-10-02 16:49:50',
            ),
            25 => 
            array (
                'id' => 26,
                'label' => 'なかよし夜カフェ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-02 16:50:16',
                'updated_at' => '2019-10-02 16:50:16',
            ),
            26 => 
            array (
                'id' => 27,
                'label' => '金曜日はヤングアニマル',
                'tag_type_id' => 100,
                'created_at' => '2019-10-02 17:44:45',
                'updated_at' => '2019-10-02 17:44:45',
            ),
            27 => 
            array (
                'id' => 28,
                'label' => 'もっとやわらかスピリッツ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-02 17:45:44',
                'updated_at' => '2019-10-02 17:45:44',
            ),
            28 => 
            array (
                'id' => 29,
                'label' => 'ニコニコミッククリア',
                'tag_type_id' => 100,
                'created_at' => '2019-10-02 17:45:51',
                'updated_at' => '2019-10-02 17:45:51',
            ),
            29 => 
            array (
                'id' => 30,
                'label' => 'コミックNewtype',
                'tag_type_id' => 100,
                'created_at' => '2019-10-02 17:46:38',
                'updated_at' => '2019-10-02 17:46:38',
            ),
            30 => 
            array (
                'id' => 31,
                'label' => '電撃G\'sコミック presents @vitamin',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 13:33:12',
                'updated_at' => '2019-10-03 13:33:12',
            ),
            31 => 
            array (
                'id' => 32,
                'label' => '第３回 白泉社少女まんが新人大賞',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 13:36:24',
                'updated_at' => '2019-10-03 13:36:24',
            ),
            32 => 
            array (
                'id' => 33,
                'label' => 'ニコニコキトラ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 13:38:10',
                'updated_at' => '2019-10-03 13:38:10',
            ),
            33 => 
            array (
                'id' => 34,
                'label' => 'チャンピオンクロス&タップ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 13:38:38',
                'updated_at' => '2019-10-03 13:38:38',
            ),
            34 => 
            array (
                'id' => 35,
                'label' => 'comicコロナ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 13:43:16',
                'updated_at' => '2019-10-03 13:43:16',
            ),
            35 => 
            array (
                'id' => 36,
                'label' => 'ニコニコアース',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 13:44:57',
                'updated_at' => '2019-10-03 13:44:57',
            ),
            36 => 
            array (
                'id' => 37,
                'label' => 'ニコニコリュエル',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 13:45:08',
                'updated_at' => '2019-10-03 13:45:08',
            ),
            37 => 
            array (
                'id' => 38,
                'label' => 'WEBLink',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 13:51:29',
                'updated_at' => '2019-10-03 13:51:29',
            ),
            38 => 
            array (
                'id' => 39,
                'label' => 'ニコニコの少年マガジン',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 13:52:21',
                'updated_at' => '2019-10-03 13:52:21',
            ),
            39 => 
            array (
                'id' => 40,
                'label' => 'ドラドラドラゴンエイジ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 13:52:23',
                'updated_at' => '2019-10-03 13:52:23',
            ),
            40 => 
            array (
                'id' => 41,
                'label' => '水曜トーチでしょう',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 13:53:20',
                'updated_at' => '2019-10-03 13:53:20',
            ),
            41 => 
            array (
                'id' => 42,
                'label' => '別館月マガ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 13:53:30',
                'updated_at' => '2019-10-03 13:53:30',
            ),
            42 => 
            array (
                'id' => 43,
                'label' => 'ニコニコ少女マンガ マーガレットchannel',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:25:01',
                'updated_at' => '2019-10-03 14:25:01',
            ),
            43 => 
            array (
                'id' => 44,
                'label' => 'きららベース',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:25:38',
                'updated_at' => '2019-10-03 14:25:38',
            ),
            44 => 
            array (
                'id' => 45,
                'label' => '放課後ヤングコミック',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:34:00',
                'updated_at' => '2019-10-03 14:34:00',
            ),
            45 => 
            array (
                'id' => 46,
                'label' => 'ニコニコMFC',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:34:26',
                'updated_at' => '2019-10-03 14:34:26',
            ),
            46 => 
            array (
                'id' => 47,
                'label' => 'ほぼほぼ週刊フラッパー',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:34:36',
                'updated_at' => '2019-10-03 14:34:36',
            ),
            47 => 
            array (
                'id' => 48,
                'label' => 'ヤングエースUP',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:36:42',
                'updated_at' => '2019-10-03 14:36:42',
            ),
            48 => 
            array (
                'id' => 49,
                'label' => 'ニコニコマトグロッソ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:36:56',
                'updated_at' => '2019-10-03 14:36:56',
            ),
            49 => 
            array (
                'id' => 50,
                'label' => 'ドラドラしゃーぷ#',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:38:25',
                'updated_at' => '2019-10-03 14:38:25',
            ),
            50 => 
            array (
                'id' => 51,
                'label' => 'ニコニコキューン',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:38:43',
                'updated_at' => '2019-10-03 14:38:43',
            ),
            51 => 
            array (
                'id' => 52,
                'label' => 'コミックライド',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:38:48',
                'updated_at' => '2019-10-03 14:38:48',
            ),
            52 => 
            array (
                'id' => 53,
                'label' => 'リイドカフェ　ニコニコ漫画店',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:38:56',
                'updated_at' => '2019-10-03 14:38:56',
            ),
            53 => 
            array (
                'id' => 54,
                'label' => '異世界コミック',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:41:47',
                'updated_at' => '2019-10-03 14:41:47',
            ),
            54 => 
            array (
                'id' => 55,
                'label' => 'ヤングエース',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:41:49',
                'updated_at' => '2019-10-03 14:41:49',
            ),
            55 => 
            array (
                'id' => 56,
                'label' => 'ComicWalker',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:41:49',
                'updated_at' => '2019-10-03 14:41:49',
            ),
            56 => 
            array (
                'id' => 57,
                'label' => 'コンプエース',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:42:42',
                'updated_at' => '2019-10-03 14:42:42',
            ),
            57 => 
            array (
                'id' => 58,
                'label' => '次の日のガム',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:43:18',
                'updated_at' => '2019-10-03 14:43:18',
            ),
            58 => 
            array (
                'id' => 59,
                'label' => 'ニコニコファイア',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:46:51',
                'updated_at' => '2019-10-03 14:46:51',
            ),
            59 => 
            array (
                'id' => 60,
                'label' => '少年エース',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 14:47:25',
                'updated_at' => '2019-10-03 14:47:25',
            ),
            60 => 
            array (
                'id' => 61,
                'label' => 'まんがタイム彩[sai]',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:24:11',
                'updated_at' => '2019-10-03 16:24:11',
            ),
            61 => 
            array (
                'id' => 62,
                'label' => 'ギリギリえっぢ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:25:01',
                'updated_at' => '2019-10-03 16:25:01',
            ),
            62 => 
            array (
                'id' => 63,
                'label' => 'ゴラク魂',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:26:18',
                'updated_at' => '2019-10-03 16:26:18',
            ),
            63 => 
            array (
                'id' => 64,
                'label' => 'コミックビーズログ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:29:05',
                'updated_at' => '2019-10-03 16:29:05',
            ),
            64 => 
            array (
                'id' => 65,
                'label' => '火曜日のコミックガルド',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:29:32',
                'updated_at' => '2019-10-03 16:29:32',
            ),
            65 => 
            array (
                'id' => 66,
                'label' => 'ニコニコCOMICリュウ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:29:33',
                'updated_at' => '2019-10-03 16:29:33',
            ),
            66 => 
            array (
                'id' => 67,
                'label' => '異世界',
                'tag_type_id' => 4,
                'created_at' => '2019-10-03 16:36:39',
                'updated_at' => '2019-10-03 16:36:39',
            ),
            67 => 
            array (
                'id' => 68,
                'label' => 'comicエスタス for ニコニコ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:36:40',
                'updated_at' => '2019-10-03 16:36:40',
            ),
            68 => 
            array (
                'id' => 69,
                'label' => 'ファンタジー',
                'tag_type_id' => 4,
                'created_at' => '2019-10-03 16:36:41',
                'updated_at' => '2019-10-03 16:36:41',
            ),
            69 => 
            array (
                'id' => 70,
                'label' => 'ニコニコガンガンJOKER',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:36:55',
                'updated_at' => '2019-10-03 16:36:55',
            ),
            70 => 
            array (
                'id' => 71,
                'label' => 'エロ',
                'tag_type_id' => 4,
                'created_at' => '2019-10-03 16:36:57',
                'updated_at' => '2019-10-03 16:36:57',
            ),
            71 => 
            array (
                'id' => 72,
                'label' => '電撃G\'sコミック',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:37:00',
                'updated_at' => '2019-10-03 16:37:00',
            ),
            72 => 
            array (
                'id' => 73,
                'label' => '水曜日はまったりダッシュエックスコミック',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:37:22',
                'updated_at' => '2019-10-03 16:37:22',
            ),
            73 => 
            array (
                'id' => 74,
                'label' => 'ロボット',
                'tag_type_id' => 4,
                'created_at' => '2019-10-03 16:42:47',
                'updated_at' => '2019-10-03 16:42:47',
            ),
            74 => 
            array (
                'id' => 75,
                'label' => '電撃G\'smagazine',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:44:47',
                'updated_at' => '2019-10-03 16:44:47',
            ),
            75 => 
            array (
                'id' => 76,
                'label' => 'コミックジーン',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:45:29',
                'updated_at' => '2019-10-03 16:45:29',
            ),
            76 => 
            array (
                'id' => 77,
                'label' => 'シルフ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:45:31',
                'updated_at' => '2019-10-03 16:45:31',
            ),
            77 => 
            array (
                'id' => 78,
                'label' => 'COMIC BRIDGE online',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:45:32',
                'updated_at' => '2019-10-03 16:45:32',
            ),
            78 => 
            array (
                'id' => 79,
                'label' => '電撃文庫MAGAZINE',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:45:36',
                'updated_at' => '2019-10-03 16:45:36',
            ),
            79 => 
            array (
                'id' => 80,
                'label' => 'COMIC it',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:49:18',
                'updated_at' => '2019-10-03 16:49:18',
            ),
            80 => 
            array (
                'id' => 81,
                'label' => 'コンプティーク',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:49:57',
                'updated_at' => '2019-10-03 16:49:57',
            ),
            81 => 
            array (
                'id' => 82,
                'label' => 'ニコニコデンプレコミック',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:55:50',
                'updated_at' => '2019-10-03 16:55:50',
            ),
            82 => 
            array (
                'id' => 83,
                'label' => 'FLOSコミック',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:55:53',
                'updated_at' => '2019-10-03 16:55:53',
            ),
            83 => 
            array (
                'id' => 84,
                'label' => 'ニコニコストーリアダッシュ',
                'tag_type_id' => 100,
                'created_at' => '2019-10-03 16:56:47',
                'updated_at' => '2019-10-03 16:56:47',
            ),
        ));
        
        
    }
}