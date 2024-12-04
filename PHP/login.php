<?php

$is_invalid = false;


if ($_SERVER["REQUEST_METHOD"] === "POST"){

    $mysqli = require __DIR__ . "/database.php";

    $sql = sprintf("SELECT * FROM user
            WHERE email = '%s'",
           $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($user) {

        if (password_verify($_POST["password"], $user["password_hash"])){

            session_start();

            session_regenerate_id();

            $_SESSION["user_id"] = $user["id"];

            header("Location: index.php");
            exit;
        }
    }
    $is_invalid = true;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="../images/lakbayorig.png">
    <link rel="stylesheet" href="../CSS/signup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
</head>

<body>
    <!--- NavBar-->
    <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="../PHP/index.php">
            <img src="../images/Lakbay.png" alt="Logo" style="height: 95px; width: auto;">
        </a>
        
    </nav>
    
    <div class="container d-flex justify-content-center align-items-center" style="height: 75vh;">
    <div class="card shadow-sm" style="width: 450px;">
        <div class="card-body">
            <h3 class="text-center mb-4">Login</h3>

            <?php if ($is_invalid): ?>
                <em>Invalid Login</em>
            <?php endif; ?>    

            <form method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                    value="<?= htmlspecialchars($_POST["email"] ?? "") ?> ">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                </div>
                <button type="submit" class="btn btn-danger btn-block mt-4">Log In</button>
            </form>
            <div class="already-have-account text-center mt-3">
                Don't have an account? <a href="../HTML/signup.html">Sign Up Instead</a>
            </div>
        </div>
    </div>
</div>

   

    <!-- Footer -->
    <div class="container-footer my-5">
        <footer class="text-center text-lg-start" >
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
                            <p><a class="text-dark" href="#">Home</a></p>
                            <p><a class="text-dark" href="#">About Us</a></p>
                            <p><a class="text-dark" href="#">Destination</a></p>
                            <p><a class="text-dark" href="#">Schedule</a></p>
                            <p><a class="text-dark" href="#">Contact Us</a></p>
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
                            <a class="btn btn-outline-dark btn-floating m-1" role="button" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-dark btn-floating m-1" role="button" href="#"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-dark btn-floating m-1" role="button" href="#"><i class="fab fa-youtube"></i></a>
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