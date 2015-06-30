<?php
class user {
	private $db;
	private $posted_email;
	private $posted_password;
	private $person_id;

	function __construct($posted_email=null, $posted_password=null)
	{
		$this->db = new PDO("mysql:host=mysql009.phy.lolipop.lan;
							dbname=LAA0564038-hotaiceweb;
							charset=utf8", "LAA0564038", "shinod");
		require_once("session.class.php");

		$this->email = $posted_email;
		$this->password = $posted_password;
		$this->person_id = null;
	}

	function loginAuth()
	{
		$_person = $this->getPerson();
		if(!$_person) {
			return "failure";
		}
		else {
			return $this->passwordCheck($_person);
		}
	}

	function getPerson()
	{

$sql =<<<SQL_END
SELECT
	person_id,
	password
FROM a_person
WHERE email = :email
;
SQL_END;

		$stmt = $this->db->prepare($sql);
		$stmt->execute(array(":email" => $this->email));

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function passwordCheck($person)
	{
		if($person["password"] == $this->password) {
			$this->person_id = $person["person_id"];
			return "success";
		}
		else {
			return "failure";
		}
	}

	function setSession($result)
	{
		$session = new session();
		switch($result) {
			case "empty":
				$session->set("error_message", "入力されていない項目があります");
				$session->set("posted_email", $this->email);
				break;
			case "failure":
				$session->set("error_message", "emailかpasswordが間違っています");
				$session->set("posted_email", $this->email);
				break;
			case "success":
				$session->set("person_id", $this->person_id);
				break;
		}
	}

	function checkLogin()
	{
		$session = new session();
		$login = $session->get("person_id");
		if(isset($login)) {
			return true;
		}
		else {
			return false;
		}
	}
}