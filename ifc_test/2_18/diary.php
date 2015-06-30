<?php
//// 日記の詳細を表示するページです ////

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

// 日付がGETされているか判定します
// GETされていなければマイページに戻ります
if(!isset($_GET["date"])) {
	message("日記が指定されていません");
	header("location: mypage.php");
	exit;
}

// 会員IDと日付から記事を取得します
$diary = getDiary($_GET["id"], $_GET["date"]);

// 記事が無ければマイページに戻ります
if(!$diary) {
	message("指定した日記は存在しません");
	header("location: mypage.php");
	exit;
}

// 記事を表示します
printDiaryDay($diary);

// 編集フォームへのリンクを表示します
echo "<a href=\"edit.php\">edit</a><br>";
// マイページへのリンクを表示します
echo "<a href=\"mypage.php\">戻る</a><br>";