<?php
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
</body>