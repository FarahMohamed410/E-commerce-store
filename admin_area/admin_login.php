<?php
include('../include/connect.php');
session_start();

if (isset($_POST['admin_login'])) {
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    $get_admin = "SELECT * FROM `admin_table` WHERE admin_email='$admin_email'";
    $result = mysqli_query($con, $get_admin);

    if ($result && mysqli_num_rows($result) > 0) {
        $row_data = mysqli_fetch_assoc($result);

        if (password_verify($admin_password, $row_data['admin_password'])) {
            $_SESSION['admin_name'] = $row_data['admin_name'];
            $_SESSION['admin_id'] = $row_data['admin_id'];
  $_SESSION['admin_email'] = $row_data['admin_email'];
    $_SESSION['admin_image'] = $row_data['admin_image'];

            echo "<script>alert('Logged in successfully');window.open('index.php','_self')</script>";
            exit();
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('Invalid email');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>admin login</title>
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
    <h2> Admin Login</h2>
    <form action="" method="post">
      <div class="form-group">
  <label for="email">Admin Email</label>
  <input type="email" id="admin_email" name="admin_email" required autocomplete="off"/>
</div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="admin_password" required />
      </div>

      <button type="submit" class="submit-btn" name="admin_login">Login</button>

    </form>
  </div>

</body>
</html>


