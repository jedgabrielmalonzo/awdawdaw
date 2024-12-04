<?php
session_start(); // Start the session

// Database connection
$conn = new mysqli('localhost', 'root', '', 'lakbay'); // Modify with your credentials

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize bookings array in session if not already set
if (!isset($_SESSION['bookings'])) {
    $_SESSION['bookings'] = [];
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $price = $_POST['price'];

    // Prepare SQL statement to insert the new booking into the 'places' table
    $stmt = $conn->prepare("INSERT INTO places (origin, destination, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $origin, $destination, $price); // "ssi" indicates string, string, integer types

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Add the new booking to the session
        $_SESSION['bookings'][] = [
            'origin' => $origin,
            'destination' => $destination,
            'price' => $price
        ];

        // Redirect back to the booking management page
        header("Location: booking_management.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Booking</title>
    <link rel="stylesheet" href="path/to/your/css/style.css"> <!-- Adjust as necessary -->
</head>
<body>
    <div class="container">
        <h2>Add New Booking</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="origin">Origin</label>
                <input type="text" class="form-control" id="origin" name="origin" required>
            </div>
            <div class="form-group">
                <label for="destination">Destination</label>
                <input type="text" class="form-control" id="destination" name="destination" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <button type="submit" class="btn">Add Booking</button>
        </form>
    </div>
</body>
</html>