<?php
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

//// ログインのための入力フォームを表示します ////

session_start();

// ログインに失敗したらメッセージを表示します
if (isset($_SESSION["message"])) {
	echo $_SESSION["message"];
}

// 最初に訪れたときはemailには何も入力されていません
$form_email = "";

// ログインに失敗したらemailを自動入力します
if (isset($_SESSION["email"]))  {
	$form_email = $_SESSION["email"];
}
?>

<!-- ログインフォームを表示します -->
<form method="post" action="login.php">
	email:<br><input type="text" name="email"
	value="<?php echo $form_email;?>"><br>
	password:<br><input type="password" name="password"
	value=""><br>
	<input type="submit" value="login">
</form>

<?php
// セッションを空にします
$_SESSION = array();
?>