<?php
// テンプレートの処理です

// 指定したファイルを1行ずつ置換して表示します
function displayFile($file_name, $replaces=null, $loop=array(), $escape=false) {
	if($escape != false) {
		$replaces = escapeString($replaces);
	}
	$lines = file("templates/".$file_name);
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

// qqqとpppで囲まれた文字列を指定した文字列に置換して返します
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

// 文字列のhtml特殊文字をエスケープして返します
function escapeString($strings) {
	$escaped_str = array();
	foreach($strings as $key => $string) {
		$escaped_str[$key] = htmlspecialchars($string);
	}
	return $escaped_str;
}