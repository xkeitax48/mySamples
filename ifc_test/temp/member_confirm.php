<?php

require_once("config.php");
require_once(DIR_LIB . "SetUpPC.php");

require_once(DIR_LIB_COMMON . 'Template/MyTemplateEngine.php');
require_once(DIR_HTDOCS . "formList.php");

$form = new formList();

$items = array();

foreach($form->post as $key) {

	// 必要な事項がセッションにセットされていなければフォームに移動します
	if(!isset($_SESSION[$key])) {
		header("location: member_form.php");
		exit;
	}

	// セッションの値を置換用変数にセットします
	$items[$key] = $_SESSION[$key];
}

// 表示形式を整えます
foreach($form->form_list as $key=>$array) {
	$items[$key] = $array[$_SESSION[$key]];
}


// $items["seibetsu"] = $this->form_list->seibetsu[$items["seibetsu"]];
// $items["todouhuken"] = $this->form_list->todouhuken[$items["todouhuken"]];

// パスワードは伏せて表示します
$items["password_msk"] = str_pad("", strlen($items["password"]), "*");

$tpl = new MyTemplateEngine();

// values, ignore_escape, add_br, ignore_encode, succeed_value
$tpl->showAll($items);
