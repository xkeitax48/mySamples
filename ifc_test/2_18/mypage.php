<?php
//// 日記一覧を表示するページです ////

// エラーがあれば表示します
error_reporting(E_ALL);

// セッションを開始します
session_start();

// 関数のファイルを読み込みます
require_once("function.php");

// ログインしていなければログインフォームに戻ります
if (!isLogin()) {
	message("ログインしてください");
	header("location: login_form.php");
	exit;
}

// 日記の詳細の取得に失敗したらメッセージを表示します
if(isset($_SESSION["message"])) {
	echo $_SESSION["message"];
	$_SESSION["message"] = array();
}

// ログインしている会員の日記一覧を取得します
$diaries = getDiary($_SESSION["person_id"]);

// 日記一覧を表示します
if(isset($diaries)) {
	printDiaryAll($diaries);
}

// 新規作成ページへのリンクを表示します
echo "<a href=\"new_form.php\">new post</a><br>";