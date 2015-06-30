<?php

require_once("../function/DB/Connect.php");
require_once("../function/DB/TaskDao.php");

class DBUsersql extends DBConnect
{
	// public $user;			//userテーブル
	public $task;			//taskテーブル

	function __construct()
	{
		parent::__construct();

		// $this->user = new UserDao($this->pdo_obj);
		$this->task = new TaskDao($this->pdo_obj);
	}
}