Datenbank: guestbook
- Tabelle: User (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,username VARCHAR(40) NOT NULL, firstname VARCHAR(40), name VARCHAR(40), password CHAR(60) NOT NULL)
- Tabelle: Entry(id INT, title VARCHAR(40), content TEXT, fk_user INT)

Programmdateien:
- login.php [Zeigt Login-Form an]
- member.php [Eingeloggter Status]
- logout.php [Zerstört die Session]
- db_connect.php [Verbindet mit der Datenbank, erstellt ein mysqli-Objekt names db]
- password.php [Verschlüsselung und Testen der Passwörter]
- functions.php [Allgemeine Funktionen]
