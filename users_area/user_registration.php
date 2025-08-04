<?php
include("../include/connect.php");
session_start();

if (isset($_POST['user_regist'])) {
    $user_username = trim($_POST['user_username']);
    $user_email = trim($_POST['user_email']);
    $user_password = $_POST['user_password'];
    $conf_password = $_POST['conf_password'] ?? '';
    $user_address = trim($_POST['user_address']);
    $user_mobile = trim($_POST['user_mobile']);
    $user_image_name = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getUserIP();

    $select_query = "SELECT * FROM `user_table` WHERE user_email = '$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        echo "<script>alert('User already exists')</script>";
    } elseif ($user_password !== $conf_password) {
        echo "<script>alert('Passwords do not match')</script>";
    } else {
    
        move_uploaded_file($user_image_tmp, "./user_images/$user_image_name");

  
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    
        $insert_query = "
            INSERT INTO `user_table` (
                `user_username`,
                `user_password`,
                `user_image`,
                `user_email`,
                `user_ip`,
                `user_address`,
                `user_mobile`
            ) VALUES (
                '$user_username',
                '$hashed_password',
                '$user_image_name',
                '$user_email',
                '$user_ip',
                '$user_address',
                '$user_mobile'
            )
        ";

        $exec_query = mysqli_query($con, $insert_query);

        if ($exec_query) {
            echo "<script>alert('Data inserted successfully')</script>";
        } else {
            die("Error: " . mysqli_error($con));
        }
    }
   $user_id = $_SESSION['user_id'];
$select_cart_item = "SELECT * FROM `cart_details` WHERE user_id = '$user_id'";

    $result_cart=mysqli_query($con,$select_cart_item);
    $rows_count=mysqli_num_rows($result_cart);
    if($rows_count>0){
        $_SESSION['user_username'] = $user_username;
$_SESSION['user_id'] = mysqli_insert_id($con);

        echo"<script>alert('you have item in your cart')</script>";
          echo"<script>window.open('checkout.php','_self')</script>";
    }else{
        echo"<script>window.open('../index.php','_self')</script>";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Registration</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .form-container {
            background-color: rgb(157, 214, 249);
            padding: 40px 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #444;
            font-weight: 500;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="file"],
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        .form-group input[type="file"] {
            padding: 8px;
        }

        .form-group textarea {
            resize: vertical;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background-color: rgb(216, 218, 226);
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .submit-btn:hover {
            background-color: rgb(5, 5, 5);
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>User Registration Form</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="user_username" required autocomplete="off" />
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="user_email" required />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="user_password" required />
            </div>

            <div class="form-group">
                <label for="password"> Confirm Password</label>
                <input type="password" id="conf_password" name="conf_password" required />
            </div>

            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="text" id="mobile" name="user_mobile" required />
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="user_address" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="image">Profile Image</label>
                <input type="file" id="image" name="user_image" accept="image/*" />
            </div>

            <button type="submit" class="submit-btn" name="user_regist">Register</button>
            <p class="small fw-bold mt-2pt-1">Already have an account?<a href="user_login.php">login</a></p>
        </form>
    </div>

</body>

</html>


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









<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>