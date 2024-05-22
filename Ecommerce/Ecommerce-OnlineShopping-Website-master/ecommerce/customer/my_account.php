<?php
session_start();
include("functions/functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Home Appliances</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <!-- Main container start here -->
    <div class="container-fluid">

        <!-- Header start here -->
        <header class="row bg-primary py-3">
            <div class="col text-center">
                <a href="../index.php">
                    <img id="logo" src="images/logo.png" class="img-fluid" alt="Logo">
                </a>
            </div>
        </header>
        <!-- Header end here -->

        <!-- Navigation bar start here -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="../index.php">Home Appliances</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../all_products.php">All Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="my_account.php">My Account</a></li>
                    <li class="nav-item"><a class="nav-link" href="../customer_register.php">Sign Up</a></li>
                    <li class="nav-item"><a class="nav-link" href="../cart.php">Shopping Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contacts.php">Contact Us</a></li>
                </ul>
                <form class="form-inline ml-auto" method="get" action="results.php" enctype="multipart/form-data">
                    <input class="form-control mr-sm-2" type="search" name="user_query" placeholder="Search a Product" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>
                </form>
            </div>
        </nav>
        <!-- Navigation bar end here -->

        <!-- Content wrapper start here -->
        <div class="row mt-4">
            <!-- Sidebar start here -->
            <aside class="col-md-3">
                <div class="list-group">
                    <h5 class="list-group-item list-group-item-action active">My Account</h5>
                    <?php
                    if (isset($_SESSION['customer_email'])) {
                        $user = $_SESSION['customer_email'];
                        $get_img = "SELECT * FROM customers WHERE customer_email='$user'";
                        $run_img = mysqli_query($con, $get_img);
                        $row_img = mysqli_fetch_array($run_img);
                        $c_image = $row_img['customer_image'];
                        $c_name = $row_img['customer_name'];
                        echo "<div class='text-center my-3'><img src='customer_images/$c_image' class='img-thumbnail' width='130' height='130' /></div>";
                    }
                    ?>
                    <a href="my_account.php?my_orders" class="list-group-item list-group-item-action">My Orders</a>
                    <a href="my_account.php?edit_account" class="list-group-item list-group-item-action">Edit Account</a>
                    <a href="my_account.php?change_pass" class="list-group-item list-group-item-action">Change Password</a>
                    <a href="my_account.php?delete_account" class="list-group-item list-group-item-action">Delete Account</a>
                    <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
                </div>
            </aside>
            <!-- Sidebar end here -->

            <!-- Main content area start here -->
            <main class="col-md-9">
                <?php cart(); ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <span class="float-right">
                            <?php
                            if (isset($_SESSION['customer_email'])) {
                                echo "<b>Welcome: </b>" . $_SESSION['customer_email'];
                            }
                            ?>
                            <?php
                            if (!isset($_SESSION['customer_email'])) {
                                echo "<a href='../checkout.php' class='btn btn-warning btn-sm'>Login</a>";
                            } else {
                                echo "<a href='../logout.php' class='btn btn-warning btn-sm'>Logout</a>";
                            }
                            ?>
                        </span>
                    </div>
                </div>

                <div id="product_box" class="container">
                    <?php
                    if (!isset($_GET['my_orders']) && !isset($_GET['edit_account']) && !isset($_GET['change_pass']) && !isset($_GET['delete_account'])) {
                        if (isset($c_name)) {
                            echo "<h2 class='text-center text-orange'>Welcome: $c_name</h2>";
                        }
                        echo "<p class='text-center'><b>You can see your orders progress by clicking this <a href='my_account.php?my_orders'>link</a></b></p>";
                    }

                    if (isset($_GET['edit_account'])) {
                        include("edit_account.php");
                    }

                    if (isset($_GET['change_pass'])) {
                        include("change_pass.php");
                    }

                    if (isset($_GET['delete_account'])) {
                        include("delete_account.php");
                    }
                    ?>
                </div>
            </main>
            <!-- Main content area end here -->
        </div>
        <!-- Content wrapper end here -->

        <!-- Footer start here -->
        <footer class="row bg-dark text-white mt-4 py-3">
            <div class="col text-center">
                <h6>&copy; 2024 Online Home Appliances</h6>
            </div>
        </footer>
        <!-- Footer end here -->
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
