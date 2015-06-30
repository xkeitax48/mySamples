<?php
// 日記の詳細を表示します
require_once("lib_DB.php");
require_once("lib_display.php");
require_once("lib_login.php");
error_reporting(E_ALL);
session_start();

// ログインしていなければログインページに移動します
if(isLogin() == false) {
	header("location: login_form.php");
	exit;
}

// 日付がGETで受け取れているか判定します
// GETできていなければマイページに移動します
if(!isset($_GET["date"])) {
	$_SESSION["message"] = "日付が指定されていません";
	header("location: mypage.php");
	exit;
}

// 日記の情報を取得します
// 取得できなければマイページに移動します
$diary = getDiaryData($_SESSION["person_id"], $_GET["date"]);
if($diary == false) {
	$_SESSION["message"] = "指定された日記は存在しません";
	header("location: mypage.php");
	exit;
}

// 日記の情報に置換する文字列を指定します
$strings = array("name", "create_day", "post");
$replaces = array();
foreach($strings as $string) {
	$replaces[$string] = isset($diary[$string]) ? $diary[$string] : null;
}

// diary.phpを表示します
displayFile("diary.html", $replaces);