<?php
// -------------------------------------------------------------------
// Projekt: PHPGuestbook
// Modul: logout.php
// Beschreibung: Zerstört die aktuelle Session
// letzte Änderung: 14.05.13 / Gabriel Nadler
// -------------------------------------------------------------------


$_SESSION['logged_in'] = "";
session_destroy();
header("Location: login.php");

?>
