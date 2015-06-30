<?php
// ログインフォームを表示します
require_once("lib_display.php");
error_reporting(E_ALL);
session_start();

// 置換する文字列を指定します
$strings = array("message", "email");
$replaces = array();
foreach($strings as $string) {
	$replaces[$string] = isset($_SESSION[$string]) ? $_SESSION[$string] : null;
}

// login_form.phpを表示します
displayFile("login_form.html", $replaces, false, true);

// セッション情報を削除します
session_destroy();