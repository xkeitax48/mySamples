<?php
// 会員登録フォームで入力された情報を表示します
error_reporting(E_ALL);
session_start();
require_once("lib_display.php");
require_once("lib_DB.php");
require_once("lib_sign_up.php");

// 会員情報がすべてPOSTされているか確認します
$strings = array("last_name",
				"first_name",
				"last_kana",
				"first_kana",
				"gender_id",
				"year",
				"month",
				"day",
				"prefecture_code",
				"email",
				"password",
				"re_password");
// POSTされていない項目があれば登録フォームに移動します
foreach($strings as $string) {
	if(empty($_POST[$string])) {
		header("location: register.php");
		exit;
	}
}

// 会員登録できるか確認します
// できなければ登録フォームに移動します
if(false == checkRegister($_POST["email"], $_POST["password"], $_POST["re_password"])) {
	$_SESSION["message"] = "";
	header("location: register.php");
	exit;
}

// 入力された会員情報をセッションに保存します
foreach($strings as $string) {
	$_SESSION[$string] = $_POST[$string];
}
$_SESSION["birthday"] = $_POST["year"]."-".$_POST["month"]."-".$_POST["day"];

// 確認ページの表示用に文字列を置換します
$replaces = array();
foreach($strings as $string) {
	$replaces[$string] = $_POST[$string];
}
$replaces["gender"] = getGender($_POST["gender_id"]);
$replaces["prefecture_name"] = getPrefecture($_POST["prefecture_code"]);
$replaces["password_msk"] = str_pad("", strlen($_POST["password"]), "*");

// register_check.htmlを表示します
displayFile("register_check.html", $replaces);