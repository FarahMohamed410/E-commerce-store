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
                    <li class="nav-item"><a class="nav-link active text-white" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="../display_all.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="user_registration.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Contact</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup></sub>

                                </form>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="#">Welcome Guest</a></li>
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
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <?php
if (!isset($_SESSION['user_username'])) {
    header('Location: user_login.php');
    exit();
}
    header('location:payment.php');

?>

        


            </div>
        </div>
    </div>

    <div class="footer text-center">
        &copy; <?php echo date("Y"); ?> All Rights Reserved | E-Commerce Store
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>