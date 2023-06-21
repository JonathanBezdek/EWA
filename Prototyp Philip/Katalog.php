<?php /* Verbindung aufbauen, auswählen einer Datenbank */
$link = new mysqli("localhost", "root", "em23en", "g008")
or die("Keine Verbindung möglich: " . mysql_error());
echo "<P>Verbindung zum Datenbankserver erfolgreich";
$query = "SELECT * FROM test";
$result = $link-> query ($query) or die("Anfrage fehlgeschlagen: " .
mysql_error());
/* Ausgabe der Ergebnisse in HTML */
if ($result->num_rows > 0) {
echo "<table>\n";
while ($line = $result->fetch_assoc())
{ echo "\t<tr>\n";
foreach ($line as $col_value) { // Universal-Ausgabe für beliebige Tabelle !
echo "\t\t<td>$col_value</td>\n";
} echo "\t</tr>\n";
} echo "</table>\n";
}
/* Freigeben des Resultsets */ $link-close();