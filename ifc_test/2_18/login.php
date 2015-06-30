<?php
//// ログイン処理を実行するページです ////

// エラーがあれば表示します
error_reporting(E_ALL);

// セッションを開始します
session_start();

// 関数のファイルを読み込みます
require_once("function.php");
require_once("sessionMessage.class.php");

// emailとpasswordがPOSTされているか判定します
// POSTされてなければログインフォームに戻ります
if(empty($_POST["email"]) or empty($_POST["password"])) {
	$session_message = new sessionMessage();
	$session_message->setMessage("入力されていない項目があります");
	header("location: login_form.php");
	exit;
}

// emailから会員情報を取得します
$person = getPersonIdByEmail($_POST["email"]);

// 会員情報が無ければログインフォームに戻ります
if(!$person) {
	message("emailかpasswordが間違っています");
	$_SESSION["email"] = $_POST["email"];
	header("location: login_form.php");
	exit;
}

// 入力されたパスワードと会員情報を照合します
// パスワードが間違っていればログインフォームに戻ります
if($_POST["password"] != $person["password"]) {
	message("emailかpasswordが間違っています");
	$_SESSION["email"] = $_POST["email"];
	header("location: login_form.php");
	exit;
}

// マイページに移動します
$_SESSION["person_id"] = $person["person_id"];
header("location: mypage.php");
exit;

?>