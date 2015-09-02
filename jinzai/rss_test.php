<?php

$rss_url = "http://chuotfob:rikuyuu@blog.chuo-tfob.com/?mode=rss";
$XML = simplexml_load_file($rss_url);

$date = array();

foreach($XML->item as $item) {
	$date[] = $item->children("dc", true)->date;
}

$latest = strtotime($date[0]);

echo date("Y年n月j日", $latest)."、ブログ更新しました。";

// if(date("Ymd", $latest) == date("Ymd")) {
// 	echo "今日、ブログ更新しました。";
// }
// else {
// 	echo date("Y年n月j日", $latest)."、ブログ更新しました。";
// }