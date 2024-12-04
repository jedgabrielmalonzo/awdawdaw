<?php 
include('includes/header.php');
include('includes/navbar.php');
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                         aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                       placeholder="Search for..." aria-label="Search"
                                       aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

            </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h2>Transaction History</h2>

            <!-- Search Form -->
            <div class="card mb-4">
                <div class="card-header">
                    Search Transactions
                </div>
                <div class="card-body">
                    <form action="transaction_history.php" method="GET">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="Search by Customer Name or ID">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>

            <!-- Transaction History Table -->
            <div class="card mb-4">
                <div class="card-header">
                    Transaction Records
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>From Location</th>
                                <th>To Location</th>
                                <th>Seat Number</th>
                                <th>Scheduled Time</th>
                                <th>Seat Count</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
    // Include your database connection
    $host = 'localhost';
    $dbname = 'lakbay';
    $username = 'root';
    $password = '';

    $conn = new mysqli($host, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch transactions from the database
    $sql = "SELECT id, customer_name, from_location, to_location, seat_numbers, `schedule`, total_price FROM bookings";
    $result = $conn->query($sql);

    if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
            // Calculate seat count based on seat_numbers
            $seat_count = isset($row['seat_numbers']) ? count(explode(',', $row['seat_numbers'])) : 0;
            echo "<tr>
                <td>{$row['id']}</td>
                <td>" . htmlspecialchars($row['customer_name']) . "</td>
                <td>" . htmlspecialchars($row['from_location']) . "</td>
                <td>" . htmlspecialchars($row['to_location']) . "</td>
                <td>" . htmlspecialchars($row['seat_numbers']) . "</td>
                <td>" . htmlspecialchars($row['schedule']) . "</td>
                <td>{$seat_count}</td>
                <td>₱" . number_format($row['total_price'], 2) . "</td>
            </tr>";
        endwhile;
    else:
        echo "<tr><td colspan='8' class='text-center'>No transactions found</td></tr>";
    endif;

    // Close the database connection
    $conn->close();
    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->
