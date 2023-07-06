<?php
// Setze deinen geheimen Schlüssel: Ändere dies unbedingt in deinen Live-Geheimschlüssel in der Produktionsumgebung
// Deine Schlüssel findest du hier: https://dashboard.stripe.com/account/apikeys

require 'stripe-php-master/init.php' ;

//include 'Insert.php';
//$selectedBook = $books[0];
$test = [ 
    [
        'price_data' => [
            'currency' => 'eur',
            'unit_amount' => 23423,
            'product_data' => [
                'name' => 'Test-Buch',
            ],
        ],
        'quantity' => 1,
    ],
];

$currency = 'eur';

$public_key_for_js = "1"; // Definition einer Variable für den öffentlichen Schlüssel - Verwendung weiter unten in JavaScript

$live = 0;  // Zahle an G00 - Demo-Account -> bitte auf deinen eigenen Stripe-Account umbauen!!

// #################################################################
// Definition der Stripe-Account-Keys

if ($live == 1) {
    // Geheimer Schlüssel des Großhändlers - bitte so belassen!!!
    \Stripe\Stripe::setApiKey('sk_test_51NQsaDFWeRIdxQTiwXHgUh8IGCeaEjiSzflk5egoTy7dhgK29Mu6Jr3tQbsZtInr4odvaa9DJJ6d6zYBm6YXYYrr00Kpvl6gAB');

    $public_key_for_js = 'pk_test_51NQsaDFWeRIdxQTiskN6er8OmQv9SGu1lylopRmG7fjd4CVlsGt4G5yIYM16KvUlL1PPiYsS9bKT9u5ItKtxWeba004rE9Ofdl'; // Öffentlicher Schlüssel des Großhändlers - so belassen!!!
} else {
    // Dein eigener Stripe-Account-Schlüssel - bitte hier einsetzen -> der nachfolgende Code ist nicht mehr gültig!!!
    \Stripe\Stripe::setApiKey('sk_test_51NQsaDFWeRIdxQTiwXHgUh8IGCeaEjiSzflk5egoTy7dhgK29Mu6Jr3tQbsZtInr4odvaa9DJJ6d6zYBm6YXYYrr00Kpvl6gAB');

    $public_key_for_js = 'pk_test_51NQsaDFWeRIdxQTiskN6er8OmQv9SGu1lylopRmG7fjd4CVlsGt4G5yIYM16KvUlL1PPiYsS9bKT9u5ItKtxWeba004rE9Ofdl';  // Öffentlicher Schlüssel des G00
}
// #################################################################

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $test,
        'mode' => 'payment',
        'success_url' => 'https://ivm108.informatik.htw-dresden.de/ewa/g08/Beleg/success.php?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'https://ivm108.informatik.htw-dresden.de/ewa/g08/Beleg/cancel.php?session_id={CHECKOUT_SESSION_ID}',
    ]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo "Error in Session::create()" . $e;
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

<h1>Hotelreservierung</h1>

Sie werden zum Stripe-Checkout weitergeleitet....
<?php // echo "mit PK=" . $public_key_for_js
?>
<script>
    var stripe = Stripe('<?php echo $public_key_for_js ?>'); // Nichts ändern ! Public key oben definiert !!!
	// Hier stand vorher der public key des Test-Accounts G00
    stripe.redirectToCheckout({
        sessionId: '<?php echo $session['id']; ?>'
    }).then(function (result) {
    });
</script>

</body>
</html>