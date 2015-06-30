<?php
// ログイン認証をします

error_reporting(E_ALL);
session_start();
require_once("function.php");

// ログイン中ならセッションの会員IDを空にします
if(isset($_SESSION["person_id"])) {
	$_SESSION["person_id"] = null;
}

// emailとpasswordがpostされているか判定します
// postされていなかったらログインフォームに移動します
if(empty($_POST["email"]) || empty($_POST["password"])) {
	$_SESSION["error_message"] = "入力されていない項目があります";
	$_SESSION["email"] = isset($_POST["email"])? htmlspecialchars($_POST["email"]) : "";
	header("location: login_form.php");
	exit;
}

// POSTされた値をエスケープします
$post = escapeString($_POST);

// emailとpasswordでログイン認証します
$person_id = checkLogin($post["email"], $post["password"]);

// ログイン認証に失敗したらログインフォームに移動します
if($person_id == false) {
	$_SESSION["error_message"] = "emailとpasswordの組み合わせが間違っています";
	$_SESSION["email"] = $post["email"];
	header("location: login_form.php");
	exit;
}

// ログインに成功したらセッションに会員IDを保存します
$_SESSION["person_id"] = $person_id;

// マイページに移動します
header("location: mypage.php");
exit;