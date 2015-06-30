<?php
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

//// 日記一覧を表示します ////

require_once("a_function.php");
session_start();

// ログインしてなければ戻ります
if (isNotLogin()) {
	header("location: a_login.php");
	exit;
}

//　日記の一覧を取得して表示します
$diaries = getDiaryByPersonId($_SESSION["person_id"]);

printDiary($diaries);

echo "<br><a href=\"logout.php\">ログアウトする</a>";

exit;
?>