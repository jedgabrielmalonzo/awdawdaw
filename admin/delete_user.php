<?php
$mysqli = require "../PHP/database.php"; // Adjust path if necessary

$id = $_GET["id"];

// Use a prepared statement for secure deletion
$stmt = $mysqli->prepare("DELETE FROM user WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script type='text/javascript'>
            alert('User deleted successfully');
            window.location.href='index.php'; // Redirect to the main page
          </script>";
} else {
    echo "Error deleting record: " . $mysqli->error;
}
?>
