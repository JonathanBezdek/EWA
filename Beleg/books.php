<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $Anreisedatum = $_POST['Anreisedatum'];
    $Abreisedatum = $_POST['Abreisedatum'];
    $zimmerID = $_POST['zimmerID'];
    $preis = $_POST['preis'];
}


$books = [
    [
        'name' => 'PHP For Beginners',
        'description' => 'Learn PHP from the ground up.',
        'images' => [getenv('BASE_URL') . 'images/php.jpg'],
        'amount' => $preis,
        'currency' => 'eur',
        'quantity' => 1,
    ],
    [
        'name' => 'JavaScript For Beginners',
        'description' => 'Learn PHP from the ground up.',
        'images' => [getenv('BASE_URL') . 'images/js.jpg'],
        'amount' => 3999,
        'currency' => 'eur',
        'quantity' => 1,
    ]
]; 
?>
