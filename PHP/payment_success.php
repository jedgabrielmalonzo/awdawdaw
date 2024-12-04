<?php
// Retrieve payment and total price
$payment = isset($_POST['payment']) ? floatval($_POST['payment']) : 0;
$totalPrice = isset($_POST['totalPrice']) ? floatval($_POST['totalPrice']) : 0;

$change = $payment - $totalPrice;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5 text-center">
        <h1 class="text-success">Payment Successful!</h1>
        <p>Thank you for your payment.</p>
        <h3 class="mt-3">Change: ₱<?= number_format($change, 2) ?></h3>
        <a href="index.php" class="btn btn-primary mt-4">Return to Home</a>
    </div>
</body>

</html>