<?php
// ログインフォームを表示します
require_once("lib_display.php");
error_reporting(E_ALL);





$data = array(
	"aaa"	=> array(
				"data1a"		=> "1<BR>a",
				"data2a"		=> "2<BR>a",
			),
	"bbb"	=> array(
				"data1b"		=> "1<BR>b",
				"data2b"		=> "2<BR>b",
			),
	"ccc"	=> array(
				"AAA"	=> array(
					"data1cA"		=> "1<BR>cA",
					"data2cA"		=> "2<BR>cA",
				),
				"BBB"	=> array(
					"data1cB"		=> "1<BR>cB",
					"data2cB"		=> "2<BR>cB",
				),
			),
);


$data = escapeStringRecursive($data);

print "<pre>";var_dump($data);print "</pre>";
exit;


