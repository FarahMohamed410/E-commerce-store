<?php
include("../include/connect.php");
session_start();

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
$user_ip=getUserIP();

if (isset($_POST['user_login'])) {
    $user_username = trim($_POST['user_username']);
    $user_password = trim($_POST['user_password']);

    
    $select_query = "SELECT * FROM `user_table` WHERE LOWER(user_username) = LOWER('$user_username')";
    $result = mysqli_query($con, $select_query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row_data = mysqli_fetch_assoc($result);

      
        if (password_verify($user_password, $row_data['user_password'])) {
            $_SESSION['user_username'] = $row_data['user_username'];
            $_SESSION['user_id'] = $row_data['user_id'];

            $user_id = $row_data['user_id'];

            
            $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address='user_ip'";
            $select_cart = mysqli_query($con, $select_query_cart);
            $row_count_cart = mysqli_num_rows($select_cart);

            echo "<script>alert('Logged in successfully')</script>";

            if ($row_count_cart > 0) {
                echo "<script>window.open('payment.php','_self')</script>";
            } else {
                echo "<script>window.open('profile.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid password')</script>";
        }
    } else {
        echo "<script>alert('Invalid username')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User login</title>
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
      background-color:rgb(157, 214, 249);
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
      background-color:rgb(234, 236, 244);
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .submit-btn:hover {
      background-color:rgb(7, 7, 7);
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
    <h2>Login</h2>
    <form action="" method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="user_username" required autocomplete="off"/>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="user_password" required />
      </div>

      <button type="submit" class="submit-btn" name="user_login">Login</button>
      <p class="small fw-bold mt-2pt-1">Don't have an account? <a href="user_registration.php">Register</a></p>
    </form>
  </div>

</body>
</html>
