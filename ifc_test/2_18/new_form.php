<?php
//// 日記を新規作成するためのフォームを表示するページです ////

// エラーがあれば表示します
error_reporting(E_ALL);

// セッションを開始します
session_start();

// 関数のファイルを読み込みます
require_once("function.php");

// ログインしていなければログインフォームに戻ります
if(!isLogin()) {
	message("ログインしてください");
	header("location: login_form.php");
	exit;
}
?>

<!-- 新規作成フォームを表示します -->
<form method="post" action="new.php">
	post:<br>
	<input
		type="text"
		name="post"
		value=""
	><br>
	<input
		type="submit"
		value="create!"
	><br>
</form>

<?php
// マイページへのリンクを表示します
echo "<a href=\"mypage.php\">戻る</a><br>";
?>