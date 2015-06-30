<?php

class DBCommon
{
	protected $pdo_obj;			// PDO インスタンス
	protected $stmt;			// PDOStatement オブジェクト

	function __construct($pdo_obj) 
	{
		$this->pdo_obj = $pdo_obj;
	}
}