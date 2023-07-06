<?php
// Passwort festlegen
$password = "em23en";


// Verbindung herstellen
$db_link = mysqli_connect ("localhost", "g08", $password ,"g08"); // change to your group Number twice !

//$email = $_POST['email'];
// NEU
//$Buchungsnummer = $_POST[''];
$Zimmer_ID = $_POST['zimmerID'];
$Anreisedatum = $_POST['Anreisedatum'];
$Abreisedatum = $_POST['Abreisedatum'];
$Kundenemail = $_POST['email'];
$Preis = $_POST['preis'];


// if (!isset($_POST['preis'])) {
//     die("Error: email not provided");
// }

$db_link->query("SET NAMES 'utf8'"); 
$db_link->query("SET CHARACTER SET utf8");  
$db_link->query("SET SESSION collation_connection = 'utf8_unicode_ci'");


// Überprüfen, ob die Verbindung erfolgreich war
if ($db_link === false) {
    die("Fehler: Verbindung konnte nicht hergestellt werden. " . mysqli_connect_error());
}

// SQL-Befehl vorbereiten
//                                        $Zimmer_ID'                                           $Preis
$sql = "INSERT INTO buchungen VALUES('', '$Zimmer_ID', '$Anreisedatum', '$Abreisedatum', '$Kundenemail', '$Preis')";

// SQL-Befehl ausführen
if (mysqli_query($db_link, $sql)) {
    echo "Datensatz wurde erfolgreich eingefügt.";
} else {
    echo "Fehler: $sql. " . mysqli_error($db_link);
}

// Verbindung schließen
mysqli_close($db_link);


?>
