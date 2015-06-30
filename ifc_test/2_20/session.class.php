<?php
class session {

	function __construct()
	{
		session_start();
	}

	function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	function get($key)
	{
		if(isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
		else {
			return null;
		}
	}

	function unsetValue($key)
	{
		unset($_SESSION[$key]);
	}

	function clearAll()
	{
		$_SESSION = array();
	}
}