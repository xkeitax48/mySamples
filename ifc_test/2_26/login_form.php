<?php
// ログインフォームを表示します

error_reporting(E_ALL);
session_start();
require_once("function.php");

// htmlの文字列をセッションの値に置換します
// 置換する文字列を指定します
$strings = array("error_message", "email", "password");
$replaces = array();
foreach($strings as $string) {
	$replaces[$string] = isset($_SESSION[$string])? $_SESSION[$string] : "";
}

// ログインフォームhtmlの文字列を置き換えて表示します
displayPageFile("login_form.html", $replaces);

// セッション情報を削除します
session_destroy();