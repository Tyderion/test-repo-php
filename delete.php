<?php
require_once('functions.php');
require_once('db_connect.php');
if (isset($_POST["entry_id"]))
{
	session_start();
	$entry = entry_for_id($_POST["entry_id"]);
	$user = logged_in_user();
	if ($user->role == 0 || $user->id == $entry->fk_user)
		{
			delete_post($entry->id);
		}
	header("Location: member.php");
}


?>