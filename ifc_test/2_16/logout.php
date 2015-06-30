<?php
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

//// ログアウトします ////

require_once("a_function.php");
session_start();

// ログインしていなければ戻ります
if (isNotLogin()) {
	header("location: a_login.php");
	exit;
}

// セッションの中身を空にします
$_SESSION = array();

// クッキーを削除します
if (isset($_COOKIE["PHPSESSID"])) {
	setcookie("PHPSESSID", "", time()-1000, "/");
}

// セッション情報を削除します
session_destroy();

header("location: a_login.php");
exit;
?>