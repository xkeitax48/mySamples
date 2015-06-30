
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<title>Task Manegement</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<link rel='stylesheet' href='iphone.css' />
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
	<!-- <link href="iphone.css" rel="stylesheet" type="text/css" media="screen and (min-device-width: 481px)"> -->
	<!-- <link href="iphone.css" rel="stylesheet" type= "text/css" media="only screen and (max-device-width: 480px)"> -->
	<!--[if IE]>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<![endif]-->
</head>
<body>
	<?php
		//データベース情報
		$url = "mysql009.phy.lolipop.lan";
		$user = "LAA0564038";
		$pass = "shinod";
		$db = "LAA0564038-hotaiceweb";
		
		//mysqlに接続
		$link = mysql_connect($url, $user, $pass) or die("MySQLの接続に失敗しました。");
		
		//データベースを選択する
		$sdb = mysql_select_db($db, $link) or die("DBの選択に失敗しました。");
		
		//文字化け回避
		
	?>
	<?php mysql_query("SET NAMES utf8", $link); ?>
	
	<div class="header">
		<h1>Task Management</h1>
		<span class="start">≡</span>
	</div>
	気になることを追加してください。<br>
	
	<form>
		<p>
			<input type="text">
			<button type="submit" value="Add" class="addTask">Add</button>
		</p>
	</form>
	
	<?php
		//クエリを送信する
		$sql = "SELECT * FROM i_task";
		$result = mysql_query($sql, $link) or die("クエリの送信に失敗しました。");
		
		//表示するデータを作成
		while($row = mysql_fetch_assoc($result)) {
			echo "<p>".$row["title"]."</p>";
		}
		
		//mysqlの接続を閉じる
		mysql_close($link) or die("MySQL切断に失敗しました。");
	?>


</body>
</html>
