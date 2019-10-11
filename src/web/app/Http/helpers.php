<?php


/**
 * @param $no
 * @return string
 */
function comic_url($no)
{
    return \NicoScraping::comic_url($no);
}


/**
 *
 * @param $comic_start_date
 * @param $comic_update_date
 * @param $story_number
 * @return float|int
 */
function update_speed($comic_start_date, $comic_update_date, $story_number)
{

    $comic_start_carbon = new \Carbon\Carbon($comic_start_date);
    $comic_update_carbon = new \Carbon\Carbon($comic_update_date);

    $diff_day = $comic_start_carbon->diffInDays($comic_update_carbon);
    if ($diff_day > 0 && $story_number > 0) {
        return round($diff_day / $story_number, 2);
    }
    return 0;
}


/**
 * @param $label
 * @param $tag_type_id
 * @return mixed
 */
function getTagId($label, $tag_type_id)
{
    return \App\Facades\Tag::getTagId($label, $tag_type_id);
}

/**
 * @param $no
 * @return array|bool
 */
function getNicoMangaTargetPage($no)
{
    return \NicoScraping::getNicoComicTargetPage($no);
}


/**
 * @param $title
 * @param $description
 * @return array
 */
function autoTagCheck($title, $description)
{
    return \App\Facades\Tag::autoTagCheck($title . $description);
}
