<?php

require_once("config.php");
require_once(DIR_LIB . "SetUpPC.php");

require_once(DIR_LIB_FUNCTION . "DB/watarai_Usersql.php");

$DB = new DBUsersql();

// member_infoテーブルにinsertする項目です					<--ここに書くべきではない？
$member = array(
				"account"		=>	$_SESSION["email"],
				"password"		=> 	sha1($_SESSION["password"]),
				"created_at" 	=> 	date("Y-m-d H:i:s")
			);

// member_infoテーブルにinsertする項目です					<--ここに書くべきではない？
$member_info = array(
					"email" 			=> 	$_SESSION["email"],
					"last_name" 		=> 	$_SESSION["sei"],
					"first_name" 		=> 	$_SESSION["mei"],
					"last_kana" 		=> 	$_SESSION["sei_kana"],
					"first_kana" 		=> 	$_SESSION["mei_kana"],
					"gender_id" 		=> 	$_SESSION["seibetsu"],
					"birthday" 			=> 	$_SESSION["birth_year"]."-".$_SESSION["birth_month"]."-".$_SESSION["birth_day"],
					"prefecture_code" 	=> 	$_SESSION["todouhuken"],
					"updated_at" 		=> 	date("Y-m-d H:i:s")
				);

// 会員情報を登録します
$DB->insertOneMember($member, $member_info);

// セッションの値を破棄します
session_destroy();

// フォームに戻ります
header("location: member_form.php");
exit;