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

    <div class="container-fluid">
        <!-- Header start here -->
        <header class="row bg-primary py-3">
            <div class="col text-center">
                <a href="index.php">
                    <img id="logo" src="images/logo.png" class="img-fluid" alt="Logo">
                </a>
            </div>
        </header>
        <!-- Header end here -->

        <!-- Navigation bar start here -->
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
        <!-- Navigation bar end here -->

        <!-- Content wrapper start here -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="list-group">
                    <h4 class="list-group-item list-group-item-action active">Categories</h4>
                    <?php getCats(); ?>
                </div>
                <div class="list-group mt-3">
                    <h4 class="list-group-item list-group-item-action active">Brands</h4>
                    <?php getBrands(); ?> 
                </div>
            </div>

            <main class="col-md-9">
                <?php cart(); ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <span class="float-right">
                            <?php
                            if(isset($_SESSION['customer_email'])){
                                echo "<b>Welcome: </b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'> Your</b>";
                            } else {
                                echo "<b>Welcome Guest!</b>";
                            }
                            ?>
                            <b style="color:yellow"> Shopping Cart -</b> Total Items: <?php total_items(); ?>  Total Price: <?php total_price(); ?> 
                            <a href="cart.php" class="btn btn-warning btn-sm">Go to Cart</a>
                            <?php
                            if(!isset($_SESSION['customer_email'])){
                                echo "<a href='checkout.php' class='btn btn-warning btn-sm'>Login</a>";
                            } else {
                                echo "<a href='logout.php' class='btn btn-warning btn-sm'>Logout</a>";
                            }
                            ?>
                        </span>
                    </div>
                </div>

                <div id="product_box">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title text-center text-success">Contact Us</h2>
                            <p class="card-text text-center text-primary">For contact:</p>
                            <p class="card-text text-center text-dark">Customer can contact us or send feedback by using our Facebook page or the email address below. We read feedback immediately and respond without delay.</p>
                            <p class="text-center"><a href="https://facebook.com/facebook_appliances" class="btn btn-primary">Go to Facebook Page</a></p>
                            <p class="text-center">Email: <a href="mailto:Dellarellano06@gmail.com">Dellarellano06@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </main>
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
