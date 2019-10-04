<?php

require __DIR__ . '/../vendor/autoload.php';


//in_arrayしてなかったら追加
$array_1 = range(0, 1000000);
$target_no = 528754;
$start = microtime(true) * 1000;
if (in_array($target_no, $array_1)) {
    $array_1[] = $target_no;
}

$end = microtime(true) * 1000;
echo $end - $start . " [$start][$end]";



echo "<br>";


// 追加してからarray_uniqueしてみる
$array_2 = range(0, 1000000);
$target_no = 528754;
$start = microtime(true) * 1000;
$array_2[] = $target_no;
$array_2 = array_unique($array_2);
$end = microtime(true) * 1000;
echo $end - $start . " [$start][$end]";




