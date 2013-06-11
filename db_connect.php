<?php
// -------------------------------------------------------------------
// Projekt: PHPGuestbook
// Modul: db_connect.php
// Beschreibung: Erstellt eine Verbindung zur Datenbank
// letzte Änderung: 07.05.13 / Gabriel Nadler
// -------------------------------------------------------------------
$database_name = 'guestbook';
$database_user = 'guestbook';
$database_password = 'MPKMfJRTtmd6STaK';
$mysqli = NULL;


function create_test_user($name = 'asdf') {
  $mysqli = get_connection();
  $pass = hash_password($name);
  $half = (int) ( (strlen($name) / 2) ); // cast to int incase name length is odd
  $left = substr($name, 0, $half);
  $right = substr($name, $half);
  $admin = ($name == 'admin') ? 0 : 1;
  $query = "INSERT into User (username, firstname, name, password, role, email) VALUES ('$name', '$left', '$right', '$pass', $admin, '$left.$right@test.ch')";
  echo $query;
  if ($mysqli->query($query) == TRUE) {
    "Sample User $name successfully created\n";
  }
  $users = $mysqli->query("SELECT * FROM User");
  while ($database_user = $users->fetch_object()) {
    print_r($database_user);
  }
}

function create_tables($drop = false) {
  global $database_name;
  $mysqli = get_connection();


  if ($mysqli) {
    if ($drop) {
      echo "Dropping Tables<br>";
      $mysqli->query("DROP TABLE User");
      $mysqli->query("DROP TABLE Entry");
    
    /* Create table doesn't return a resultset */
    $create = "CREATE TABLE IF NOT EXISTS User (
        id int not null auto_increment,
        username varchar(40) not null unique, 
        firstname varchar(40), name varchar(40), 
        password char(60) not null, 
        role int not null, 
        email varchar(60) not null,
        primary key (id))";
    $mysqli->query($create);
    $create = "CREATE TABLE IF NOT EXISTS Entry(
      id int not null auto_increment, 
      title varchar(40), 
      content text, 
      fk_user int not null, 
      primary key (id))";
    $mysqli->query($create);
  }
  } else {
    echo "DATABASE CONNECTION COULD NOT BE ESTABLISHED!";
  }
}

function user_for_id($id)
{
  $query = "SELECT * FROM User where user.id = $id";
  $resultset = get_connection()->query($query);
  return $resultset->fetch_object();

}
function entry_for_id($id)
{
  $query = "SELECT * FROM Entry where entry.id = $id";
  $resultset = get_connection()->query($query);
  return $resultset->fetch_object();

}

function delete_post($id)
{
  $db = get_connection();
  $db->query("DELETE FROM Entry WHERE id=$id");
}

function get_connection() {
  global $mysqli, $database_user, $database_password, $database_name;
  if (!$mysqli) {
    $mysqli = new mysqli("localhost", $database_user, $database_password, $database_name);
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
      $mysqli = NULL;
    }
  }
  return $mysqli;
}

?>
