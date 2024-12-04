<?php
session_start(); // Start the session

// Check if the booking ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the booking exists in the session
    if (isset($_SESSION['bookings'][$id])) {
        // Retrieve the booking details
        $booking = $_SESSION['bookings'][$id];
    } else {
        echo "Booking not found.";
        exit;
    }
} else {
    echo "No booking ID specified.";
    exit;
}

// Process the form submission if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated values
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $price = $_POST['price'];

    // Update the booking in the session
    $_SESSION['bookings'][$id] = [
        'origin' => $origin,
        'destination' => $destination,
        'price' => $price
    ];

    // Redirect back to the booking management page
    header("Location: booking_management.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #343a40;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #495057;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Booking</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="origin">Origin</label>
                <input type="text" class="form-control" id="origin" name="origin" value="<?php echo htmlspecialchars($booking['origin']); ?>" required>
            </div>
            <div class="form-group">
                <label for="destination">Destination</label>
                <input type="text" class="form-control" id="destination" name="destination" value="<?php echo htmlspecialchars($booking['destination']); ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($booking['price']); ?>" required>
            </div>
            <button type="submit" class="btn">Update Booking</button>
        </form>
    </div>
</body>
</html>