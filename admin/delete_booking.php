<?php
session_start(); // Start the session

$mysqli = require "../PHP/database.php"; // Adjust path if necessary

// Check if the booking ID is provided
if (isset($_GET["id"])) {
    $id = intval($_GET["id"]); // Ensure ID is treated as an integer

    // Use a prepared statement for secure deletion
    $stmt = $mysqli->prepare("DELETE FROM places WHERE id = ?"); // Adjust 'places' to your table name
    $stmt->bind_param("i", $id);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Remove the booking from the session if it exists
        if (isset($_SESSION['bookings'][$id])) {
            unset($_SESSION['bookings'][$id]);
            $_SESSION['bookings'] = array_values($_SESSION['bookings']); // Reindex the bookings array
        }

        // Alert and redirect
        echo "<script type='text/javascript'>
                alert('Booking deleted successfully');
                window.location.href='booking_management.php'; // Redirect to the booking management page
              </script>";
    } else {
        echo "Error deleting record: " . $stmt->error; // Display error if deletion fails
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No booking ID specified.";
}

// Close the database connection
$mysqli->close();
?>