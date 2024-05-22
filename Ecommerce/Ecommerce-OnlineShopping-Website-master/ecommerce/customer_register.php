<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Home Appliances - Create Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css" media="all">
</head>

<body>
    <?php
    session_start();
    include("functions/functions.php");
    include("includes/db.php");
    ?>

    <div class="container-fluid">

        <!-- Header -->
        <header class="row bg-primary py-3">
            <div class="col text-center">
                <a href="index.php">
                    <img id="logo" src="images/logo.png" class="img-fluid" alt="Logo">
                </a>
            </div>
        </header>

        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Home Appliances</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="all_products.php">All Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="customer/my_account.php">My Account</a></li>
                    <li class="nav-item"><a class="nav-link" href="customer_register.php">Sign Up</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart.php">Shopping Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="contacts.php">Contact Us</a></li>
                </ul>
                <form class="form-inline ml-auto" method="get" action="results.php" enctype="multipart/form-data">
                    <input class="form-control mr-sm-2" type="search" name="user_query" placeholder="Search a Product" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>
                </form>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div class="row mt-4">
            <!-- Sidebar -->
            <aside class="col-md-3">
                <div class="list-group">
                    <h5 class="list-group-item list-group-item-action active">Categories</h5>
                    <?php getCats(); ?>
                </div>
                <div class="list-group mt-3">
                    <h5 class="list-group-item list-group-item-action active">Brands</h5>
                    <?php getBrands(); ?>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="col-md-9">
                <?php cart(); ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <span class="float-right">
                            <?php
                            if (isset($_SESSION['customer_email'])) {
                                echo "<b>Welcome:</b> " . $_SESSION['customer_email'] . "<b style='color:yellow;'> Your</b>";
                            } else {
                                echo "<b>Welcome Guest!</b>";
                            }
                            ?>
                            <b style="color:yellow">Shopping Cart -</b> Total Items: <?php total_items(); ?> Total Price: <?php total_price(); ?>
                            <a href="cart.php" class="btn btn-warning btn-sm">Go to Cart</a>
                            <?php
                            if (!isset($_SESSION['customer_email'])) {
                                echo "<a href='checkout.php' class='btn btn-warning btn-sm'>Login</a>";
                            } else {
                                echo "<a href='logout.php' class='btn btn-warning btn-sm'>Logout</a>";
                            }
                            ?>
                        </span>
                    </div>
                </div>

                <!-- Registration Form -->
                <form action="customer_register.php" method="post" enctype="multipart/form-data" class="form-horizontal">

                    <div class="card">
                        <div class="card-header text-center">
                            <h2 class="text-success">Create an Account</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="c_name" class="col-sm-4 col-form-label text-success">Customer Name:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="c_name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="c_email" class="col-sm-4 col-form-label text-success">Customer Email:</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="c_email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="c_pass" class="col-sm-4 col-form-label text-success">Customer Password:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="c_pass" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="c_image" class="col-sm-4 col-form-label text-success">Customer Image:</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" name="c_image" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="c_country" class="col-sm-4 col-form-label text-success">Customer Country:</label>
                                <div class="col-sm-8">
                                    <select name="c_country" class="form-control">
                                        <option>Select a Country</option>
                                        <option>Nepal</option>
                                        <option>Japan</option>
                                        <option>Canada</option>
                                        <option>Pakistan</option>
                                        <option>Israel</option>
                                        <option>India</option>
                                        <option>UAE</option>
                                        <option>US</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="c_city" class="col-sm-4 col-form-label text-success">Customer City:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="c_city" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="c_contact" class="col-sm-4 col-form-label text-success">Customer Contact:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="c_contact" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="c_address" class="col-sm-4 col-form-label text-success">Customer Address:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="c_address" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <input type="submit" name="register" value="Create Account" class="btn btn-success">
                        </div>
                    </div>
                </form>

            </main>
        </div>

        <!-- Footer -->
        <footer class="row bg-dark text-white mt-4 py-3">
            <div class="col text-center">
                <h6>&copy; 2024 Online Home Appliances</h6>
            </div>
        </footer>

    </div>

    <?php
    if (isset($_POST['register'])) {
        $ip = getIp();
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_pass = $_POST['c_pass'];
        $c_image = $_FILES['c_image']['name'];
        $c_image_tmp = $_FILES['c_image']['tmp_name'];
        $c_country = $_POST['c_country'];
        $c_city = $_POST['c_city'];
        $c_contact = $_POST['c_contact'];
        $c_address = $_POST['c_address'];

        move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");

        $insert_c = "INSERT INTO customers (customer_ip, customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_address, customer_image) VALUES ('$ip', '$c_name', '$c_email', '$c_pass', '$c_country', '$c_city', '$c_contact', '$c_address', '$c_image')";

        $run_c = mysqli_query($con, $insert_c);

        $sel_cart = "SELECT * FROM cart WHERE ip_add='$ip'";
        $run_cart = mysqli_query($con, $sel_cart);
        $check_cart = mysqli_num_rows($run_cart);

        
         
        if ($check_cart == 0){
            $_SESSION['customer_email'] = $c_email;
            echo "<script>alert('Account has been created successfully, Thanks!')</script>";
            echo "<script>window.open('customer/my_account.php','_self')</script>";
        } else {
            $_SESSION['customer_email'] = $c_email;
            echo "<script>alert('Account has been created successfully, Thanks!')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        }
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
