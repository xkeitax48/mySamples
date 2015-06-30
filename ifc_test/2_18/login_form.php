<?php
//// ログインするためのフォームを表示するページです ////

// エラーがあれば表示します
error_reporting(E_ALL);

// セッションを開始します
session_start();

require_once("sessionMessage.class.php");

$session_message = new sessionMessage();
$error_message = $session_message->getMessage();

// ログインに失敗したらメッセージを表示します
if(isset($error_message)) {
	echo $error_message;
	$session_message->clearMessage();
}

// ログインに失敗したらフォームにはemailだけ残しておきます
if(isset($_SESSION["email"])) {
	$email = $_SESSION["email"];
}
else {
	$email = "";
}
?>

<!-- ログインフォームを表示します -->
<form method="post" action="login.php">
	email:<br>
	<input
		type="text"
		name="email"
		value="<?php echo $email;?>"
	><br>
	password:<br>
	<input
		type="password"
		name="password"
		value=""
	><br>
	<input
		type="submit"
		value="login"
	>
</form>

<?php
// セッションを空にします
$_SESSION = array();
?>