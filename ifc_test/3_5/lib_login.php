<?php
// ログインの処理です
require_once("lib_DB.php");

// ログインしているか判定します
// ログインしていなければfalseを返します
function isLogin() {
	if(isset($_SESSION["person_id"])) {
		return true;
	}
	return false;
}

// emailかpasswordが合っていれば会員情報を返します
//　どちらか間違っていればfalseを返します
function checkLogin($email, $password) {
	$person = getPersonData($email);
	if(!$person || $person["password"] != $password) {
		return false;
	}
	return $person;
}

// セッションに会員IDと名前を保存します
function login($person_id, $name) {
	$_SESSION["person_id"] = $person_id;
	$_SESSION["name"] = $name;
}

// セッションから会員IDと名前を削除します
function logout() {
	unset($_SESSION["person_id"]);
	unset($_SESSION["name"]);
}