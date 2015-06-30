<?php
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

//// ログイン認証をします ////

require_once("a_function.php");
session_start();

if(isset($_POST["email"])){
$_SESSION["email"] = $_POST["email"];
}

// フォームで空の項目があれば戻ります
if(empty($_POST["email"]) or empty($_POST["password"])){
	$_SESSION["message"] = "必要な項目が入力されていません";
	header('Location: a_login.php');
	exit;
}

// ID/PWが指定されているのでログインの認証します

//認証されなかったので、ログインページへ
if(($person_id = loginCheck($_POST["email"], $_POST["password"])) == false){
	$_SESSION["message"] = "emailかpasswordが間違っています";
	header("location: a_login.php");
	exit;
}

$_SESSION["person_id"] = $person_id;

//認証されたのでマイページへ
header("location: a_mypage.php");
exit;
?>