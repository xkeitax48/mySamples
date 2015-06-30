<?php
// 会員登録処理をします
error_reporting(E_ALL);
session_start();
require_once("lib_display.php");
require_once("lib_DB.php");
require_once("lib_sign_up.php");

// セッションに会員情報が保存されているか確認します
$strings = array("email",
				"password",
				"last_name",
				"first_name",
				"last_kana",
				"first_kana",
				"gender_id",
				"birthday",
				"prefecture_code");
// 保存されていない項目があれば登録フォームに移動します
foreach($strings as $string) {
	if(empty($_SESSION[$string])) {
		header("location: register.php");
		exit;
	}
}

// 会員登録します
$member_data = array();
foreach($strings as $string) {
	$member_data[$string] = $_SESSION[$string];
}
$member_data["password"] = hash("sha512", $member_data["password"]);
$member_data["created_at"] = date("Y-m-d H:i:s");
$member_data["updated_at"] = date("Y-m-d H:i:s");
$result = signUp($member_data);

// 会員登録に失敗したら登録フォームに移動します
if($result == false) {
	header("location: register.php");
	exit;
}

// register_finish.phpに移動します
header("location: register_finish.php");
exit;