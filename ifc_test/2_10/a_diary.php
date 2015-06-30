<?php
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

//// 日記の詳細を表示します ////

require_once("a_function.php");
session_start();

// ログインしてなければ戻ります
if (isNotLogin()) {
	header("location: a_login.php");
	exit;
}

// 日記を表示するための情報が指定されているか確認します
if (isset($_GET["id"]) && isset($_GET["date"])) {
	$diary = getDiaryByPersonIdAndDate($_GET["id"], $_GET["date"]);
	// 日記の詳細を表示します
	echo $diary["create_day"] . "<br>"
		.$diary["name"] . "<br>"
		.$diary["post"];
}

// 日記の指定が無ければ戻ります
else {
	header("location: a_mypage.php");
	exit;
}

echo "<br><a href=\"a_mypage.php\">マイページに戻る</a>";
?>
