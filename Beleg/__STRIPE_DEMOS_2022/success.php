<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Bookstore</h1>

Vielen Dank für Ihren Einkauf! <br>

<?php
echo "<br>Bitte notieren Sie sich die Stripe-SessionID für Rückfragen:" .  $_GET['session_id'] ; 

?>
<hr>
<a href="https://iws107.informatik.htw-dresden.de/ewa/demos/__STRIPE_DEMOS_2022/index.html">Zurück zum Shop</a>

</html>