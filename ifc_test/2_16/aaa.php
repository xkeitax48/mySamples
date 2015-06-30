<?php
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);


require_once("a_function.php");
session_start();

print "<pre>";var_dump(getDiaryByPersonId(1));print "</pre>";
print("<HR>");
print "<pre>";var_dump(getDiaryByPersonId(1, 2015));print "</pre>";
print("<HR>");
print "<pre>";var_dump(getDiaryByPersonId(1, 2015, 2));print "</pre>";
print("<HR>");
print "<pre>";var_dump(getDiaryByPersonId(1, 2015, 2, 3));print "</pre>";
exit;

exit;
?>