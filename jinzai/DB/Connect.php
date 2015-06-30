<?php
require_once("DBConfig.php");

class DBConnect
{
	private $dbhost;
	private $dbuser;
	private $dbpass;
	private $dbname;
	public $pdo_obj;

	function __construct() 
	{
		$this->dbhost = DB_HOST;
		$this->dbuser = DB_USER;
		$this->dbpass = DB_PASS;
		$this->dbname = DB_NAME;

		$this->pdo_obj = $this->connect();
	}

	private function connect()
	{
		$db = "mysql:host=".$this->dbhost.";dbname=".$this->dbname.";charset=utf8";

		return new PDO($db, $this->dbuser, $this->dbpass);
	}
}