<?php
class view{
	private $_vars;
	
	function __construct()
	{
		$this->_vars = array();
	}

	function setValue($key, $value)
	{
		$this->_vars[$key] = $value;
	}

	function getValue($key)
	{
		return $this->_vars[$key];
	}

	function render($page)
	{
		ob_start();
		include $page;
		return ob_get_clean();
	}
}