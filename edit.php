<?php
// -------------------------------------------------------------------
// Projekt: PHPGuestbook
// Modul: edit.php
// Beschreibung: Editiert Benutzerangaben
// letzte Änderung: 04.06.13 / Gabriel Nadler
// -------------------------------------------------------------------
require_once('functions.php');
require_once('db_connect.php');
require_once('password.php');
session_start();
$db = get_connection();
$user = logged_in_user();
create_html5_header("User Editieren");
$error = "";
if (isset($_POST["current_password"]))
{
	$old_password = $db->real_escape_string($_POST["current_password"]);
	$email = $db->real_escape_string($_POST["email"]);
	$name = $db->real_escape_string($_POST["name"]);
	$firstname = $db->real_escape_string($_POST["firstname"]);
	$password = $db->real_escape_string($_POST["password"]);
	$password_confirmation = $db->real_escape_string($_POST["password_confirmation"]);
	if (authenticate($old_password, $user->password))
	{
		$query = "UPDATE USER SET name='$name',email='$email',firstname='$firstname'";
		if ($password !== "" )
		{
			if ($password === $password_confirmation)
			{
				$hashed_pw = hash_password($password);
				$query .= ",password='$hashed_pw'";
			}		
			else
				$error = $error . "<div class='notification'> Neue Passwörter stimmen nicht überein </div>";	
		}

		$query .= " WHERE id=" . $_SESSION['logged_in'];
		echo $query;
		$db->query($query);
	} else 
	{
		$error = $error .  "<div class='notification'> Altes Passwort stimmt nicht </div>";
	}
}
echo $error;
$user = logged_in_user();
show_edit_form($user);
create_html5_footer();