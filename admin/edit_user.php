<?php
$mysqli = require "../PHP/database.php"; // Adjust path if necessary

$id = $_GET["id"];
$name = "";
$email = "";

// Retrieve user data by ID
$res = $mysqli->query("SELECT * FROM user WHERE id=$id");

if ($res && $res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $name = $row["name"];
    $email = $row["email"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="col-lg-4">
            <h2>Edit User</h2>
            <form action="" name="form1" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</body>

<?php
if (isset($_POST["update"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];

    $stmt = $mysqli->prepare("UPDATE user SET name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>
                alert('User updated successfully');
                window.location.href='user_maintenance.php'; // Modify the redirect as needed
              </script>";
    } else {
        echo "Error updating record: " . $mysqli->error;
    }
}
?>
</html>
