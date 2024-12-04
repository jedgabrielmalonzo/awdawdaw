<?php

$is_invalid = false;

// Hard-coded credentials for admin
$admin_email = "lakbay@gmail.com";
$admin_password = "12345";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the submitted credentials match the hard-coded ones
    if ($_POST["email"] === $admin_email && $_POST["password"] === $admin_password) {
        session_start();
        session_regenerate_id();
        $_SESSION["user_id"] = 1; // You can set a user ID as needed
        header("Location: admin-panel.php"); // Redirect to admin-panel.php
        exit;
    } else {
        $is_invalid = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="admin.png">
    <link rel="stylesheet" href="../CSS/signup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
   
    
    <div class="container d-flex justify-content-center align-items-center" style="height: 75vh;">
        <div class="card shadow-sm" style="width: 450px;">
            <div class="card-body">
            <div class="text-center mb-4">
                    <img src="../admin/admin.png" alt="Admin Logo" style="width: 100px; height: auto;">
                </div>
                <h3 class="text-center mb-4">Admin Login</h3>

                <?php if ($is_invalid): ?>
                    <em>Invalid Login</em>
                <?php endif; ?>    

                <form method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                        value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-danger btn-block mt-4">Log In</button>
                </form>
            </div>
        </div>
    </div>
    
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