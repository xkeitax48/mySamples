<?php
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

//// ログイン認証をします ////

require_once("a_function.php");
session_start();

// フォームで空の項目があれば戻ります
if(!isset($_POST["email"]) or !isset($_POST["password"])){
	$_SESSION["message"] = "必要な項目が入力されていません";
	// emailだけ残しておきます
	$_SESSION["email"] = $_POST["email"];
	header('Location: a_login.php');
	exit;
}

// 登録情報を照会します
if($person = getPersonByEmail($_POST["email"])){
	// フォームで入力したパスワードと照合します
	if($_POST["password"] == $person["password"]){
		$_SESSION["person_id"] = $person["person_id"];
		header("location: a_mypage.php");
		exit;
	}
	$_SESSION["message"] = "emailかpasswordが間違っています";
	$_SESSION["email"] = $_POST["email"];
}
header("location: a_login.php");
exit;
?>