<?php
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

require_once("session.class.php");

$session = new session();
$session->clearAll();

header("location: pageController.php");
exit;