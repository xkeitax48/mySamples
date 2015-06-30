<?php
require_once("Common.php");

class GenderDao extends DBCommon
{
	function __construct($pdo_obj)
	{
		$table_name = "gender";

		parent::__construct($table_name, $pdo_obj);
	}

	function getAllGender()
	{
		$sql = <<< SQL_END
SELECT
	gender_id,
	gender_name
FROM mst_gender
;
SQL_END;

		return $this->selectAllKey($sql, array("gender_id"));
	}
}