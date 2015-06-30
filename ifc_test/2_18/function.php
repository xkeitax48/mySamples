<?php
////　関数　////

// データベースに接続します
function connectDb() {
	try {
		return new PDO("mysql:host=mysql009.phy.lolipop.lan;
						dbname=LAA0564038-hotaiceweb;
						charset=utf8", "LAA0564038", "shinod");
	}
	catch(PDOException $e) {
		echo $e->getMessage();
		exit;
	}
}

// セッションにメッセージを保存します
function message($message) {
	$_SESSION["message"] = $message;
}

// emailから会員情報を取得します
// 取得できなければfalseを返します
function getPersonIdByEmail($email) {
	$db = connectDb();

$sql =<<<SQL_END
SELECT
	person_id,
	password
FROM a_person
WHERE email = :email
;
SQL_END;

	$stmt = $db->prepare($sql);
	$stmt->execute(array(":email" => $email));

	$person = $stmt->fetch(PDO::FETCH_ASSOC);
	return $person;
}

// ログイン判定をします
// ログインしていなければfalseを返します
function isLogin() {
	if(isset($_SESSION["person_id"])) {
		return true;
	}
	message("ログインしてください");
	return false;
}

// 会員IDと日付から日記を取得します
// 会員IDだけなら日記一覧を取得します
// 取得できなければfalseを返します
function getDiary($person_id, $date=null) {
	$db = connectDb();

	$date_sql = "";
	$sql_arg = array(":id" => $person_id);

	if($date != null) {
		$date_sql = " AND DATE_FORMAT(a_diary.create_day, \"%Y%m%d\") = :date";
		$sql_arg[":date"] = sprintf("%04d", $date);
	}

$sql =<<<SQL_END
SELECT
	a_diary.person_id,
	a_diary.create_day,
	DATE_FORMAT(a_diary.create_day, "%Y%m%d") AS yyyymmdd,
	a_person.name,
	a_diary.post
FROM a_diary
LEFT JOIN a_person
	ON a_person.person_id = a_diary.person_id
WHERE a_diary.person_id = :id
{$date_sql}
ORDER BY create_day
;
SQL_END;

	$stmt = $db->prepare($sql);
	$stmt->execute($sql_arg);

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// 日記の一覧を表示します
function printDiaryAll($diaries) {
	foreach($diaries as $diary) {
		printf("<a href=\"diary.php?date=%s\">%s %s</a> %s<br>",
			$diary["yyyymmdd"],
			$diary["create_day"],
			$diary["name"],
			$diary["post"]
		);
	}
}

// 日記の詳細を表示します
function printDiaryDay($diaries) {
	foreach($diaries as $diary) {
		echo $diary["create_day"]."<br>"
			.$diary["name"]."<br>"
			.$diary["post"]."<br>"
		;
	}
}

// 記事をDBに書き込みます
function createNewPost($person_id, $date, $post) {
	$db = connectDb();

$sql =<<<SQL_END
INSERT INTO a_diary
VALUE (:id, :date, 0, :post)
;
SQL_END;

	$stmt = $db->prepare($sql);
	$stmt->execute(array(
		":id" => $person_id,
		":date" => $date,
		":post" => $post
		)
	);
}

?>