<?php

require_once("../function/DB/Common.php");

class TaskDao extends DBCommon
{
	function __construct($pdo_obj)
	{
		$this->pdo_obj = $pdo_obj;
	}

	function getAllTaskById($user_id)
	{
		$sql = <<< SQL_END
SELECT
	task_id,
	task_name,
	project_id,
	context_id
FROM
	task
WHERE
	user_id = :id
ORDER BY
	task_id
;
SQL_END;

		$this->stmt = $this->pdo_obj->prepare($sql);
		$this->stmt->execute(array(":id" => $user_id));

		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}