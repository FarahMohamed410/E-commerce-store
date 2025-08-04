<?php
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
    <style>
        body {
            background-color: #f8f9fa;
        }

        .logo {
            width: 60px;
            height: auto;
            border-radius: 50%;
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
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <img src="./images/logo.jpg" alt="Logo" class="logo me-3">
            <a class="navbar-brand text-white" href="#">E-Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active text-white" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="display_all.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="./users_area/user_registration.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Contact</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fa-solid fa-cart-shopping"></i><sup>1</sup></a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Total Price: 100/-</a></li>
                </ul>
                 <form action="search_product.php" method="GET">
                    <input type="text" name="search_data" placeholder="Search products...">
                    <input type="submit" value="Search" name="search_data_product" class="btn btn-outline-light">
                </form>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <ul class="navbar-nav me-auto">
              
                    <?php
                if(!isset($_SESSION['user_username'])){
                    echo "<li class='nav-item'><a class='nav-link' href='./user_login.php'>Login</a></li>"; 
                }
                else{
                echo "<li class='nav-item'><a class='nav-link' href='logout.php'>Logout</a></li>";
                }
                ?>
            </ul>
        </div>
    </nav>

    <div class="bg-light py-4 mb-4 text-center">
        <h1 class="display-5">Welcome to Our Store</h1>
        <p class="lead">Discover the best products at the best prices</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <?php
                    if (!isset($_GET['category'])) {
                        if (!isset($_GET['brand'])) {
                            $select_query = "SELECT * FROM `products`";
                            $result_query = mysqli_query($con, $select_query);
                            while ($row = mysqli_fetch_assoc($result_query)) {
                                $product_id = $row['product_id'];
                                $product_title = $row['product_title'];
                                $product_description = $row['product_description'];
                                $product_image1 = $row['product_image1'];
                                $product_price = $row['product_price'];

                                echo "
              <div class='col-md-4 mb-4'>
                <div class='card h-100 shadow-sm'>
                  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                  <div class='card-body d-flex flex-column'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <div class='mt-auto d-flex justify-content-between'>
                      <a href='index.php?add_to_cart=$product_id' class='btn btn-sm btn-info'>Add to cart</a>
                      <a href='product_details.php?product_id=$product_id' class='btn btn-sm btn-secondary'>View more</a>
                    </div>
                  </div>
                </div>
              </div>";
                            }
                        }
                    }
                    ?>
                    <?php
                    if (isset($_GET['category'])) {
                        $category_id = $_GET['category'];
                        $select_query = "SELECT * FROM `products` where category_id =$category_id";
                        $result_query = mysqli_query($con, $select_query);
                        $number_rows = mysqli_num_rows($result_query);
                        if ($number_rows == 0) {
                            echo "<h2 class ='text-center text-danger'>no stock for this category</h2>";
                        }
                        while ($row = mysqli_fetch_assoc($result_query)) {
                            $product_id = $row['product_id'];
                            $product_title = $row['product_title'];
                            $product_description = $row['product_description'];
                            $product_image1 = $row['product_image1'];
                            $product_price = $row['product_price'];

                            echo "
              <div class='col-md-4 mb-4'>
                <div class='card h-100 shadow-sm'>
                  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                  <div class='card-body d-flex flex-column'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <div class='mt-auto d-flex justify-content-between'>
                      <a href='#' class='btn btn-sm btn-info'>Add to cart</a>
                      <a href='#' class='btn btn-sm btn-secondary'>View more</a>
                    </div>
                  </div>
                </div>
              </div>";
                        }
                    }

                    ?>
                    <?php
                    if (isset($_GET['brand'])) {
                        $brand_id = $_GET['brand'];
                        $select_query = "SELECT * FROM `products` where brand_id =$brand_id";
                        $result_query = mysqli_query($con, $select_query);
                        $number_rows = mysqli_num_rows($result_query);
                        if ($number_rows == 0) {
                            echo "<h2 class ='text-center text-danger'>this brand is not available for service</h2>";
                        }
                        while ($row = mysqli_fetch_assoc($result_query)) {
                            $product_id = $row['product_id'];
                            $product_title = $row['product_title'];
                            $product_description = $row['product_description'];
                            $product_image1 = $row['product_image1'];
                            $product_price = $row['product_price'];

                            echo "
              <div class='col-md-4 mb-4'>
                <div class='card h-100 shadow-sm'>
                  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                  <div class='card-body d-flex flex-column'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <div class='mt-auto d-flex justify-content-between'>
                      <a href='#' class='btn btn-sm btn-info'>Add to cart</a>
                      <a href='#' class='btn btn-sm btn-secondary'>View more</a>
                    </div>
                  </div>
                </div>
              </div>";
                        }
                    }

                    ?>
                </div>
            </div>

            <div class="col-md-2 bg-secondary text-white px-3 py-2">
                <div class="sidebar-title">Delivery Brands</div>
                <ul class="navbar-nav text-start">
                    <?php
                    $select_brands = "SELECT * FROM brands";
                    $result_brands = mysqli_query($con, $select_brands);
                    while ($row_data = mysqli_fetch_assoc($result_brands)) {
                        $brand_title = $row_data['brand_title'];
                        $brand_id = $row_data['brand_id'];
                        echo "<li class='nav-item'><a href='index.php?brand=$brand_id' class='nav-link text-white'>$brand_title</a></li>";
                    }
                    ?>
                </ul>

                <div class="sidebar-title mt-4">Categories</div>
                <ul class="navbar-nav text-start">
                    <?php
                    $select_cat = "SELECT * FROM categories";
                    $result_cat = mysqli_query($con, $select_cat);
                    while ($row_data = mysqli_fetch_assoc($result_cat)) {
                        $category_title = $row_data['category_title'];
                        $category_id = $row_data['category_id'];
                        echo "<li class='nav-item'><a href='index.php?category=$category_id' class='nav-link text-white'>$category_title</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>


    <div class="footer text-center">
        &copy; <?php echo date("Y"); ?> All Rights Reserved | E-Commerce Store
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>