<?php
// -------------------------------------------------------------------
// Projekt: PHPGuestbook
// Modul: login.php
// Beschreibung: Zeigt das Login-Form an und schickt es an das File member.php
// letzte Änderung: 07.05.13 / Gabriel Nadler
// -------------------------------------------------------------------
require_once('functions.php');
require_once('db_connect.php');
// create_tables(true);
// create_test_user("test");
// create_test_user("asdf");
// create_test_user("admin");
if (isset($_SESSION["logged_in"]))
{
	header("Location: member.php");
}

create_html5_header("Login");
if (isset($_GET["fail"]))
{
	echo "<div class='notification'> Username und/oder Passwort falsch. </div>";
}
if (isset($_GET["created"]))
{
	$username = $_GET['created'];
	echo "<div class='notification'> User $username erstellt. </div>";
}
show_login_form();
$db = get_connection();
// $result = $db->query("SELECT * from User");
create_html5_footer();
$db->close();
?>
