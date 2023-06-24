<?php
// Passwort festlegen
$password = "em23en";




// Verbindung herstellen
$db_link = mysqli_connect ("localhost", "g08", $password ,"g08"); // change to your group Number twice !

if (!isset($_POST['email'])) {
    die("Error: email not provided");
}

$email = $_POST['email'];





$db_link->query("SET NAMES 'utf8'"); 
$db_link->query("SET CHARACTER SET utf8");  
$db_link->query("SET SESSION collation_connection = 'utf8_unicode_ci'");


// Überprüfen, ob die Verbindung erfolgreich war
if ($db_link === false) {
    die("Fehler: Verbindung konnte nicht hergestellt werden. " . mysqli_connect_error());
}

// SQL-Befehl vorbereiten
$sql = "INSERT INTO zimmer VALUES('4', 'Test', '$email')";

// SQL-Befehl ausführen
if (mysqli_query($db_link, $sql)) {
    echo "Datensatz wurde erfolgreich eingefügt.";
} else {
    echo "Fehler: $sql. " . mysqli_error($db_link);
}

// Verbindung schließen
mysqli_close($db_link);
?>
