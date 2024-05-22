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
    <?php
    session_start();
    include("functions/functions.php");
    ?>

    <div class="container-fluid main_wrapper">
        <!-- Header -->
        <div class="row header_wrapper">
            <div class="col-12 text-center">
                <a href="index.php"><img id="logo" src="images/logo.png" alt="Logo"></a>
            </div>
        </div>

        <!-- Navigation Bar -->
        <div class="row menu_bar">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">Navbar</a>
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
                            <input class="form-control mr-sm-2" type="search" name="user_query" placeholder="Search a Product">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>
                        </form>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Content Wrapper -->
        <div class="row content_wrapper">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="list-group">
                    <div class="list-group-item active">Categories</div>
                    <?php getCats(); ?>
                </div>
                <div class="list-group mt-3">
                    <div class="list-group-item active">Brands</div>
                    <?php getBrands(); ?>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-md-9">
                <?php cart(); ?>
                <div id="shopping_cart" class="alert alert-info text-right">
                    <?php
                    if (isset($_SESSION['customer_email'])) {
                        echo "<b>Welcome:</b> " . $_SESSION['customer_email'] . " <b style='color:yellow;'>Your</b>";
                    } else {
                        echo "<b>Welcome Guest!</b>";
                    }
                    ?>
                    <b style="color:yellow;"> Shopping Cart -</b> Total Items: <?php total_items(); ?> Total Price: <?php total_price(); ?>
                    <a href="cart.php" style="color:yellow;">Go to Cart</a>
                    <?php
                    if (!isset($_SESSION['customer_email'])) {
                        echo "<a href='checkout.php' style='color:yellow;'>Login</a>";
                    } else {
                        echo "<a href='logout.php' style='color:yellow;'>Logout</a>";
                    }
                    ?>
                </div>

                <div id="product_box">
                    <?php
                    if (isset($_GET['pro_id'])) {
                        $product_id = $_GET['pro_id'];
                        $get_pro = "SELECT * FROM products WHERE product_id='$product_id'";
                        $run_pro = mysqli_query($con, $get_pro);
                        while ($row_pro = mysqli_fetch_array($run_pro)) {
                            $pro_id = $row_pro['product_id'];
                            $pro_desc = $row_pro['product_desc'];
                            $pro_title = $row_pro['product_title'];
                            $pro_price = $row_pro['product_price'];
                            $pro_image = $row_pro['product_image'];
                            echo "
                            <div class='card'>
                                <img class='card-img-top' src='admin_area/product_images/$pro_image' alt='Product Image'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$pro_title</h5>
                                    <p class='card-text'>$pro_desc</p>
                                    <p class='card-text'><b>Rs.$pro_price</b></p>
                                    <a href='index.php' class='btn btn-primary'>Go Back</a>
                                    <a href='index.php?add_cart=$pro_id' class='btn btn-success float-right'>Add to Cart</a>
                                </div>
                            </div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="row">
            <div class="col-12 text-center">
                <h2>&copy; 2024 Online Home Appliances</h2>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
