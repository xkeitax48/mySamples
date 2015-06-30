<?php
// ログアウト処理をします
require_once("lib_login.php");
error_reporting(E_ALL);
session_start();

// ログアウトします
logout();

// ログインページに移動します
header("location: login_form.php");
exit;