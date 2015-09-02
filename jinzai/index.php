<?php
require_once("config.php");
require_once("DB/UserSql.php");

$DB = new DBUsersql();

$members = $DB->member->getAllMember();

?>
<body>
	<table>
		<tr>
			<th>姓</th>
			<th>名</th>
			<th>性別</th>
			<th>年齢</th>
		</tr>
		<?php foreach($members as $member): ?>
			<tr>
				<td><?= $member["last_name"] ?></td>
				<td><?= $member["first_name"] ?></td>
				<td><?= $member["gender_id"] ?></td>
				<td><?= $member["age"] ?></td>
			</tr>
		<?php endforeach; ?>
	</table>

	<a href="form.php">新規登録</a>

	<iframe width="560" height="315" src="https://www.youtube.com/embed/Q0z-C8Ke2FQ" frameborder="0" allowfullscreen></iframe>
	<!-- SnapWidget -->
<iframe src="http://snapwidget.com/in/?h=YW1hemluZ3xpbnwxMjV8M3wzfHxub3w1fG5vbmV8b25TdGFydHx5ZXN8bm8=&ve=070715" title="Instagram Widget" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:390px; height:390px"></iframe>
</body>