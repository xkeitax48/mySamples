<?php
require_once("DB/UserSql.php");

$DB = new DBUsersql();

$forms = $_POST;

$DB->member->insertOne($forms);

header("location: index.php");
exit();