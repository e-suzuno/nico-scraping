<?php


/**
 * @param $url
 * @return array
 */
function getNicoMangaListPage($url)
{
    $cli = new \Goutte\Client();
    $crawler = $cli->request('GET', $url);

    $list = [];
    $crawler->filter('#comic_list > ul > li')->each(function ($element) use (&$list) {
        $mg_body = $element->filter('.mg_title .mg_body');
        $title = $mg_body->filter('.title > a')->text();
        $url = $mg_body->filter('.title > a')->attr('href');
        $description = $mg_body->filter('.description')->text();

        $list[] = [
            'title' => $title,
            'description' => $description,
            'url' => $url
        ];
    });
    return $list;
}


/**
 * @param $no
 * @return string
 */
function comic_url($no)
{
    return "http://seiga.nicovideo.jp/comic/{$no}";
}


/**
 * @param $label
 * @param $tag_type_id
 * @return mixed
 */
function getTagId($label, $tag_type_id)
{
    static $tagList = null;
    if ($tagList === null) {
        $tags = app(\App\Repositories\Tag\TagRepositoryInterface::class)->getAll();
        $tagList = [];
        foreach ($tags as $tag) {
            $tagList[$tag->label] = $tag->id;
        }
    }

    if (isset($tagList[$label])) {
        return $tagList[$label];
    } else {
        $tag = app(\App\Repositories\Tag\TagRepositoryInterface::class)->create([
            'label' => $label,
            'tag_type_id' => $tag_type_id
        ]);
        $tagList[$tag->label] = $tag->id;
        return $tag->id;
    }
}

/**
 * @param $no
 * @return array|bool
 */
function getNicoMangaTargetPage($no)
{

    $url = comic_url($no);

    $cli = new \Goutte\Client();
    $crawler = $cli->request('GET', $url);

    $error_cnt = $crawler->filter('#error_cnt');
    if ($error_cnt->count() > 0) {
        //エラー
        return FALSE;
    }

    $official_header = $crawler->filter('.official_header');
    if ($official_header->count() == 0) {
        $official_title = "ユーザー";
    } else {
        $official_title = $official_header->filter(".official_title")->text();
    }

    $main_title = $crawler->filter('.main_title > h1')->text();
    $author = $crawler->filter('.main_title > .author > h3 > span')->text();


    $category = $crawler->filter('.mg_work_detail .meta_info .category')->text();
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


/**
 * @param $title
 * @param $description
 * @return array
 */
function autoTagCheck($title, $description)
{
    $tags = [];

    $target_string = $title . $description;
    $search_tags = [
        "異世界",
        "ファンタジー",
        "ロボット",
        "エロ",
    ];

    foreach ($search_tags as $label) {
        if (mb_strpos($target_string, $label, 0, "UTF-8") !== false) {
            $tags[] = getTagId($label, \App\Constants\TagTypeConstant::AUTO_TAG);
        };
    }

    return $tags;
}
