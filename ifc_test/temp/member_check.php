<?php

require_once("config.php");
require_once(DIR_LIB . "SetUpPC.php");

require_once(DIR_HTDOCS . "formList.php");

$form = new formList($_POST);

// 受け取った値をセッションにセットします
foreach($form->post as $key) {
	$_SESSION[$key] = isset($_POST[$key]) ? $_POST[$key] : null;
}

// バリデート用にセッションにセットします
$_SESSION["re_and_password"] = array($_SESSION["password"], $_SESSION["re_password"]);
$_SESSION["birth_date"] = array($_SESSION["birth_year"], $_SESSION["birth_month"], $_SESSION["birth_day"]);

// エラーチェックします
$result = $form->validate($_SESSION);

// エラーがあった場合
if($result == false) {

	// セッションにエラーメッセージを保存します
	foreach($form->messages as $error_name=>$message) {
		$_SESSION[$error_name] = $message;
	}

	// フォームに戻ります
	header("location: member_form.php");
	exit;
}

// エラーが無かったら次に進みます
header("location: member_confirm.php");
exit;