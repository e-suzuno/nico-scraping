<?php

namespace App\Services;


class NicoScraping
{

    static $client;


    static public function getClient()
    {
        if (isset(self::$client) === false) {
            self::$client = new \Goutte\Client();
        }
        return self::$client;
    }

    /**
     * コミックのＵＲＬを返す
     *
     * @param $no
     * @return string
     */
    public static function comic_url($no)
    {
        return "http://seiga.nicovideo.jp/comic/{$no}";
    }


    /**
     * 更新が新しい順のリストのURL
     *
     * @param $page
     * @return string
     */
    public static function manga_updated_url($page)
    {
        return "http://seiga.nicovideo.jp/manga/list?page={$page}&sort=manga_updated";
    }


    /**
     * @param $no
     * @return array|bool   falseなら失敗
     */
    public static function getNicoComicTargetPage($no)
    {
        $url = self::comic_url($no);
        $cli = self::getClient();
        $crawler = $cli->request('GET', $url);

        $error_cnt = $crawler->filter('#error_cnt');
        if ($error_cnt->count() > 0) {
            //エラー
            return FALSE;
        }


        //公式コミック取得
        $official_header = $crawler->filter('.official_header');
        if ($official_header->count() == 0) {
            $official_title = "ユーザー";
        } else {
            $official_title = $official_header->filter(".official_title")->text();
        }

        //漫画タイトル
        $main_title = $crawler->filter('.main_title > h1')->text();

        //製作者名取得
        $author = $crawler->filter('.main_title > .author > h3 > span')->text();


        //カテゴリの取得
        $category = $crawler->filter('.mg_work_detail .meta_info .category')->text();

        //説明文取得
        $description_text = $crawler->filter('.mg_work_detail .description_text')->text();


        //更新日、作成日の取得
        $meta_info = $crawler->filter('.mg_work_detail .meta_info')->eq(0)->text();
        $comic_start_date = NULL;
        if (preg_match('/([1-9][0-9]{3})年(0[1-9]{1}|1[0-2]{1})月(0[1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1})日開始/', $meta_info, $date_match)) {
            $comic_start_date = new \Carbon\Carbon($date_match[1] . $date_match[2] . $date_match[3]);
        }
        $comic_update_date = NULL;
        if (preg_match('/([1-9][0-9]{3})年(0[1-9]{1}|1[0-2]{1})月(0[1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1})日更新/', $meta_info, $date_match)) {
            $comic_update_date = new \Carbon\Carbon($date_match[1] . $date_match[2] . $date_match[3]);
        }


        //話数の取得
        $meta_info = $crawler->filter('.mg_work_detail .meta_info')->eq(0)->filter('span')->text();
        $story_number = 0;
        if (preg_match('/([0-9]{1,3})話/x', $meta_info, $match)) {
            $story_number = (int)$match[1];
        }


        //完結フラグの取得
        $status_complete_cnt = $crawler->filter('.status_complete');
        $is_complete = ($status_complete_cnt->count() > 0);

        //試し読み
        $status_trial_cnt = $crawler->filter('.status_trial');
        $is_trial = ($status_trial_cnt->count() > 0);

        //暴力描写
        $status_trial_cnt = $crawler->filter('.regulation .gro');
        $is_gro = ($status_trial_cnt->count() > 0);

        //性的な描写
        $status_trial_cnt = $crawler->filter('.regulation .adult');
        $is_adult = ($status_trial_cnt->count() > 0);


        //NGワード系の除外
        if (mb_strpos($main_title, "졸업증명서위조", 0, "UTF-8") !== false) {
            return false;
        }
        //掲載数 0も除外
        if ($story_number === 0) {
            return false;
        }

        $data = [
            "title" => trim($main_title),
            "author" => trim($author),
            "category" => trim($category),
            "official_title" => trim($official_title),
            "description" => trim($description_text),
            "nico_no" => $no,
            "comic_start_date" => $comic_start_date,
            "comic_update_date" => $comic_update_date,
            "story_number" => $story_number,
            "url" => $url,
            "is_complete" => $is_complete,
            "is_trial" => $is_trial,
            "is_gro" => $is_gro,
            "is_adult" => $is_adult,
        ];

        return $data;
    }


    /**
     * @param $page
     * @return array|bool
     */
    public static function getNicoList($page)
    {

        $url = self::manga_updated_url($page);
        $cli = self::getClient();
        $crawler = $cli->request('GET', $url);

        $mg_item_cnt = $crawler->filter('.mg_item');
        if ($mg_item_cnt->count() === 0) {
            //エラー
            return FALSE;
        }

        $list = $mg_item_cnt->each(function ($mg_item) {


            $href = $mg_item->filter('.title a')->attr('href');
            if (preg_match('/\/comic\/([0-9]*)\?track=list/', $href, $match)) {
                $nico_no = (int)$match[1];
            } else {
                //失敗？
                return false;
            }

            $updated = $mg_item->filter('.updated')->eq(0)->text();
            if (preg_match('/([1-9][0-9]{3})\/(0[1-9]{1}|1[0-2]{1})\/(0[1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1})/', $updated, $date_match)) {
                $comic_update_date = new \Carbon\Carbon($date_match[1] . $date_match[2] . $date_match[3]);
            } else {

                //失敗？
                return false;
            }

            return [
                "nico_no" => $nico_no,
                "comic_update_date" => $comic_update_date,
            ];
        });


        return $list;

    }

}
