<?php

namespace App\Helpers;

/**
 * Class NicoScrapingHelper
 * @package App\Helpers
 */
class NicoScrapingHelper
{


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

        $cli = new \Goutte\Client();
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
            "url" => $url
        ];

        return $data;
    }


}
