<?php
// マイページを表示します
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

// セッションの値に置換する文字列を指定します
$strings = array("message", "name");
$replaces = array();
foreach($strings as $string) {
	$replaces[$string] = isset($_SESSION[$string]) ? $_SESSION[$string] : null;
}

// 日記の情報を取得します
$diaries = getDiaryData($_SESSION["person_id"]);

// 日記の情報に繰り返し置換する行を指定します
$loop = array("4" => $diaries);

// mypage.htmlを表示します
displayFile("mypage.html", $replaces, $loop);

// メッセージを削除します
unset($_SESSION["message"]);