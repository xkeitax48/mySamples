<?php
// 登録完了ページを表示します
error_reporting(E_ALL);
session_start();
require_once("lib_display.php");
require_once("lib_DB.php");

// register_finish.htmlを表示します
displayFile("register_finish.html");

// セッション情報を削除します
session_destroy();