<?php

require_once("config.php");
require_once(DIR_LIB . "SetUpPC.php");

require_once(DIR_LIB_COMMON . 'Template/MyTemplateEngine.php');
require_once(DIR_HTDOCS . "formList.php");

$form = new formList();

// セッションの値を置換用変数にセットします					<---issetで調べる必要あり？
$items = $_SESSION;

// 選択項目のリストをセットします
foreach($form->form_list as $form_name=>$array) {
	foreach($array as $key => $val) {
		$items[$form_name."_list"][] = array(
										$form_name."_code" => $key,
										$form_name => $val
									);
	}
}

$tpl = new MyTemplateEngine();

// values, ignore_escape, add_br, ignore_encode, succeed_value
$tpl->showAll($items);

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

session_destroy();