<?php
include("includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .container {
            margin-top: 100px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .card-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            background-color: #28a745;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 24px;
        }
        .card-body {
            padding: 30px;
        }
        .form-control {
            border-radius: 20px;
        }
        .btn-login {
            background-color: #28a745;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            width: 100%;
        }
        .btn-login:hover {
            background-color: #218838;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
        .register-link a {
            color: #578ebe;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Login or Register to Buy!
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="pass" class="form-control" placeholder="Enter password" required>
                            </div>
                            <div class="form-group">
                                <a href="checkout.php?forgot_pass">Forgot Password?</a>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="login" value="Login" class="btn btn-login">
                            </div>
                        </form>
                        <div class="register-link">
                            <p>New? <a href="customer_register.php">Register Here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if(isset($_POST['login'])){
        $c_email= $_POST['email'];
        $c_pass= $_POST['pass'];

        $sel_c= "SELECT * FROM customers WHERE customer_pass='$c_pass' AND customer_email='$c_email'";
        $run_c= mysqli_query($con,$sel_c);
        $check_customer= mysqli_num_rows($run_c);

        if($check_customer==0){
            echo "<script>alert('Password or Email is incorrect, please try again!')</script>";
            exit();
        }

        $ip=getIp();
        $sel_cart= "SELECT * FROM cart WHERE ip_add='$ip'";
        $run_cart=mysqli_query($con,$sel_cart);
        $check_cart=mysqli_num_rows($run_cart);

        if($check_customer>0 AND $check_cart==0){
            $_SESSION['customer_email']=$c_email;
            echo "<script>alert('You are logged in successfully, Thanks!')</script>";
            echo "<script>window.open('customer/my_account.php','_self')</script>";
        } else {
            $_SESSION['customer_email']=$c_email;
            echo "<script>alert('You are logged in successfully, Thanks!')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        }
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
