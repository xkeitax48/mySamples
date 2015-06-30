<?php
class diarModel {
	private $db;
	private $person_id;
	private $date;

	function __construct($person_id, $date=null) {
		$this->db = new PDO("mysql:host=mysql009.phy.lolipop.lan;
							dbname=LAA0564038-hotaiceweb;
							charset=utf8", "LAA0564038", "shinod");
		$this->person_id = $person_id;
		$this->date = $date;
	}

	// 会員IDと日付から日記を取得します
	// 会員IDだけなら日記一覧を取得します
	// 取得できなければfalseを返します
	function getPost() {
		$date_sql = "";
		$sql_arg = array(":id" => $this->person_id);

		if($date != null) {
			$date_sql = " AND DATE_FORMAT(a_diary.create_day, \"%Y%m%d\") = :date";
			$sql_arg[":date"] = sprintf("%04d", $this->date);
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
}