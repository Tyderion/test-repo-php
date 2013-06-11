<?php
// -------------------------------------------------------------------
// Projekt: PHPGuestbook
// Modul: register.php
// Beschreibung: Registriert neue User
// letzte Änderung: 04.06.13 / Gabriel Nadler
// -------------------------------------------------------------------
require_once('functions.php');
require_once('db_connect.php');
require_once('password.php');

create_html5_header("Login");
$db = get_connection();
$fail = false;
$error = "";
// Check for existing Username
if (isset($_POST['username']))
{
	$username = strtolower($db->real_escape_string($_POST["username"]));
	$resultset = $db->query("SELECT id from User where username = '$username'");
	if ($resultset->num_rows > 0)
	{
    	$error = $error .   "<div class='notification'> Username bereits vergeben </div>";
    	$fail = true;
	}
}
// Check for existing Email
if (isset($_POST['email']))
{
	$email = $_POST['email'];
	$resultset = $db->query("SELECT id from User where email = '$email'");
	if ($resultset->num_rows > 0)
	{
    	$error = $error .  "<div class='notification'> Email bereits vergeben </div>";
    	$fail = true;
		
	}
}
if (isset($_POST["name"]))
{
	// If Password is the same
	if ($_POST["password"] == $_POST["password_confirmation"])
	{
		if (!$fail)
		{
			// If we did not fail before, we create the user
			$username = strtolower($db->real_escape_string($_POST["username"]));
			$name = $db->real_escape_string($_POST["name"]);
			$firstname = $db->real_escape_string($_POST["firstname"]);
			$email = $db->real_escape_string($_POST["email"]);
			$password = hash_password($db->real_escape_string($_POST["password"]));
			$query = "INSERT into User (firstname, name, username, email, password) VALUES ('$firstname', '$name', '$username', '$email', '$password')";
			$db->query($query);
			header("Location: login.php?created=$name ");
		}
	} 
	else 
	{

    	$error = $error .   "<div class='notification'> Passwörter stimmen nicht überein </div>";
    	$fail = true;
	}
	if ($fail) 
	{
		echo $error;
		show_register_form($_POST);
	}
} else 
{
	show_register_form(null);
}

create_html5_footer();

?>
