<?php
// -------------------------------------------------------------------
// Projekt: PHPGuestbook
// Modul: functions.php
// Beschreibung: Enthält die allgemeinen Funktionen des Gästebuchs
// letzte Änderung: 21.05.13 / Gabriel Nadler
// -------------------------------------------------------------------
require_once('password.php');
function create_html5_header($title) {
  ?>
<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
      <?php echo $title ?>
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <header>
      <a href="member.php">Übersicht</a>
      <a href="edit.php">Angaben Editieren</a>
    </header>
  <?php
}


  function create_html5_footer() {
  $str="<footer>";
  if (isset($_SESSION["logged_in"]))
  {
    $user = logged_in_user();
    $str = $str . "<a href='logout.php' >User $user->username ausloggen. </a>";
  }
  

  $str = $str . "
  </footer>
  </body>
  </html>";
  echo $str;
}


function show_login_form()
{
?>
  <div id="login">
    <a href="register.php">Noch kein Mitglied?</a>
  <div> Bitte hier anmelden: </div>
  <form method='post' action="member.php">
  <label for="username">Username</label>
  <input type="text" name='username'>
  <label for="pasword">Password</label>
  <input type="password" name='password'>
  <input type="submit" value='Einloggen'>
  </form>
  </div>
<?php
}

function show_entry($entry)
{
  $user = user_for_id($entry->fk_user);
  $content = nl2br($entry->content);
echo <<< EOF
<div class="entry">
  <span class="label"> Titel: </span>
  <span class="content">  $entry->title </span>
  <span class="label"> User: </span>
  <span class="content">  $user->username  </span>
  <span class="label"> Inhalt: </span>
  <span class="content" >  $content  </span>
EOF;
if (logged_in_user()->role == 0 || $user->id == $_SESSION["logged_in"])
{
echo <<< EOF
  <form method="post" action="delete.php">
    <input type="hidden" name="entry_id" value="$entry->id" >
    <input type="submit" value="Löschen" onclick="return confirm('Eintrag wirklich löschen?')" >
  </form>
EOF;
}
echo <<< EOF
</div>
EOF;
}



function show_create_form()
{
?>
  <div class="forum"> 
  <span> Bitte hier einen neuen Eintrag erstellen: </span>
  <form method='post' action="create.php">
  <label for="title">Titel</label>
  <input type="text" name='title' required>
  <label for="content">Inhalt</label>
  <textarea required name="content"></textarea>
  <input type="submit" value='Erstellen'>
  </form>
  </div>
<?php
}

function show_edit_form($user)
{
    $values = array('username' => "", 'name' => "", 'firstname' => "", 'email' => "", 'password' => "", 'password_confirmation' => "");
  $error = "";
  if ($user != null)
  {
    foreach ($user as $key => $value) {
      if ($key !== 'password' && $key !== 'password_confirmation')
      {
        $values[$key] = "value='" . $value . "'";
      }
    }
  }
  $title = "User " . $user->username . " editieren.";
?>
  <div class="forum"> 
  <span> <?php echo $title ?> </span>
  <form method='post' action="edit.php">
  <label for="current_password">Bestehendes Passwort</label>
  <input type="password" name='current_password' required >
  <label for="firstname">Vorname</label>
  <input type="text" name='firstname' required  <?php echo "value=" . $user->firstname ?> >
  <label for="name">Nachname</label>
  <input type="text" name='name' required <?php echo "value=" .  $user->name ?> >
  <label for="email">E-Mail</label>
  <input type="email" name='email' required <?php echo "value=" .  $user->email ?> >
  <label for="password">Neues Passwort</label>
  <input type="password" name='password' >
  <label for="password_confirmation">Passwort Bestätigung</label>
  <input type="password" name='password_confirmation' >

  <input type="submit" value='Editieren'>
  </form>
  </div>
<?php
}



function show_register_form($previous_data)
{
  $values = array('username' => "", 'name' => "", 'firstname' => "", 'email' => "", 'password' => "", 'password_confirmation' => "");
  $error = "";
  if ($previous_data != null)
  {
    foreach ($previous_data as $key => $value) {
        $values[$key] = "value='" . $value . "'";
    }
  }
?>
  <div class="forum"> 
  <span> Neue User-Registration </span>
  <form method='post' action="register.php">
  <label for="username">Benutzername</label>
  <input type="text" name='username' required <?php echo $values["username"] ?>>
  <label for="firstname">Vorname</label>
  <input type="text" name='firstname' required  <?php echo $values["firstname"] ?> >
  <label for="name">Nachname</label>
  <input type="text" name='name' required <?php echo $values["name"] ?>>
  <label for="email">E-Mail</label>
  <input type="email" name='email' required <?php echo $values["email"] ?>>
  <label for="password">Passwort</label>
  <input type="password" name='password' required <?php echo $values["password"] ?>>
  <label for="password_confirmation">Passwort Bestätigung</label>
  <input type="password" name='password_confirmation' required <?php echo $values["password_confirmation"] ?>>

  <input type="submit" value='Erstellen'>
  </form>
  </div>
<?php
}


function logged_in_user()
{
  if (isset($_SESSION["logged_in"]))
    return user_for_id($_SESSION["logged_in"]);
  else
    return null;
}
?>
