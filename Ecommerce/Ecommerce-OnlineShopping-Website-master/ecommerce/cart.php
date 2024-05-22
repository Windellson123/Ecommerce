<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Home Appliances</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <style>
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <?php session_start(); include("functions/functions.php"); ?>

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
            <main class="col-md-12">
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
                            <a href="index.php" class="btn btn-warning btn-sm">Back to Shop</a>
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
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr align="center">
                                    <th>Remove</th>
                                    <th>Product(s)</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                global $con;
                                $total = 0;
                                $ip = getIp();
                                $sel_price = "select * from cart where ip_add='$ip'";
                                $run_price = mysqli_query($con, $sel_price);

                                while($p_price = mysqli_fetch_array($run_price)){
                                    $pro_id = $p_price['p_id'];
                                    $pro_price = "select * from products where product_id='$pro_id'";
                                    $run_pro_price = mysqli_query($con, $pro_price);

                                    while($pp_price = mysqli_fetch_array($run_pro_price)){
                                        $product_price = array($pp_price['product_price']);
                                        $product_title = $pp_price['product_title'];
                                        $product_image = $pp_price['product_image'];
                                        $single_price = $pp_price['product_price'];
                                        $values = array_sum($product_price);
                                        $total += $values;
                                ?>
                                <tr align="center">
                                    <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>" /></td>
                                    <td>
                                        <?php echo $product_title; ?><br>
                                        <img src="admin_area/product_images/<?php echo $product_image; ?>" class="product-img" alt="<?php echo $product_title; ?>">
                                    </td>
                                    <td><input type="number" name="qty[<?php echo $pro_id; ?>]" value="1" min="1" class="form-control" style="width: 70px;" /></td>
                                    <td><?php echo "Pesos. " . $single_price; ?></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                            <tfoot>
                                <tr align="right">
                                    <td colspan="3"><b>Sub Total:</b></td>
                                    <td><?php echo "Pesos. " . $total; ?></td>
                                </tr>
                                <tr align="center">
                                    <td colspan="2"><input type="submit" name="update_cart" value="Update Cart" class="btn btn-primary" /></td>
                                    <td><input type="submit" name="continue" value="Continue Shopping" class="btn btn-success" /></td>
                                    <td><a href="checkout.php" class="btn btn-info">Checkout</a></td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>

                    <?php
                    global $con;
                    $ip = getIp();

                    if(isset($_POST['update_cart'])){
                        foreach($_POST['remove'] as $remove_id){
                            $delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
                            $run_delete = mysqli_query($con, $delete_product);
                            if($run_delete){
                                echo "<script>window.open('cart.php', '_self')</script>";
                            }
                        }

                        if(isset($_POST['qty'])){
                            foreach($_POST['qty'] as $id => $qty){
                                $update_qty = "update cart set qty='$qty' where p_id='$id' AND ip_add='$ip'";
                                $run_qty = mysqli_query($con, $update_qty);
                                if($run_qty){
                                    echo "<script>window.open('cart.php', '_self')</script>";
                                }
                            }
                        }
                    }

                    if(isset($_POST['continue'])){
                        echo "<script>window.open('index.php', '_self')</script>";
                    }
                    ?>
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
