<?php
  /*
   * This is a common include file that will bring in the most
   * commonly used classes and other files. Modules must include
   * this at the top of the page. Other modules, specific to that
   * module, can be included in addition to this one.
   */
require_once('settings.php');
require_once('classes/UserContext.php');
require_once('classes/DatabaseContext.php');
require_once('classes/Uri.php');
require_once('classes/Event.php');
require_once('classes/Profile.php');
require_once('classes/Tooltip.php');
require_once('classes/EmailMessage.php');
require_once('classes/TextMessage.php');
require_once('classes/Logger.php');
require_once('classes/RunSignup.php');

function clean_string($orig_string)
{
	// Replace the single quote with nothing
	$new_string = str_replace("'","", $orig_string);
	return(trim($new_string));
}
function remove_doubleq($orig_string)
{
	// Replace the single quote with nothing
	$new_string = str_replace("\"","", $orig_string);
	return(trim($new_string));
}
function remove_dollarsign($orig_string)
{
	// Replace the single quote with nothing
	$new_string = str_replace("$","", $orig_string);
	return(trim($new_string));
}
function remove_commas($orig_string)
{
	// Replace the single quote with nothing
	$new_string = str_replace(","," ", $orig_string);
	return(trim($new_string));
}

function is_ie()
{
	if (isset($_SERVER['HTTP_USER_AGENT']) &&
		(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') != false)) {
		return true;
	} else {
		return false;
	}
}

function makeUrl($uri, $op, $subop)
{
	$url = "?op=".$op."&mobile=".$uri->mobile."&subop=".$subop;
	return($url);
}

function createSysMessage($db, $status, $msg)
{
	$q = "insert into sysmessages(status, msg) values ('".$status."', '".$msg."')";
	$db->query($q);
	$msgid = $db->getLastInsertId();
	return($msgid);
}

?>
