<?php
include('include/connect.php');
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>E-commerce Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
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


        form.d-flex input[type="text"] {
            border-radius: 4px 0 0 4px;
            border: 1px solid #ced4da;
            padding: 6px 12px;
            width: 220px;
        }

        form.d-flex input[type="submit"] {
            border-radius: 0 4px 4px 0;
            border: 1px solid #0d6efd;
            background-color: #0d6efd;
            color: white;
            padding: 6px 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form.d-flex input[type="submit"]:hover {
            background-color: #084298;
        }


        .card {
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        }

        .card-img-top {
            height: 280px !important;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-title {
            font-weight: 700;
            font-size: 1.25rem;
        }

        .card-text {
            color: #555;
            font-size: 1rem;
            height: 80px;
            overflow: hidden;
        }

        .price {
            font-weight: 700;
            color: #0d6efd;
            margin-top: 10px;
            font-size: 1.25rem;
        }


        .sidebar-title {
            background-color: #0d6efd;
            color: white;
            padding: 12px;
            font-weight: 700;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
        }

        .sidebar .nav-link {
            color: #0a58ca;
            padding-left: 12px;
            font-weight: 600;
            transition: background-color 0.2s ease, color 0.2s ease;
            border-radius: 4px;
        }

        .sidebar .nav-link:hover {
            background-color: #0a58ca;
            color: #fff !important;
        }

        .footer {
            background-color: #0d6efd;
            color: white;
            padding: 15px 0;
            text-align: center;
            margin-top: 40px;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="./images/logo.jpg" alt="Logo" class="logo me-2" />
                <span>E-Store</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>

                    <?php
                    if (isset($_SESSION['user_username'])) {
                        echo "<li class='nav-item'><a class='nav-link' href='./users_area/profile.php'>My Account</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_registration.php'>Register</a></li>";
                    }
                    ?>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="cart.php">
                            <i class="fa-solid fa-cart-shopping"></i>
                            Cart
                            <span class="badge bg-primary rounded-pill position-absolute top-0 start-100 translate-middle">
                                <?php
                                $get_ip = getUserIP();
                                $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip'";
                                $result_query = mysqli_query($con, $select_query);
                                $cart_items = mysqli_num_rows($result_query);
                                echo $cart_items;
                                ?>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item nav-link disabled">
                        Total:
                        <?php
                        $total = 0;
                        $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip'";
                        $result = mysqli_query($con, $cart_query);
                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $select_products = "SELECT * FROM `products` WHERE product_id=$product_id";
                            $result_products = mysqli_query($con, $select_products);
                            while ($row_product_price = mysqli_fetch_array($result_products)) {
                                $total += $row_product_price['product_price'];
                            }
                        }
                        echo number_format($total, 2) . " EGP";
                        ?>
                    </li>
                </ul>

                <form action="search_product.php" method="GET" class="d-flex" role="search" novalidate>
                    <input class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search" name="search_data" required />
                    <button class="btn btn-primary" type="submit" name="search_data_product">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <ul class="navbar-nav me-auto">
                <?php
                if (!isset($_SESSION['user_username'])) {
                    echo "<li class='nav-item'><a class='nav-link text-muted' href='#'>Welcome Guest</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_login.php'>Login</a></li>";
                } else {
                    echo "<li class='nav-item'><a class='nav-link text-primary' href='./users_area/profile.php'>Welcome " . htmlspecialchars($_SESSION['user_username']) . "</a></li>";
                    echo "<li class='nav-item'><a class='nav-link text-danger' href='./users_area/logout.php'>Logout</a></li>";
                }
                ?>
            </ul>
        </div>
    </nav>

    <div class="bg-white py-5 mb-4 text-center shadow-sm">
        <h1 class="display-5 fw-bold">Welcome to Our Store</h1>
        <p class="lead text-muted">Discover the best products at the best prices</p>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-lg-9 mb-4">
                <div class="row g-4">
                    <?php

                    if (!isset($_GET['category']) && !isset($_GET['brand'])) {
                        $select_query = "SELECT * FROM `products` ORDER BY RAND() LIMIT 12";
                        $result_query = mysqli_query($con, $select_query);
                    } elseif (isset($_GET['category'])) {
                        $category_id = intval($_GET['category']);
                        $select_query = "SELECT * FROM `products` WHERE category_id = $category_id";
                        $result_query = mysqli_query($con, $select_query);
                    } elseif (isset($_GET['brand'])) {
                        $brand_id = intval($_GET['brand']);
                        $select_query = "SELECT * FROM `products` WHERE brand_id = $brand_id";
                        $result_query = mysqli_query($con, $select_query);
                    }

                    if (mysqli_num_rows($result_query) == 0) {
                        echo "<div class='col-12'><h4 class='text-center text-danger'>No products available.</h4></div>";
                    } else {
                        while ($row = mysqli_fetch_assoc($result_query)) {
                            $product_id = $row['product_id'];
                            $product_title = htmlspecialchars($row['product_title']);
                            $product_description = htmlspecialchars($row['product_description']);
                            $product_image1 = htmlspecialchars($row['product_image1']);
                            $product_price = $row['product_price'];
                    ?>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <img src="./admin_area/product_images/<?= $product_image1 ?>" class="card-img-top" alt="<?= $product_title ?>" />
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title"><?= $product_title ?></h5>
                                        <p class="card-text"><?= substr($product_description, 0, 80) ?>...</p>
                                        <p class="price"><?= $product_price ?> EGP</p>
                                        <div class="mt-auto d-flex justify-content-between">
                                            <a href="index.php?add_to_cart=<?= $product_id ?>" class="btn btn-sm btn-outline-primary">Add to cart</a>
                                            <a href="product_details.php?product_id=<?= $product_id ?>" class="btn btn-sm btn-outline-secondary">View more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="sidebar-title">Delivery Brands</div>
                    <ul class="nav flex-column mb-4">
                        <?php
                        $select_brands = "SELECT * FROM brands";
                        $result_brands = mysqli_query($con, $select_brands);
                        while ($row_data = mysqli_fetch_assoc($result_brands)) {
                            $brand_title = htmlspecialchars($row_data['brand_title']);
                            $brand_id = intval($row_data['brand_id']);
                            if (isset($_GET['brand']) && $_GET['brand'] == $brand_id) {
                                $backgroundcolor = '#0d6efd';
                                $color = 'text-white';
                            } else {
                                $backgroundcolor = '';
                                $color = '';
                            }
                             echo "<li class='nav-item' style ='background-color: $backgroundcolor'><a href='index.php?brand=$brand_id' class='nav-link $color'>$brand_title</a></li>";
                        }
                        ?>
                    </ul>

                    <div class="sidebar-title">Categories</div>
                    <ul class="nav flex-column">
                        <?php
                        $select_cat = "SELECT * FROM categories";
                        $result_cat = mysqli_query($con, $select_cat);
                        while ($row_data = mysqli_fetch_assoc($result_cat)) {
                            $category_title = htmlspecialchars($row_data['category_title']);
                            $category_id = intval($row_data['category_id']);
                            echo "<li class='nav-item'><a href='index.php?category=$category_id' class='nav-link'>$category_title</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <?php
        function getUserIP(){
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
        if (isset($_GET['add_to_cart'])) {
            $get_ip = getUserIP();
            $get_product_id = intval($_GET['add_to_cart']);

            $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip' AND product_id=$get_product_id";
            $result_query = mysqli_query($con, $select_query);
            $number_rows = mysqli_num_rows($result_query);

            if ($number_rows > 0) {
                echo "<script>alert('This item is already in your cart.')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            } else {
                $insert_query = "INSERT INTO cart_details (product_id, ip_address, quantity) VALUES ('$get_product_id', '$get_ip', 1)";
                mysqli_query($con, $insert_query);
                echo "<script>alert('Item added to cart.')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
        }
    ?>

    <footer class="footer">
        &copy; <?php echo date("Y"); ?> All Rights Reserved | E-Commerce Store
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>