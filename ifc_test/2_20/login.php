<?php
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

require_once("user.class.php");

// emailとpasswordがPOSTされているか判定します
// どちらかPOSTされていればログイン認証をします
if(!empty($_POST["email"]) or !empty($_POST["password"])) {
	$user = new user($_POST["email"], $_POST["password"]);
	$auth_result = $user->loginAuth();
}
// emailとpasswordがPOSTされていれば結果はemptyです
else {
	$user = new user();
	$auth_result = "empty";
}

// 結果を元にセッションを保存します
$user->setSession($auth_result);

// コントローラに戻ります
header("location: pageController.php");
exit;




// setSession()が微妙だと思う