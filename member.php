<?php
// -------------------------------------------------------------------
// Projekt: PHPGuestbook
// Modul: member.php
// Beschreibung: Authentifiziert User und zeigt seine Einträge.
// letzte Änderung: 07.05.13 / Gabriel Nadler
// -------------------------------------------------------------------
require_once("check_session.php");
require_once('db_connect.php');
require_once('functions.php');
create_html5_header("Übersicht");
// create_database();
// print_r($_POST);
$content="";
$db = get_connection();
session_start();
show_create_form();

if (isset($_POST["username"]))
{
  $username = $_POST['username'];
  $lower_username = strtolower($username);
  $userpass = $_POST['password'];


  
  // print_r($db);
  if ($db) {
    $query = "SELECT * FROM user WHERE username = '$lower_username'";
    $result = $db->query($query);
    if ($result) {
      $user =$result->fetch_array();
    }
    $old = $user['password'];
    if (authenticate($userpass, $old)) {
      
      // echo "User $username authenticated successfully";

      $_SESSION['logged_in'] = $user['id'];
    } else {
      header("Location: login.php?fail=true");
      exit;
    } 
  }
}
?>
<div class="list">
<?php
if (isset($_SESSION["logged_in"]))
{
  $eintraege = $db->query("SELECT * FROM Entry");
  while ($eintrag = $eintraege->fetch_object()   )
  {
    show_entry($eintrag);
  }
  
}
?>
</div>
<?php

create_html5_footer();


?>
