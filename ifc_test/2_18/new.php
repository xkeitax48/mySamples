<?php
//// 日記の新規作成処理を実行するページです ////

// エラーがあれば表示します
error_reporting(E_ALL);

// セッションを開始します
session_start();

// 関数のファイルを読み込みます
require_once("function.php");

// ログインしていなければログインフォームに戻ります
if(!isLogin()) {
	message("ログインしてください");
	header("location: login_form.php");
	exit;
}

// 記事がPOSTされているか判定します
// POSTされていなければ新規作成フォームに戻ります
if(empty($_POST["post"])) {
	message("入力されていない項目があります");
	header("location: new_form.php");
	exit;
}

// 記事をDBに書き込みます
$today = date("Ymd");
createNewPost($_SESSION["person_id"], $today, $_POST["post"]);

// マイページに移動します
header("location: mypage.php");
exit;
?>