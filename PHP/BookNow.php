<?php

session_start();

if (isset($_SESSION["user_id"])){

    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now</title>
    <link rel="icon" type="image/x-icon" href="../images/lakbayorig.png">
    <link rel="stylesheet" href="../CSS/Booknow.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/seatdiagram.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Space+Grotesk:wght@300..700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/BasicNeeds.css">

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
                    Hello,
                    <?= htmlspecialchars($user["name"]) ?>
                </span>
                <a href="logout.php">
                    <button class="Btn">
                        <div class="sign">
                            <svg viewBox="0 0 512 512">
                                <path
                                    d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                                </path>
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
    <!-- About Banner Section -->
    <div class="banner">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <h1 class="banner-title">BOOK NOW</h1>
        </div>
    </div>

    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Make Bookings</h5>
                    <p>Select seats (Maximum of 3)</p>
                </div>
                <div class="card-body">
                    <!-- Seating Diagram Section -->
                    <div class="seats-section mb-4">
                        <table id="seatsDiagram" class="table table-bordered">
                            <tbody>
                                <!-- Row 1 -->
                                <tr>
                                    <td id="seat-J1" data-name="J1">J1</td>
                                    <td id="seat-I1" data-name="I1">I1</td>
                                    <td id="seat-H1" data-name="H1">H1</td>
                                    <td id="seat-G1" data-name="G1">G1</td>
                                    <td id="seat-F1" data-name="F1">F1</td>
                                    <td id="seat-E1" data-name="E1">E1</td>
                                    <td id="seat-D1" data-name="D1">D1</td>
                                    <td id="seat-C1" data-name="C1">C1</td>
                                    <td id="seat-B1" data-name="B1">B1</td>
                                    <td id="seat-A1" data-name="A1">A1</td>
                                </tr>
                                <!-- Row 2 -->
                                <tr>
                                    <td id="seat-J2" data-name="J2">J2</td>
                                    <td id="seat-I2" data-name="I2">I2</td>
                                    <td id="seat-H2" data-name="H2">H2</td>
                                    <td id="seat-G2" data-name="G2">G2</td>
                                    <td id="seat-F2" data-name="F2">F2</td>
                                    <td id="seat-E2" data-name="E2">E2</td>
                                    <td id="seat-D2" data-name="D2">D2</td>
                                    <td id="seat-C2" data-name="C2">C2</td>
                                    <td id="seat-B2" data-name="B2">B2</td>
                                    <td id="seat-A2" data-name="A2">A2</td>
                                </tr>
                                <!-- Hallway Row (empty cells between seats) -->
                                <tr class="hallway">
                                    <td colspan="10" class="hallway"></td>
                                </tr>
                                <!-- Row 3 -->
                                <tr>
                                    <td id="seat-J3" data-name="J3">J3</td>
                                    <td id="seat-I3" data-name="I3">I3</td>
                                    <td id="seat-H3" data-name="H3">H3</td>
                                    <td id="seat-G3" data-name="G3">G3</td>
                                    <td id="seat-F3" data-name="F3">F3</td>
                                    <td id="seat-E3" data-name="E3">E3</td>
                                    <td id="seat-D3" data-name="D3">D3</td>
                                    <td class="hallway"></td>
                                    <td id="seat-B3" data-name="B3">B3</td>
                                    <td id="seat-A3" data-name="A3">A3</td>
                                </tr>
                                <!-- Row 4 -->
                                <tr>
                                    <td id="seat-J4" data-name="J4">J4</td>
                                    <td id="seat-I4" data-name="I4">I4</td>
                                    <td id="seat-H4" data-name="H4">H4</td>
                                    <td id="seat-G4" data-name="G4">G4</td>
                                    <td id="seat-F4" data-name="F4">F4</td>
                                    <td id="seat-E4" data-name="E4">E4</td>
                                    <td id="seat-D4" data-name="D4">D4</td>
                                    <td class="hallway"></td>
                                    <td id="seat-B4" data-name="B4">B4</td>
                                    <td id="seat-A4" data-name="A4">A4</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Form Section -->
                    <div class="form-section">
                        <form id="seatBookingForm" action="booking-handler.php" method="POST">
                            <div class="mb-3">
                                <label for="cname" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="cname" name="cname">
                            </div>
                            <div class="mb-3">
                                <label for="fromLocation" class="form-label">From</label>
                                <input type="text" class="form-control" id="fromLocation" name="fromLocation" value="Antipolo" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="toLocation" class="form-label">To</label>
                                <select class="form-select" id="toLocation" name="toLocation" onchange="calculateTotalPrice()">
    <option value="" selected disabled>Select a Destination</option>
    <optgroup label="Available Destinations">
        <?php
        if (isset($_SESSION['bookings'])) {
            foreach ($_SESSION['bookings'] as $booking) {
                echo "<option value=\"{$booking['destination']}\" data-price=\"{$booking['price']}\">{$booking['destination']} - Price: {$booking['price']}</option>";
            }
        }
        ?>
    </optgroup>
</select>
                            </div>
                            <div class="mb-3">
                                <label for="seatInput" class="form-label">Seat Number</label>
                                <input type="text" class="form-control" id="seatInput" name="seatInput" readonly>
                            </div>
                            <div class="selected-seats-count mb-3">
                                <label for="selectedSeatCount">Seats Selected:</label>
                                <input type="text" id="selectedSeatCount" name="selectedSeatCount" value="0" readonly>
                            </div>
                            <!-- Total Price -->
                            <div class="mb-3">
                                <label for="totalPrice" class="form-label">Total Price</label>
                                <input type="text" class="form-control" id="totalPrice" name="totalPrice" readonly>

                            </div>
                            <div class="mb-3">
                                <label for="schedule" class="form-label">Select Schedule</label>
                                <select class="form-select" id="schedule" name="schedule">
                                    <option value="" selected disabled>Select a Schedule</option>
                                    <option value="08:00">08:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="12:00">12:00 PM</option>
                                    <option value="14:00">02:00 PM</option>
                                    <option value="16:00">04:00 PM</option>
                                    <option value="18:00">06:00 PM</option>
                                    <option value="20:00">08:00 PM</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Proceed to Order Summary</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  





    <!-- /END THE FEATURETTES -->
    </div>

    <div class="container-footer my-5">
        <footer class="text-center text-lg-start">
            <div class="container p-4 pb-0">
                <section>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">LAKBAY TRANSPORT INC.</h6>
                            <p>
                                Here you can use rows and columns to organize your footer
                                content. Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit.
                            </p>
                        </div>

                        <hr class="w-100 clearfix d-md-none" />

                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>
                            <p><a class="text-dark" href="LakbayHomepage.html">Home</a></p>
                            <p><a class="text-dark" href="About Us Page.html">About Us</a></p>
                            <p><a class="text-dark" href="Destination.html">Destination</a></p>
                            <p><a class="text-dark" href="Schedule.html">Schedule</a></p>
                            <p><a class="text-dark" href="">Contact Us</a></p>
                        </div>

                        <hr class="w-100 clearfix d-md-none" />

                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                            <p><i class=""></i> Manila M, PH</p>
                            <p><i class=""></i> lakbaytransport@gmail.com</p>
                            <p><i class=""></i> +639664034113</p>
                        </div>
                    </div>
                </section>

                <hr class="my-3">

                <section class="p-3 pt-0">
                    <div class="row d-flex align-items-center copyright-row">
                        <div class="col-md-7 col-lg-8 text-center text-md-start">
                            <div class="p-3">
                                © 2024 Copyright:
                                <a class="text-dark" href="">LAKBAY TRANSPORT INC.</a>
                            </div>
                        </div>
                        <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
                            <a class="btn btn-outline-dark btn-floating m-1" role="button"
                                href="https://www.facebook.com/SoyaBeanCurdz"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-dark btn-floating m-1" role="button" href="#"><i
                                    class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-dark btn-floating m-1" role="button" href="#"><i
                                    class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </section>
            </div>
        </footer>
    </div>

    
    <script>

    // Event listener for selecting seats
    document.querySelectorAll("#seatsDiagram td:not(.space):not(.reserved)").forEach(td => {
        td.addEventListener("click", function () {
            // Get the list of all selected seats
            const selectedSeats = Array.from(document.querySelectorAll("#seatsDiagram td.selected"))
                .map(seat => seat.dataset.name); // This gives an array of seat names

            // If there are less than 3 selected seats, allow the selection
            if (!this.classList.contains("selected") && selectedSeats.length < 3) {
                // Toggle the 'selected' class on the clicked seat
                this.classList.add("selected");
            }
            // If a seat is already selected, allow deselecting it
            else if (this.classList.contains("selected")) {
                this.classList.remove("selected");
            }

            // Update the input field with the selected seats
            const updatedSelectedSeats = Array.from(document.querySelectorAll("#seatsDiagram td.selected"))
                .map(seat => seat.dataset.name);

            document.getElementById("seatInput").value = updatedSelectedSeats.join(", ");

            // Update the seat selection count
            const seatCount = updatedSelectedSeats.length;
            document.getElementById("selectedSeatCount").value = seatCount;  // Update the read-only input field

            // Enable the Submit button if at least one seat is selected
            const submitButton = document.querySelector("button[type='submit']");
            submitButton.disabled = updatedSelectedSeats.length === 0; // Disable if no seat is selected

            // Disable further seat selection if 3 seats are selected
            if (updatedSelectedSeats.length >= 3) {
                document.querySelectorAll("#seatsDiagram td:not(.selected):not(.reserved)").forEach(seat => {
                    seat.style.pointerEvents = "none"; // Disable further selection
                });
            } else {
                document.querySelectorAll("#seatsDiagram td").forEach(seat => {
                    seat.style.pointerEvents = ""; // Enable selection for available seats
                });
            }

            // Calculate total price based on selected seats and destination
            calculatePrice();
        });
    });

    // Function to calculate and update the total price
    function calculatePrice() {
    const destinationSelect = document.getElementById("toLocation");
    const selectedOption = destinationSelect.options[destinationSelect.selectedIndex];
    const seatCount = parseInt(document.getElementById("selectedSeatCount").value); // Get the selected seat count

    // Get the price per seat for the selected destination
    const pricePerSeat = parseFloat(selectedOption.getAttribute("data-price")); // Use data-price attribute

    // If there's a valid price and at least one seat is selected
    if (isNaN(seatCount) || seatCount <= 0 || isNaN(pricePerSeat)) {
        document.getElementById("totalPrice").value = "0"; // Set total price to 0
        return;
    }

    // Calculate the total price
    const totalPrice = seatCount * pricePerSeat;

    // Update the total price field
    document.getElementById("totalPrice").value = totalPrice; // Set raw numeric value
}

// Update total price when the destination changes
document.getElementById("toLocation").addEventListener("change", calculatePrice);

</script>


    <script>
        document.getElementById('toggleLoginPassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const icon = this;
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9Y2E0AqMG6KF9e2D8XohhpltM9I6a+Q8zD7YM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>