<?php
class sessionMessage {
	private $category;

	function __construct($key="form_error_message") {
		$this->category = $key;
	}

	function setMessage($get_message) {
		$_SESSION[$this->category] = $get_message;
	}

	function getMessage() {
		if(isset($_SESSION[$this->category])) {
			return $_SESSION[$this->category];
		}
		else {
			return null;
		}
	}

	function clearMessage() {
		unset($_SESSION[$this->category]);
	}
}