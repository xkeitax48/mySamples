<?php
function displayFile($file_name, $replaces=null, $escape=false, $loop=array())
{
	$lines = file("../template/".$file_name);
	foreach($lines as $line_num => $line) {
		if(!isset($loop[$line_num+1])) {
			echo replaceString($line, $replaces, $escape);
		}
		else {
			foreach($loop[$line_num+1] as $loop_replaces) {
				echo replaceString($line, $loop_replaces, $escape);
			}
		}
	}
}

function replaceString($subject, $replaces=null, $escape=false)
{
	if($replaces == null) {
		return $subject;
	}
	if($escape != false) {
		$replaces = escapeString($replaces);
	}
	$pattern = array();
	$value = array();
	foreach($replaces as $string => $replace) {
		$pattern[] = "/{".$string."}/";
		$value[] = $replace;
	}
	return preg_replace($pattern, $value, $subject);
}

function escapeString($strings)
{
	$escaped_str = array();
	foreach($strings as $key => $string) {
		$escaped_str[$key] = htmlspecialchars($string);
	}
	return $escaped_str;
}