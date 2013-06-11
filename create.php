<?php
// -------------------------------------------------------------------
// Projekt: PHPGuestbook
// Modul: create.php
// Beschreibung: Erstellt einen Eintrag falls ein User eingeloggt ist.
// letzte Änderung: 14.05.13 / Gabriel Nadler
// -------------------------------------------------------------------
require_once("functions.php");
require_once("db_connect.php");
session_start();
if ( $_SESSION['logged_in'] != "")
{
	if (isset($_POST["content"]))
	{
	  $db = get_connection();
	  $content = $db->real_escape_string($_POST["content"]);
	  
	  

	  $title = $db->real_escape_string($_POST["title"]);
	  $user = $_SESSION['logged_in'];

	  $query = "INSERT INTO Entry (title, content, fk_user) VALUES ('$title', '$content', '$user')";
	  
	  $result = $db->query($query);

	  header("Location: member.php");
	}
}



?>
