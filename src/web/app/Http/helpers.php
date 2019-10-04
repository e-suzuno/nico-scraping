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
    return \App\Helpers\NicoScrapingHelper::comic_url($no);
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
    return \App\Helpers\NicoScrapingHelper::getNicoComicTargetPage($no);
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
