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
function isNotLogin() {
	if (!isset($_SESSION["person_id"])) {
		return true;
	}
	return false;
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



/*
// emailから登録情報をとってきます
// 無ければfalseを返します
function getPersonByEmail($my_email) {
//print "<pre>";var_dump($my_email);print "</pre>";exit;

	$handle = @fopen("pass.txt", "r");

	$person = false;

	if ($handle) {
		while (($buffer = fgets($handle)) !== false) {
			list($person_id, $name, $kana, $email, $password) = explode(",", $buffer);

			if($email == $my_email){
				$person = array(
								"person_id"	=> trim($person_id),
								"password"	=> trim($password),
								);
				break;
			}
		}

		fclose($handle);
	}

	return $person;
}
*/



// 登録情報から日記一覧をとってきます
function getDiaryByPersonId($person_id, $year=null, $month=null, $day=null) {
	$dbh = connectDb();

	$year_month_sql = "";
	$sql_arg = array(':id' => $person_id);

	if($year != null){
		if($month != null){
			if($day != null){
				$year_month_sql = "	AND DATE_FORMAT(a_diary.create_day, \"%Y%m%d\") = :date ";
				$sql_arg[':date'] = sprintf("%04d%02d%02d", $year, $month, $day);
			}else{
				$year_month_sql = "	AND DATE_FORMAT(a_diary.create_day, \"%Y%m\") = :date ";
				$sql_arg[':date'] = sprintf("%04d%02d", $year, $month);
			}
		}else{
			$year_month_sql = "	AND DATE_FORMAT(a_diary.create_day, \"%Y\") = :date ";
			$sql_arg[':date'] = sprintf("%04d", $year);
		}
	}

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
{$year_month_sql}
ORDER BY create_day
;
SQL_END;

	$stmt = $dbh->prepare($sql);
	$stmt->execute($sql_arg);

	$diaries = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $diaries;
}



// 日記一覧を表示します
function printDiary($diaries) {
	foreach($diaries as $diary) {
		printf("%s<a href=\"a_diary.php?id=%s&date=%s\">%s</a>%s<br>\n",
			$diary["month_day"],
			$diary["person_id"],
			$diary["create_day"],
			$diary["post_head"],
			$diary["name"]
		);
	}
}



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





function loginCheck($email, $password)
{
	if($person = getPersonByEmail($email)){
		// フォームで入力したパスワードと照合します
		if($password == $person["password"]){
			return $person["person_id"];
		}
	}

	return false;
}




?>