<?php
include('../include/connect.php');
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        
        .photo-container img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 20px;
            border: 3px solid #ccc;
        }
          .photo-container h3 {
            margin-bottom: 10px;
            color: #333;
        }
        .product_img{
width: 10%;
object-fit: contain;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <img src="../images/logo.jpg" alt="" class="logo">
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    <?php
                if(isset($_SESSION['admin_name'])){
                 echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome ".$_SESSION['admin_name']."</a></li>"; 
                }
               
                ?>
                    </li>
                </ul>
            </nav>

        </div>
    </nav>
    <div cllass="bg-light">
        <h3 class="text-center p-2">Manage Details</h3>
    </div>
    <div class="row">
        <div class="col-md-12 bg-secondary p-3 d-flex align-items-center">
            <div class="photo-container">
                <img src="admin_images/<?php echo $_SESSION['admin_image']; ?>" alt="Admin Image">
                <h3 class="text-light"><?=$_SESSION['admin_name']?></h3>
<div class="container my-5">
  <div class="d-flex flex-wrap justify-content-center gap-3">
    <a href="insert_products.php" class="btn btn-info text-white fw-bold">Insert Products</a>
    <a href="index.php?view_products" class="btn btn-info text-white fw-bold">View Products</a>
    <a href="index.php?insert_category" class="btn btn-info text-white fw-bold">Insert Categories</a>
    <a href="index.php?view_categories" class="btn btn-info text-white fw-bold">View Categories</a>
    <a href="index.php?insert_brand" class="btn btn-info text-white fw-bold">Insert Brands</a>
    <a href="index.php?view_brands" class="btn btn-info text-white fw-bold">View Brands</a>
    <a href="index.php?all_orders" class="btn btn-info text-white fw-bold">All Orders</a>
    <a href="index.php?all_payments" class="btn btn-info text-white fw-bold">All Payments</a>
    <a href="index.php?all_users" class="btn btn-info text-white fw-bold">List Users</a>
        <a href="index.php?submitted" class="btn btn-info text-white fw-bold">submitted orders</a>
         <a href="index.php?messages" class="btn btn-info text-white fw-bold">users messages</a>
    <a href="admin_logout.php" class="btn btn-danger text-white fw-bold">Logout</a>
     <a href="admin_register.php" class="btn btn-success text-white fw-bold">Add new admin</a>
  </div>
</div>

<div class ="container my-3">
    <?php 
    if(isset($_GET['insert_category'])){
        include('insert_categories.php');
    }
    ?>
</div>
<div class ="container my-5">
    <?php 
    if(isset($_GET['insert_brand'])){
        include('insert_brands.php');
    }
    ?>
      <?php 
    if(isset($_GET['view_products'])){
        include('view_products.php');
    }
    ?>
          <?php 
    if(isset($_GET['view_categories'])){
        include('view_categories.php');
    }
    ?>
            <?php 
    if(isset($_GET['view_brands'])){
        include('view_brands.php');
    }
    ?>
               <?php 
    if(isset($_GET['all_users'])){
        include('all_users.php');
    }
    ?>
                 <?php 
    if(isset($_GET['all_payments'])){
        include('all_payment.php');
    }
    ?>
                   <?php 
    if(isset($_GET['all_orders'])){
        include('all_orders.php');
    }
    ?>
                    <?php 
    if(isset($_GET['submitted'])){
        include('admin_review_orders.php');
    }
    ?>
                       <?php 
    if(isset($_GET['messages'])){
        include('user_messages.php');
    }
    ?>
</div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
</body>

</html>