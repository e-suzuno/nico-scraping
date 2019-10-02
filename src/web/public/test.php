<?php

$hoge = "


<div class=\"meta_info\">
          2010年08月27日開始
          2013年02月18日更新
          <span style=\"padding-left: 16px\">
            [
            94話完結            ]
          </span>
                    <span style=\"padding-left: 16px\">
            <a href=\"/manga/list?category=%E5%B0%91%E5%A5%B3%E3%83%9E%E3%83%B3%E3%82%AC\">
              [<span class=\"category\">少女マンガ</span>]
            </a>
          </span>
                    <div id=\"ko_favorite_top\">
            <div class=\"meta_info__favorite\">
              <a class=\"btn favorite\" data-bind=\"click: toggleState, css: {active: favorite}, attr: {title: favorite()? '作品のお気に入りを解除' : '作品をお気に入りに登録', rel: favorite()? 'tooltip' : 'tooltip_remove'}\" title=\"作品をお気に入りに登録\" rel=\"tooltip_remove\">
                <span class=\"icon_watchlist_add\"></span>
                <span class=\"text\" data-bind=\"text: favorite()? 'お気に入りに追加済み' : '作品をお気に入りに登録'\" sheep-class=\"text\">作品をお気に入りに登録</span>
              </a>
            </div>
          </div>
        </div>
";




if (preg_match('/([1-9]{1,3})話/x', $hoge, $date_match)) {
    var_dump($date_match);
}



/*

if (preg_match('/([1-9][0-9]{3})年(0[1-9]{1}|1[0-2]{1})月(0[1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1})日開始/', $hoge, $date_match)) {
    var_dump($date_match[0]);
}

if (preg_match('/([1-9][0-9]{3})年(0[1-9]{1}|1[0-2]{1})月(0[1-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1})日更新/', $hoge, $date_match)) {
    var_dump($date_match[0]);
}
*/
