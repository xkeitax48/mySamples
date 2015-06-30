<?php

//曜日は日本語で
$weekday = array("日", "月", "火", "水", "木", "金", "月");
$week_num = date("w");

//nameを変数名に
extract($_GET);

$arr_json = array(
		"date_today" => date("Y年n月j日"),
		"date_tomorrow" => date("n月j日", strtotime("tomorrow")),
		"weekday" => $weekday[++$week_num],
		"taikin" => date("G:i"),
		"running" => $running,
		"impression" => nl2br($impression)
	);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($arr_json);