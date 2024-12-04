<?php
session_start(); // Start the session

// Initialize bookings array in session if not already set
if (!isset($_SESSION['bookings'])) {
    $_SESSION['bookings'] = [];
}

// Include header and navbar
include('includes/header.php');
include('includes/navbar.php');

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h2 class="mb-4">Booking Management</h2>
            
            <!-- Add Booking Form -->
            <div class="card mb-4">
                <div class="card-header">Add New Booking</div>
                <div class="card-body">
                    <form action="add_booking.php" method="POST">
                        <div class="form-group">
                            <label for="origin">Origin</label>
                            <input type="text" class="form-control" id="origin" name="origin" value="Antipolo" readonly>
                        </div>
                        <div class="form-group">
                            <label for="destination">Destination</label>
                            <input type="text" class="form-control" id="destination" name="destination" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Booking</button>
                    </form>
                </div>
            </div>

            <!-- Manage Bookings Table -->
            <div class="card mb-4">
                <div class="card-header">Manage Bookings</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>Price</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($_SESSION['bookings'])) {
                                foreach ($_SESSION['bookings'] as $id => $booking) {
                                    echo "<tr>
                                        <td>{$id}</td>
                                        <td>{$booking['origin']}</td>
                                        <td>{$booking['destination']}</td>
                                        <td>{$booking['price']}</td>
                                        <td><a href='edit_booking.php?id={$id}' class='btn btn-warning'>Edit</a></td>
                                        <td><a href='delete_booking.php?id={$id}' class='btn btn-danger'>Delete</a></td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No bookings found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->
</div>

<?php include('includes/footer.php'); ?>