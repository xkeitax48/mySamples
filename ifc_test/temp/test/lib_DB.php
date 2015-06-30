<?php
// データベースの処理です
error_reporting(E_ALL);

// DBに接続します
function connectDb() {
	$db = "mysql:host=mysql022.phy.lolipop.lan;
			dbname=LAA0592880-watarai;
			charset=utf8";
	$user = "LAA0592880";
	$password = "ifchr";

	$db = "mysql:localhost;
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

// 性別を取得します
// 取得できなければfalseを返します
function getGender($gender_id) {
	$db = connectDb();

$sql =<<<SQL_END
SELECT gender
FROM mst_gender
WHERE gender_id = :id
;
SQL_END;

	$stmt = $db->prepare($sql);
	$stmt->execute(array(":id" => $gender_id));

	$gender_data = $stmt->fetch(PDO::FETCH_ASSOC);
	return $gender_data["gender"];
}

// 都道府県を取得します
// 都道府県コードがあれば対応する都道府県を取得します
// 取得できなければfalseを返します
function getPrefecture($code=null) {
	$db = connectDb();

	$sql_arg = null;
	$code_sql = "";

	if($code != null) {
		$sql_arg = array(":code" => $code);
		$code_sql = "WHERE prefecture_code = :code";
	}

$sql =<<<SQL_END
SELECT
	prefecture_code,
	prefecture_name
FROM mst_prefecture
{$code_sql}
;
SQL_END;

	if($code != null) {
		$stmt = $db->prepare($sql);
		$stmt->execute($sql_arg);

		$prefecture = $stmt->fetch(PDO::FETCH_ASSOC);
		return $prefecture["prefecture_name"];
	}
	$stmt = $db->query($sql);
	$stmt->execute();

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// アカウント情報を取得します
// 取得できなければfalseを返します
function getMember($email) {
	$db = connectDb();

$sql =<<<SQL_END
SELECT
	member_id,
	password
FROM member
WHERE account = :account
;
SQL_END;

	$stmt = $db->prepare($sql);
	$stmt->execute(array(":account" => $email));

	return $stmt->fetch(PDO::FETCH_ASSOC);
}

// アカウント情報をDBに保存します
// 保存できなければfalseを返します
function addMember($member_data) {
	$db = connectDb();

	$sql_arg = array(":account" => $member_data["email"],
					":password" => $member_data["password"],
					":created_at" => $member_data["created_at"]);

$sql =<<<SQL_END
INSERT INTO member (account, password, created_at)
VALUES (:account, :password, :created_at)
;
SQL_END;

	$stmt = $db->prepare($sql);
	return $stmt->execute($sql_arg);
}

// 会員情報をDBに保存します
// 保存できなければfalseを返します
function addMemberInfo($member_data) {
	$db = connectDb();

	$strings = array("member_id",
					"email",
					"last_name",
					"first_name",
					"last_kana",
					"first_kana",
					"gender_id",
					"birthday",
					"prefecture_code",
					"updated_at");
	$sql_arg = array();
	$column_sql = null;
	$value_sql = null;
	$temp = $strings;
	foreach($strings as $string) {
		$sql_arg[$string] = $member_data[$string];
		$column_sql .= $string;
		$value_sql .= ":".$string;
		if(next($temp)) {
			$column_sql .= ", ";
			$value_sql .= ", ";
		}
	}

$sql =<<<SQL_END
INSERT INTO member_info ({$column_sql})
VALUES ({$value_sql})
;
SQL_END;

	$stmt = $db->prepare($sql);
	return $stmt->execute($sql_arg);
}