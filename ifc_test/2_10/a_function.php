<?php
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

// データベースに接続します
// 失敗したらエラーメッセージを表示します
function connectDb() {
	try {
		return new PDO("mysql:host=mysql009.phy.lolipop.lan;
						dbname=LAA0564038-hotaiceweb;
						charset=utf8",
						"LAA0564038", "shinod");
	}
	catch(PDOException $e) {
		echo $e->getMessage();
		exit;
	}
}


// ログインしてるかどうか判定します
function isLogin() {
	if (!isset($_SESSION["person_id"])) {
		return false;
	}
	return true;
}


// emailから登録情報をとってきます
// 無ければfalseを返します
function getPersonByEmail($email) {
	$dbh = connectDb();

$sql =<<< SQL_END
SELECT
	person_id,
	password
FROM a_person
WHERE email = :email
;
SQL_END;

	$stmt = $dbh->prepare($sql);
	$stmt->execute(array(':email' => $email));

	return $stmt->fetch(PDO::FETCH_ASSOC);
}


// 登録情報から日記一覧をとってきます
function getDiaryByPersonId($person_id) {
		$dbh = connectDb();

$sql =<<< SQL_END
SELECT
	a_person.name,
	a_diary.create_day,
	DATE_FORMAT(a_diary.create_day, "%m/%d") AS month_day,
	DATE_FORMAT(a_diary.create_day, "%Y%m%d") AS yyyymmdd,
	SUBSTR(a_diary.post, 1, 5) AS post_head,
	a_diary.person_id,
	a_diary.post
FROM a_diary
LEFT JOIN a_person
	ON  a_person.person_id = a_diary.person_id
WHERE a_diary.person_id = :id
ORDER BY create_day
;
SQL_END;

	$stmt = $dbh->prepare($sql);
	$stmt->execute(array(':id' => $person_id));

	while ($data_1day = $stmt->fetch(PDO::FETCH_ASSOC)) {
		printf("%s<a href=\"a_diary.php?id=%s&date=%s\">%s</a>%s<br>\n",
			$data_1day["month_day"],
			$data_1day["person_id"],
			$data_1day["create_day"],
			$data_1day["post_head"],
			$data_1day["name"]
		);
	}
}

// 表示します


// 登録情報と日付から日記情報を１つとってきます
// 無ければfalseを返します
function getDiaryByPersonIdAndDate ($id, $date) {
		$dbh = connectDb();

$sql =<<<SQL_END
SELECT
	a_person.name,
	a_diary.create_day,
	a_diary.post
FROM a_diary
LEFT JOIN a_person
	ON  a_person.person_id = a_diary.person_id
WHERE
	a_person.person_id = :id
	AND a_diary.create_day = :date
;
SQL_END;

	$stmt = $dbh->prepare($sql);
	$stmt->execute(array(':id' => $id, ':date' => $date));

	return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>