<?php
// ログイン処理をします
require_once("lib_login.php");
error_reporting(E_ALL);
session_start();

// すでにログインしていればログアウトします
if(isLogin()) {
	logout();
}

// emailとpasswordがPOSTされているか判定します
// どちらかPOSTされていなければログインページに移動します
if(empty($_POST["email"]) || empty($_POST["password"])) {
	$_SESSION["message"] = "入力されてない項目があります";
	$_SESSION["email"] = isset($_POST["email"]) ? $_POST["email"] : null;
	header("location: login_form.php");
	exit;
}

// ログイン認証をします
$person = checkLogin($_POST["email"], $_POST["password"]);

// ログイン認証に失敗したらログインページに移動します
if($person == false) {
	$_SESSION["message"] = "emailとpasswordの組み合わせが間違っています";
	$_SESSION["email"] = $_POST["email"];
	header("location: login_form.php");
	exit;
}

// ログイン認証に成功したのでログインします
login($person["person_id"], $person["name"]);

// マイページに移動します
header("location: mypage.php");
exit;