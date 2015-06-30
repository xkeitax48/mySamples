<?php
// 会員登録フォームを表示します
error_reporting(E_ALL);
session_start();
require_once("lib_display.php");
require_once("lib_DB.php");

// 選択できる年月日を指定します
for($i=1960; $i<=2000; $i++) {
	$year[] = array("year" => $i);
}
for($i=1; $i<=12; $i++) {
	$month[] = array("month" => $i);
}
for($i=1; $i<=31; $i++) {
	$day[] = array("day" => $i);
}

// 都道府県情報を取得します
$prefectures = getPrefecture();

// 置換して繰り返す行を指定します
$loop = array("17" => $year,
			"20" => $month,
			"23" => $day,
			"28" => $prefectures);

// register.htmlを表示します
displayFile("register.html", null, $loop);

// セッション情報を削除します
session_destroy();