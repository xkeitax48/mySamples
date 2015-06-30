<?php
require_once("Common.php");

class MemberDao extends DBCommon
{
	function __construct($pdo_obj)
	{
		$table_name = "member";

		parent::__construct($table_name, $pdo_obj);
	}

	function getAllMember()
	{
		$sql = <<< SQL_END
SELECT
	last_name,
	first_name,
	gender_id,
	age
FROM member
;
SQL_END;

		return $this->selectAll($sql);
	}
}