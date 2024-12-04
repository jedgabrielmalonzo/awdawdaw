<?php
// Start session to retrieve user info
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You need to log in to make a booking.");
}

// Include the database connection
$mysqli = require __DIR__ . "/database.php";

// Validate and sanitize POST data
$customerName = $_POST['cname'] ?? '';
$fromLocation = $_POST['fromLocation'] ?? '';
$toLocation = $_POST['toLocation'] ?? '';
$seatNumbers = $_POST['seatInput'] ?? '';
$totalPrice = $_POST['totalPrice'] ?? 0;
$schedule = $_POST['schedule'] ?? '';

// Check required fields
if (empty($customerName) || empty($fromLocation) || empty($toLocation) || empty($seatNumbers) || empty($totalPrice) || empty($schedule)) {
    die("Please fill in all required fields.");
}

// Prepare SQL query to insert booking into database
$sql = "INSERT INTO bookings (user_id, customer_name, from_location, to_location, seat_numbers, total_price, schedule, booking_date)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("SQL error: " . $mysqli->error);
}

// Bind parameters and execute the query
$stmt->bind_param("issssds", 
    $_SESSION['user_id'], 
    $customerName, 
    $fromLocation, 
    $toLocation, 
    $seatNumbers, 
    $totalPrice, 
    $schedule
);

if ($stmt->execute()) {
    echo "Booking successfully saved!";
    header("Location: booking-confirmation.php"); // Redirect to a confirmation page
    exit;
} else {
    die("Error saving booking: " . $stmt->error);
}

?>