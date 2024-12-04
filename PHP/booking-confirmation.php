<?php
// Start session to retrieve user info
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You need to log in to make a booking.");
}

// Include the database connection
$mysqli = require __DIR__ . "/database.php";

// Retrieve booking details based on user_id
$sql = "SELECT * FROM bookings WHERE user_id = ?";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("SQL error: " . $mysqli->error);
}

// Bind and execute the query
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

// Check if booking exists for the logged-in user
$booking = $result->fetch_assoc();
if (!$booking) {
    die("No booking found for this user.");
}

// Close the statement
$stmt->close();

// Display booking confirmation and order summary
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../CSS/php.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .receipt {
            border: 2px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin: 0 auto;
            background-color: #f9f9f9;
        }

        .receipt h4 {
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .receipt .section {
            margin-bottom: 20px;
        }

        .receipt .section p {
            font-size: 16px;
            margin: 0;
        }

        .receipt .section .label {
            font-weight: bold;
            color: #333;
        }

        .receipt .total {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            color: #28a745;
        }

        .receipt .line {
            border-top: 1px solid #ccc;
            margin: 10px 0;
        }

        .receipt .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }

        .payment-input {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="#">
            <img src="../images/Lakbay.png" alt="Logo" style="height: 95px; width: auto;">
        </a>
        <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-navigation">
            <ul class="navbar-nav mr-auto ml-4">
                <li class="nav-item">
                    <a class="nav-link" href="../PHP/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../PHP/AboutUs.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../PHP/Destinations.php">Destinations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../PHP/BookNow.php">Book Now</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../PHP/Schedule.php">Schedule</a>
                </li>
            </ul>

           <!-- User Greeting Section -->
        <div class="ml-auto d-flex align-items-center poppins-light mr-4">
            <?php if (isset($user)): ?>
                <span class="navbar-text text-white mr-3">
                    Hello, <?= htmlspecialchars($user["name"]) ?>
                </span>
                <a href="logout.php">
            <button class="Btn">
        <div class="sign">
            <svg viewBox="0 0 512 512">
              <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
              </svg>
        </div>
        <div class="text">Logout</div>
            </button>
            </a>
            <?php else: ?>
                <a href="../PHP/login.php" class="btn btn-outline-light btn-sm mr-2">Login</a>
                <a href="../HTML/signup.html" class="btn btn-outline-light btn-sm">Sign Up</a>
            <?php endif; ?>
        </div>
    </div>
    </nav>

    <div class="receipt">
        <h4>Booking Confirmation</h4>
        <div class="section">
            <p><span class="label">Customer Name:</span> <?= htmlspecialchars($booking['customer_name']) ?></p>
            <div class="line"></div>
            <p><span class="label">Destination:</span></p>
            <p><span class="label">From:</span> <?= htmlspecialchars($booking['from_location']) ?></p>
            <p><span class="label">To:</span> <?= htmlspecialchars($booking['to_location']) ?></p>
            <p><span class="label">Departure:</span> <?= htmlspecialchars($booking['schedule']) ?></p>
            <div class="line"></div>
            <p><span class="label">Seats Selected:</span> <?= htmlspecialchars($booking['seat_numbers']) ?></p>
            <div class="line"></div>
            <p class="total">Total Price: ₱<?= number_format($booking['total_price'], 2) ?></p>
        </div>

        <div class="payment-input">
            <form action="process-payment.php" method="POST">
                <div class="form-group">
                    <label for="paymentAmount">Enter Amount to Pay (₱):</label>
                    <input type="number" class="form-control" id="paymentAmount" name="paymentAmount" required>
                </div>
                <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                <button type="submit" class="btn btn-success">Submit Payment</button>
            </form>
        </div>

        <div class="footer">
            <p>Thank you for booking with Lakbay!</p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
