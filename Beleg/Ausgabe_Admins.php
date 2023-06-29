<?php

$password="em23en";  // please set you own password and delete the next line !
//require("accountdata.php"); // this sets my password ==> please set your $password in the line before !!! 
// echo "pw=" . $password; 

$db_link = mysqli_connect ("localhost", "g08", $password ,"g08"); // change to your group Number twice !

// ##########################################################################
// Important: Please request UTF8 based communication, otherwise the JSON export will not work!
// see PHP-Doku: https://www.php.net/manual/de/function.json-encode.php
$db_link->query("SET NAMES 'utf8'"); 
$db_link->query("SET CHARACTER SET utf8");  
$db_link->query("SET SESSION collation_connection = 'utf8_unicode_ci'");
// ##########################################################################
 
$sql = "SELECT * FROM admin";
 
$db_erg = mysqli_query( $db_link, $sql );
if ( ! $db_erg )
{
  die('Invalid request: ' . mysqli_error());
}
$dbdaten = array();   // new array for JSON-export  
 
$showtable = false; // only for tests 
 
if ($showtable)  echo '<table border="1">';

while ($zeile =  $db_erg->fetch_array( MYSQLI_ASSOC ))
{
 
if ($showtable)
{echo "<tr>";
  echo "<td>". $zeile['Admin_Adressen'] . "</td>";
  echo "</tr>";
  } 
  
  $dbdaten[] = $zeile; // read DB-Data row by row and build up a new array 
}
if ($showtable) echo "</table>";

// export books as JSON 
$dbdaten_as_json = json_encode($dbdaten);
echo $dbdaten_as_json;
// print_r ( $db_erg);  // for tests 

// Optional : save the file on the server (for tests) 
//$datei = fopen("format_test.txt","w"); 
//$written =  fwrite($datei, $dbdaten_as_json);
//fclose($datei); 
 
mysqli_free_result( $db_erg );
?>