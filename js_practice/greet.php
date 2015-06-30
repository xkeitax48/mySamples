<?php
$arr_json = array(
		"message" => $_GET["test"],
		"length" => strlen($_GET["test"])
	);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($arr_json);