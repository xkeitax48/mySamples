<?php
// 会員登録の処理です
error_reporting(E_ALL);
require_once("lib_DB.php");

// 会員登録の条件を満たしているか判定します
// 満たしていなければfalseを返します
function checkRegister($email, $password, $re_password) {
	$account = getMember($email);
	if($account || !checkPassword($password, $re_password)) {
		return false;
	}
	return true;
}

// パスワードが条件を満たしているか判定します
// 満たしていなければfalseを返します
function checkPassword($password, $re_password) {
	$length = strlen($password);
	if($length < 8 || $length > 16 || $password != $re_password) {
		return false;
	}
	return true;
}

// 会員登録をします
// 失敗したらfalseを返します
function signUp($member_data) {
	if(!addMember($member_data)) {
		return false;
	}
	$account = getMember($member_data["email"]);
	$member_data["member_id"] = $account["member_id"];
	if(!addMemberInfo($member_data)) {
		return false;
	}
	return true;
}