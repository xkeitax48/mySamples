<?php
// マイページを表示します

error_reporting(E_ALL);
session_start();
require_once("function.php");

// ログインしていなければログインフォームに移動します
if(isLogin() == false) {
	header("location: login_form.php");
	exit;
}

// 会員IDから日記情報を取得します
$diaries = getDiaryByPersonId($_SESSION["person_id"]);


// HTMLの文字列を日記一覧に置換します
// 日記ごとに<p>で囲います
// 
// $strings = array("create_day", "name");
// foreach($diaries as $diary) {
// 	$replaces["ddd_diary_bbb"] .= "<p><a href=\"diary.php?date=".$diary["yyyymmdd"]."\">";
// 	foreach($strings as $string) {
// 		$replaces["ddd_diary_bbb"] .= $diary[$string];
// 	}
// 	$replaces["ddd_diary_bbb"] .= "</a></p>";
// }
// var_dump($replaces["ddd_diary_bbb"]);





// // mypage.htmlの文字列を置き換えて表示します
displayPageFile("mypage.html", $replaces);

