<?php
// DBの処理です

// データベースに接続します
function connectDb() {
	$db = "mysql:host=mysql022.phy.lolipop.lan;
			dbname=LAA0592880-watarai;
			charset=utf8";
	$user = "LAA0592880";
	$password = "ifchr";

	$db = "mysql:host=localhost;
			dbname=testuser;
			charset=utf8";
	$user = "testuser";
	$password = "ifctest";

	try {
		return new PDO($db, $user, $password);
	}
	catch(PDOException $e) {
		echo $e->getMessage();
		exit;
	}
}

// emailから会員情報を取得します
// 取得できなければfalseを返します
function getPersonData($email) {
	$db = connectDb();

$sql =<<<SQL_END
SELECT
	person_id,
	password,
	name
FROM a_person
WHERE email = :email
;
SQL_END;

	$stmt = $db->prepare($sql);
	$stmt->execute(array(":email" => $email));
	return $stmt->fetch(PDO::FETCH_ASSOC);
}

// 会員IDで日記の情報一覧を取得します
// 日付も指定されていればその日記だけを取得します
// 取得できなければfalseを返します
function getDiaryData($person_id, $date=null) {
	$db = connectDb();
	$sql_arg = array(":id" => $person_id);
	$date_sql = null;

	if($date != null) {
		$sql_arg[":date"] = sprintf("%04d", $date);
		$date_sql = "AND DATE_FORMAT(a_diary.create_day, \"%Y%m%d\")= :date";
	}

$sql =<<<SQL_END
SELECT
	a_diary.create_day,
	DATE_FORMAT(a_diary.create_day, "%Y%m%d") AS yyyymmdd,
	a_diary.post,
	a_person.name
FROM a_diary
LEFT JOIN a_person
	ON a_person.person_id = a_diary.person_id
WHERE a_diary.person_id = :id
{$date_sql}
ORDER BY a_diary.create_day
;
SQL_END;

	$stmt = $db->prepare($sql);
	$stmt->execute($sql_arg);

	if($date != null) {
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}