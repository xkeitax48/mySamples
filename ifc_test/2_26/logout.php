<?php
// ログアウト処理をします

error_reporting(E_ALL);
session_start();

// セッション情報を削除します
session_destroy();

// ログインフォームに移動します
header("location: login_form.php");
exit;