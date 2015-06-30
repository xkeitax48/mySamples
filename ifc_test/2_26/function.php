<?php
// データベースに接続します
function connectDb() {
	$db_info = "mysql:host=mysql022.phy.lolipop.lan;
				dbname=LAA0592880-watarai;
				charset=utf8";
	$user = "LAA0592880";
	$password = "ifchr";

	// $db_info = "mysql:host=localhost;
	// 			dbname=diary;
	// 			charset=utf8";
	// $user = "root";
	// $password = "root";

	try {
		return new PDO($db_info, $user, $password);
	}
	catch(PDOException $e) {
		echo $e->getMessage();
		exit;
	}
}



// 文字列を置換したファイルを表示します
function displayPageFile($template_filename, $replaces=null) {
	$subject = file_get_contents($template_filename);
	echo replaceString($subject, $replaces);
}

// ファイルのddd__bbbで囲まれた文字列を置き換えて返します
// 置換する文字列が無ければそのまま返します
function replaceString($subject, $replaces=null) {
	if($replaces == null) {
		return $subject;
	}

	$pattern = array();
	$value = array();
	foreach($replaces as $name => $replace) {
		$pattern[] = "/ddd_".$name."_bbb/";
		$value[] = $replace;
	}
	return preg_replace($pattern, $value, $subject);
}

// emailとパスワードでログイン認証をします
// emailかパスワードが間違っていればfalseを返します
function checkLogin($email, $password) {
	$person = getPersonId($email);
	if(!$person || $password != $person["password"]) {
		return false;
	}
	return $person["person_id"];
}


// emailから会員情報を取得します
// 取得できなければfalseを返します
function getPersonId($email) {
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

	return $stmt->fetch(PDO::FETCH_ASSOC);
}


// ログインしている状態か判定します
// ログインしていなければfalseを返します
function isLogin() {
	if(isset($_SESSION["person_id"])) {
		return true;
	}
	return false;
}

// 会員IDから日記情報を取得します
function getDiaryByPersonId($person_id) {
	$db = connectDb();

$sql =<<<END_SQL
SELECT
	a_diary.create_day,
	DATE_FORMAT(a_diary.create_day, "%Y%m%d") AS yyyymmdd,
	a_person.name
FROM a_diary
LEFT JOIN a_person
	ON a_person.person_id = a_diary.person_id
WHERE a_diary.person_id = :id
ORDER BY create_day
;
END_SQL;

	$stmt = $db->prepare($sql);
	$stmt->execute(array(":id" => $person_id));

	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// 文字列をエスケープします
function escapeString($strings) {
	foreach($strings as $key => $string) {
		$escaped_str[$key] = htmlspecialchars($string);
	}
	return $escaped_str;
}





/*

define("LOGIN_USER_SESSION_KEYNAME", "person_id");


// ログインしている状態か判定します
// ログインしていなければfalseを返します
function isLogin() {
	if(isset($_SESSION[LOGIN_USER_SESSION_KEYNAME])) {
		return true;
	}
	return false;
}


function logout() {
	// セッション情報を削除します
	session_destroy();
}


function login($person_id) {
	$_SESSION[LOGIN_USER_SESSION_KEYNAME] = $person_id;
}

*/

