<?php
// -------------------------------------------------------------------
// Projekt: PHPGuestbook
// Modul: password.php
// Beschreibung: Verschlüsselt und bestätigt Passwörter
// letzte Änderung: 07.05.13 / Gabriel Nadler
// -------------------------------------------------------------------

function generateBlowfishSalt() {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ./';
    $numChars = strlen($chars);
    $salt = '';

    for($i = 0; $i < 22; ++$i) {
        $salt .= $chars[mt_rand(0, $numChars - 1)];
    }

    return $salt;
}

function hash_password($pw) {
  $salt = generateBlowfishSalt();
  $hash = crypt($pw , '$2a$12$' . $saltj);
  return $hash;
}

function authenticate($new, $old) {
  $hash = crypt($new, $old);
  return $old == $hash;
}

