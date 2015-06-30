<?php

class DBConnect
{
	private $dbhost;	// DB名称
	private $dbuser;	// ユーザ
	private $dbpass;	// パスワード
	private $dbname;	// DB名
	public $pdo_obj;	// PDO インスタンス

	function __construct()
	{
		$this->dbhost = "mysql008.phy.lolipop.lan";
		$this->dbuser = "LAA0600314";
		$this->dbpass = "ifckrowl";
		$this->dbname = "LAA0600314-watarai";

		$this->Connect();
	}

	function Connect()
	{
		$this->pdo_obj = new PDO(
							"mysql:dbname=".$this->dbname.";charset=utf8".";host=".$this->dbhost,
							$this->dbuser,
							$this->dbpass
							);
		return true;
	}
}