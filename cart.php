<?php
ob_start();
include('include/connect.php');
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-commerce Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #fafafa;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .logo {
            width: 60px;
            height: auto;
            border-radius: 50%;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #333;
            font-weight: 600;
        }
    


        .navbar-light .navbar-nav .nav-link:hover,
        .navbar-light .navbar-nav .nav-link.active {
            color: #0d6efd;
        }
        .card-title {
            font-weight: bold;
            font-size: 1.1rem;
        }

        .card-text {
            height: 70px;
            overflow: hidden;
            color: #555;
            font-size: 0.9rem;
        }

        .sidebar-title {
            background-color: #17a2b8;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .nav-link:hover {
            background-color: #138496;
        }

        .footer {
            background-color: #17a2b8;
            padding: 15px;
            color: white;
            font-size: 14px;
            margin-top: 30px;
        }

        .cart_image {
    height: 60px;
    width: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #ccc;
}

    </style>
</head>
<center>

    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid">
                <img src="./images/logo.jpg" alt="Logo" class="logo me-3">
                <a class="navbar-brand" href="#">E-Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="./users_area/user_registration.php">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php
                                                                                                                                            if (isset($_GET['add_to_cart'])) {
                                                                                                                                                $get_ip = getUserIP();

                                                                                                                                                $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip'";
                                                                                                                                                $result_query = mysqli_query($con, $select_query);
                                                                                                                                                $cart_items = mysqli_num_rows($result_query);
                                                                                                                                            } else {
                                                                                                                                                $get_ip = getUserIP();

                                                                                                                                                $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip'";
                                                                                                                                                $result_query = mysqli_query($con, $select_query);
                                                                                                                                                $cart_items = mysqli_num_rows($result_query);
                                                                                                                                            }
                                                                                                                                            echo $cart_items;

                                                                                                                                            ?></sup></a></li>

                    </ul>
                </div>
        </nav>

         <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">


            <div class="container">
                 <ul class="navbar-nav me-auto">
                     <?php
                if(!isset($_SESSION['user_username'])){
                    echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome Guest</a></li>"; 
                }
                else{
                echo "<li class='nav-item'><a class='nav-link' href='./users_area/profile.php'>Welcome ".$_SESSION['user_username']."</a></li>";
                }
                ?>
                
                     <?php
                if(!isset($_SESSION['user_username'])){
                    echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_login.php'>Login</a></li>"; 
                }
                else{
                    echo "<li class='nav-item'><a class='nav-link text-danger' href='./users_area/logout.php'>Logout</a></li>";
                }
                if(!isset($_SESSION['user_username'])){
                    $get_ip_address = getUserIP();
$empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
mysqli_query($con, $empty_cart);

                }
                ?>
                </ul>
            </div>
        </nav>

        <div class="bg-light py-4 mb-4 text-center">
            <h1 class="display-5 text-center">Your Shopping Cart</h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">

                        <?php
                        function getUserIP()
                        {
                            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                return $_SERVER['HTTP_CLIENT_IP'];
                            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

                                return $_SERVER['HTTP_X_FORWARDED_FOR'];
                            } else {

                                return $_SERVER['REMOTE_ADDR'];
                            }
                        }
                        ?>

                        <?php
                        $get_ip = getUserIP();
                        $total = 0;
                        $cart_query = "SELECT * FROM `cart_details` WHERE  ip_address='$get_ip'";
                        $result = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($result);
                        if ($result_count > 0) {
                            echo "<div class='container'>
                            <div class='row'>
                                <form action='' method='POST'>
                                    <table class='table table-bordered text-center'>
                                        <thead class='table-info'>
                                            <tr>
                                                <th>Product Title</th>
                                                <th>Product Image</th>
                                                <th>Quantity</th>
                                                <th>Total Price</th>
                                                <th>Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                $product_id = $row['product_id'];
                                $select_products = "SELECT * FROM `products` WHERE product_id=$product_id";
                                $result_products = mysqli_query($con, $select_products);
                                while ($row_product_price = mysqli_fetch_array($result_products)) {
                                    $product_price = array($row_product_price['product_price']);
                                    $price_table = $row_product_price['product_price'];
                                    $product_title = $row_product_price['product_title'];
                                    $product_image1 = $row_product_price['product_image1'];
                                    $quantity = $row['quantity'];
                                    $subtotal = $price_table * $quantity;
                                    $total += $subtotal;



                        ?>


                                    <?php
                                    if (isset($_POST['update_cart'])) {
                                        $get_ip = getUserIP();
                                        foreach ($_POST['qty'] as $product_id => $quantity) {
                                            $product_id = intval($product_id);
                                            $quantity = intval($quantity);
                                            if ($quantity < 1) continue;

                                            $update_cart = "UPDATE cart_details SET quantity=$quantity WHERE ip_address='$get_ip' AND product_id=$product_id";
                                            mysqli_query($con, $update_cart);
                                        }
                                        header("Location: cart.php");
                                        exit();
                                    } ?>
                                    <?php

                                    if (isset($_POST['remove_cart'])) {
                                        $get_ip = getUserIP();
                                        foreach ($_POST['remove'] as $remove) {
                                            $remove = intval($remove);
                                            $product_id = intval($product_id);
                                            $delete_query = "DELETE FROM cart_details WHERE product_id=$remove AND ip_address='$get_ip'";
                                            $result_delete = mysqli_query($con, $delete_query);
                                        }
                                        header("Location: cart.php");
                                        exit();
                                    }

                                    ?>
                                    <tr>
                                        <td><?= $product_title ?></td>
                                        <td><img src="./admin_area/product_images/<?= $product_image1 ?>" alt="" class="cart_image">
</td>
                                        <td>
                                            <input type="number" name="qty[<?= $product_id ?>]" class="form-input w-50" value="<?= $row['quantity'] ?>">
                                        </td>
                                        <td><?= $subtotal ?>/-</td>
                                        <td><input type="checkbox" name="remove[]" value="<?= $product_id ?>"></td>
                                    </tr>

                        <?php }
                            }
                        }
                        ?>
                        </table>
                        <?php
                        $get_ip = getUserIP();
                        $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip'";
                        $result = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($result);

                        if ($result_count > 0) {
                            echo "
    <div class='d-flex flex-column justify-content-center align-items-center mb-4'>
        <h4 class='text-info fw-bold fs-3'>Subtotal: {$total} /-</h4>
        <div class='mt-3'>
            <input type='submit' name='update_cart' value='Update Cart' class='btn btn-info btn-lg me-2'>
            <input type='submit' name='remove_cart' value='Remove Selected' class='btn btn-danger btn-lg me-2'>
            <a href='./users_area/checkout.php' class='btn btn-success btn-lg me-2'>Checkout</a>
            <a href='index.php' class='btn btn-secondary btn-lg'>Continue Shopping</a>
        </div>
    </div>
    ";
                        } else { 
                           echo "<div class='text-center my-5'>
    <i class='fa-solid fa-cart-shopping fa-4x text-muted mb-3'></i>
    <h5 class='text-danger fs-3'>Your cart is empty</h5>
    <a href='index.php' class='btn btn-primary btn-lg mt-3'>Start Shopping</a>
</div>
";
                        }
                        ?>



                    </div>

                </div>
            </div>

            </form>
        </div>
</center>
<?php ob_end_flush(); ?>
<div class="footer text-center">
    &copy; <?php echo date("Y"); ?> All Rights Reserved | E-Commerce Store
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>