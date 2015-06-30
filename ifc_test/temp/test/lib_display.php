<?php
// テンプレートの処理です
error_reporting(E_ALL);

// 指定したテンプレートファイルを1行ずつ表示します
function displayFile($file_name, $replaces=null, $loop=array()) {
	$lines = file($file_name);
	foreach($lines as $line_num => $line) {
		if(!isset($loop[$line_num+1])) {
			echo replaceString($line, $replaces);
		}
		else {
			foreach($loop[$line_num+1] as $replaces) {
				echo replaceString($line, $replaces);
			}
		}
	}
}

// 指定した文字列を変換して返します
function replaceString($subject, $replaces=null) {
	if($replaces == null) {
		return $subject;
	}
	$pattern = array();
	$value = array();
	foreach($replaces as $string => $replace) {
		$pattern[] = "/qqq_".$string."_ppp/";
		$value[] = $replace;
	}
	return preg_replace($pattern, $value, $subject);
}