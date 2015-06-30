<?php

require_once("../function/DB/Usersql.php");
require_once("../lib/MyTemplateEngine.php");

$items = array();

$DB = new DBUsersql();

$items["task_list"] = $DB->task->getAllTaskById("1");

$loop = array("2" => $items["task_list"]);

displayFile("index.html", null, false, $loop);

exit;