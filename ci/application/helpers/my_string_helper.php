<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Removes special chars 
// doesn't remove hyphen(-) and underscore(_)

function clean($string) {

	return preg_replace('/[^A-Za-z 0-9_\/\-]/', '', $string); 
}

// removes white spaces & other special charaters

// function clean_filename($filename){
// 	return preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($filename));
// }

function non_printable_charaters($string)
{
	$result = utf8_encode($string);

	return $result;

}

function capitalise($string)
{
	return ucwords(strtolower($string));
}

function lowercasetext($string = '')
{
	return strtolower($string) ? strtolower($string): '';
}

function prevent_multi_submit($type = "post", $excl = "validator") {
	    $string = "";
	    foreach ($_POST as $key => $val) {
	        // this test is to exclude a single variable, f.e. a captcha value
	        if ($key != $excl) {
	            $string .= $val;
	        }
	    }
	    if (isset($_SESSION['last'])) {
	        if ($_SESSION['last'] === md5($string)) {
	            return false;
	        } else {
	            $_SESSION['last'] = md5($string);
	            return true;
	        }
	    } else {
	        $_SESSION['last'] = md5($string);
	        return true;
	    }
	}