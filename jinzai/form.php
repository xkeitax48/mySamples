<?php
require_once("config.php");
require_once("DB/UserSql.php");

$DB = new DBUsersql();

$gender_list = $DB->gender->getAllGender();

?>
<body>
	<form action="save.php" method="post">
		<table>
			<tr>
				<th>姓</th>
				<td><input type="text" name="last_name"></td>
			</tr>
			<tr>
				<th>名</th>
				<td><input type="text" name="first_name"></td>
			</tr>
			<tr>
				<th>性別</th>
				<td>
					<select name="gender_id">
					<?php foreach($gender_list as $gender): ?>
						<?= "<option value=\"".$gender["gender_id"]."\">".$gender["gender_name"]."</option>" ?>
					<?php endforeach; ?>
				</td>
			</tr>
			<tr>
				<th>年齢</th>
				<td><input type="text" name="age"></td>
			</tr>
		</table>
		<input type="submit" value="保存">
	</form>
</body>