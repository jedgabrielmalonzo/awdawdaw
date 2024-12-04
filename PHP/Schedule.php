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
    <title>Schedule</title>
    <link rel="icon" type="image/x-icon" href="../images/lakbayorig.png">
    <link rel="stylesheet" href="../CSS/Schedule.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/BasicNeeds.css">
</head>

<body>
    <!--- NavBar-->
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
                <a class="nav-link" href="#">Schedule</a>
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

    

    


    <!-----Carousel-------->

<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="station-box">Tugeuegarao City, Cagayan</div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="station-box">Santiago City, Isabela</div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="station-box">Laoag City, Ilocos Norte</div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="station-box">Vigan City, Ilocos</div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="station-box">Bontoc, Mountain Province</div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="station-box">Sagada, Mountain Province</div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="station-box">Baguio City, Benguet</div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="station-box">La Trinidad, Benguet</div>
        </div>
    </div>
</div>


    <!-- Cards Section -->


    <!----Content-->



    <!-- Footer -->
    <div class="container-footer my-5">
        <footer class="text-center text-lg-start">
            <!-- Grid container -->
            <div class="container p-4 pb-0">
                <!-- Section: Links -->
                <section>
                    <!-- Grid row -->
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">LAKBAY TRANSPORT INC.</h6>
                            <p>
                                Here you can use rows and columns to organize your footer
                                content. Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit.
                            </p>
                        </div>
                        <!-- Grid column -->

                        <hr class="w-100 clearfix d-md-none" />

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>
                            <p><a class="text-dark" href="LakbayHomepage.html">Home</a></p>
                            <p><a class="text-dark" href="About Us Page.html">About Us</a></p>
                            <p><a class="text-dark" href="Destination.html">Destination</a></p>
                            <p><a class="text-dark" href="Schedule.html">Schedule</a></p>
                            <p><a class="text-dark" href="">Contact Us</a></p>
                        </div>

                        <!-- Grid column -->
                        <hr class="w-100 clearfix d-md-none" />

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                            <p><i class=""></i> Manila M, PH</p>
                            <p><i class=""></i> lakbaytransport@gmail.com</p>
                            <p><i class=""></i> +639664034113</p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </section>
                <!-- Section: Links -->

                <hr class="my-3">

                <!-- Section: Copyright -->
                <section class="p-3 pt-0">
                    <div class="row d-flex align-items-center copyright-row">
                        <!-- Grid column -->
                        <div class="col-md-7 col-lg-8 text-center text-md-start">
                            <div class="p-3">
                                © 2024 Copyright:
                                <a class="text-dark" href="">LAKBAY TRANSPORT INC.</a>
                            </div>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
                            <a class="btn btn-outline-dark btn-floating m-1" role="button"
                                href="https://www.facebook.com/SoyaBeanCurdz"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-dark btn-floating m-1" role="button" href="#"><i
                                    class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-dark btn-floating m-1" role="button" href="#"><i
                                    class="fab fa-youtube"></i></a>
                        </div>
                        <!-- Grid column -->
                    </div>
                </section>
                <!-- Section: Copyright -->
            </div>
            <!-- Grid container -->
        </footer>
        <!-- Footer -->
    </div>
    <!-- End of .container -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>