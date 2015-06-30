<?php

require_once("config.php");
require_once(DIR_LIB . "SetUpPC.php");

require_once(DIR_LIB_FUNCTION . "DB/Usersql.php");
require_once( DIR_LIB_COMMON . 'Template/MyTemplateEngine.php');			// Template系

$items = array();

$DB = new DBUsersql();

$items["company_count"] = $DB->company->countAll();
$items["COMPANY_LIST"] = $DB->company->getAllCompany();

echo "<pre>";
print_r($items);
echo "</pre>";

// $new_company = array(
// 		"account" => "wkeitaorange@gmail.com",
// 		"password" => "xKeitax48",
// 		"created_at" => date("Y-m-d H:i:s")
// 	);

// $update_company = array(
// 		"company_id" => "3",
// 		"account" => "aaaa",
// 		"password" => "bbbbb"
// 	);

// $DB->company->insertOne($new_company);
// $DB->company->upsertOne($update_company);

$tpl = new MyTemplateEngine();

// values, ignore_escape, add_br, ignore_encode, succeed_value
$tpl->showAll($items, array("company_count"));

exit;
