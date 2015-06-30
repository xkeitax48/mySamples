<?php
require_once("Connect.php");
require_once("Dao/MemberDao.php");
require_once("Dao/GenderDao.php");

class DBUsersql extends DBConnect
{
	public $member;
	public $gender;

	function __construct() 
	{
		parent::__construct();

		$this->member = new MemberDao($this->pdo_obj);
		$this->gender = new GenderDao($this->pdo_obj);
	}
}