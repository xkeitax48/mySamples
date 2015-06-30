<?php
class diary
{
	private $db;
	private $person_id;

	function __construct($person_id)
	{
		$this->db = new PDO("mysql:host=mysql009.phy.lolipop.lan;
						dbname=LAA0564038-hotaiceweb;
						charset=utf8",
						"LAA0564038", "shinod");

		$this->person_id = $person_id;
	}

	function read($year = null, $month = null, $day= null)
	{
		$date_sql = "";
$sql =<<< SQL_END
SELECT
	a_person.name
	a_diary.post
FROM a_diary
LEFT JOIN a_person
	ON a_person.person_id = a_diary.person_id
WHERE
	a_diary.person_id
	{$date_sql}
;
SQL_END;

	$stmt = $db->prepare($sql);
	$stmt->execute(array("id" => $person_id));

	$diary = $stmt->fetch(PDO::FETCH_ASSOC);
	return $diary;
	}
}

?>