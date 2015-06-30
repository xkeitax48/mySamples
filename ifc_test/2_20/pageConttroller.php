<?php
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

require_once("view.class.php");
require_once("user.class.php");
require_once("session.class.php");

$view = new view();
$user = new user();
$session = new session();

// ログインしていなければログインフォームに戻ります
// 
if(!$user->checkLogin()) {
	$view->setValue("posted_email", $session->get("posted_email"));
	var_dump($_SESSION);
	echo $session->get("error_message");
	echo $view->render("login_form.php");
	$session->clearAll();
}
// ログインしていればマイページに移動します
else {
	echo $view->render("mypage.php");
}