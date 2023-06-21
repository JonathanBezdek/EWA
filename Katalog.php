<?php 
/* Verbindung aufbauen, auswählen einer Datenbank */
$password = "em23en"; 

$link = new mysqli("localhost", "g08", $password , "g08") or die("Keine Verbindung möglich: " . $link->connect_error);

echo "<P>Verbindung zum Datenbankserver erfolgreich";

$query = "SELECT * FROM buecher";
$result =  $link->query($query) or die("Anfrage fehlgeschlagen: " . $link->error);

/* Ausgabe der Ergebnisse in HTML */
if ($result->num_rows > 0) {
    echo "<table>\n";
    while ($line = $result->fetch_assoc()) {  
        echo "\t<tr>\n";
        foreach ($line as $col_value) {    // Universal-Ausgabe für beliebige Tabelle !
             echo "\t\t<td>$col_value</td>\n";
        }     
        echo "\t</tr>\n";
    } 
    echo "</table>\n";
}

/* Freigeben des Resultsets */   
$link->close(); 

// Informationen zu den Autobahnen aus DB holen
$Query_String = "SELECT DISTINCT Produkttitel
FROM buecher
WHERE Produkttitel LIKE 'Java-Kochbuch'; ";

$Result_Menue = $link->query($Query_String);
// Ausgabe der Autobahninformationen
while(($Row = $Result_Menue->fetch_assoc())) {
    echo "<p><a href='index.php?Produkttitel=" . urlencode($Row['Produkttitel']) . "'>" . $Row["Produkttitel"] . "</a></p>";
}; 

?>
