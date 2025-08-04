<?php
include('../include/connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <meta charset="UTF-8">
    <title>your profile</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            direction: rtl;
            background-color: #f4f4f4;
        }


        .navbar_user {
            background-color: #333;
            overflow: hidden;
            padding: 10px 0;
        }

        .navbar_user a {
            float: right;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            transition: 0.3s;
        }

        .navbar_user a:hover {
            background-color: #575757;
        }


        .profile-container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 8px;
            text-align: center;
        }

        .profile-container img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 20px;
            border: 3px solid #ccc;
        }

        .profile-container h2 {
            margin-bottom: 10px;
            color: #333;
        }

        .profile-container p {
            margin: 5px 0;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="navbar_user">
        <a href="profile.php?edit_account">edit profile</a>
        <a href="profile.php?delete_profile">delete profile</a>
        <a href="logout.php">logout</a>
        <a href="profile.php?my_orders">my orders</a>
        <a href="profile.php">pending orders</a>
        <a href="../index.php">home page</a>
    </div>
    <?php
    $username = $_SESSION['user_username'];
    $user_image = "SELECT * FROM `user_table` WHERE user_username='$username'";
    $result_exec = mysqli_query($con, $user_image);
    $row_image = mysqli_fetch_array($result_exec);
    $image = $row_image['user_image'];
    echo "<div class='profile-container'>
    <img src='./user_images/$image' alt='user_image'>
     <h2 class='text-center text-secondary'>Welcome, $username </h2></div>"

    ?>
    <?php
    $username = $_SESSION['user_username'];
    $get_details = "SELECT * FROM `user_table` WHERE user_username='$username'";
    $result_details = mysqli_query($con, $get_details);

    while ($row_query = mysqli_fetch_array($result_details)) {
        $user_id = $row_query['user_id'];

        if (!isset($_GET['edit_account']) && !isset($_GET['my_orders']) && !isset($_GET['delete_profile'])) {
            $get_orders = "SELECT * FROM `user_orders` WHERE user_id=$user_id AND order_status='awaiting_confirmation'";
            $result_orders = mysqli_query($con, $get_orders);
            $row_count = mysqli_num_rows($result_orders);

            echo '<div class="container mt-4">';
            echo '<div class="card shadow-sm">';
            echo '<div class="card-body text-center">';

            if ($row_count > 0) {
                echo "
        <h4 class='text-success mb-3'>
          <i class='fas fa-clock'></i>You have<span class='text-danger fw-bold'>$row_count</span>pending order(s)
        </h4>
        <a href='profile.php?my_orders' class='btn btn-outline-primary'>orders details</a>
      ";
            } else {
                echo "
        <h4 class='text-success mb-3'>
          <i class='fas fa-check-circle'></i>No current pending orders
        </h4>
        <a href='../index.php' class='btn btn-outline-dark'>Explore our products</a>
      ";
            }

            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }?>

    <div class="d-flex justify-content-center">
        <?php 
          if(isset($_GET['edit_account'])){
include('edit_account.php');
    }
    ?>

    </div>
       <div class="d-flex justify-content-center">
        <?php 
          if(isset($_GET['my_orders'])){
include('user_orders.php');
    }
    ?>
            <?php 

if(isset($_GET['delete_profile'])){
    include('delete_account.php');
}
?>

    </div>
  


</body>

</html>