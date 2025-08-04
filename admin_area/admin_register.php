<?php 
include('../include/connect.php');
session_start();

if (isset($_POST['admin_register'])) {
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $admin_conf = $_POST['conf_password'];
    $admin_image_name = $_FILES['admin_image']['name'];
    $admin_image_tmp = $_FILES['admin_image']['tmp_name'];

    $select_query = "SELECT * FROM `admin_table` WHERE admin_email='$admin_email'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
        echo "<script>alert('This admin already exists');</script>";
    } elseif ($admin_password !== $admin_conf) {
        echo "<script>alert('Passwords do not match');</script>";
    } $target_path = __DIR__ . "/admin_images/" . $admin_image_name;
if (move_uploaded_file($admin_image_tmp, $target_path)) {
    $_SESSION['admin_image'] = $admin_image_name;
}
else{
    echo"<script>alert('failed to upload the photo!')</script>";
}



        $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
        
        $insert_query = "INSERT INTO `admin_table`(`admin_name`, `admin_email`, `admin_password`, `admin_image`) 
                         VALUES ('$admin_name', '$admin_email', '$hashed_password', '$admin_image_name')";

        $res = mysqli_query($con, $insert_query);

      if ($res) {
    $_SESSION['admin_name'] = $admin_name;
    $_SESSION['admin_email'] = $admin_email;
    echo "<script>alert('Registration successful');window.location.href='index.php';</script>";
}
else {
            die("Error: " . mysqli_error($con));
        }
    }

?>



    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>admin register</title>
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
        <h2>New admin registration</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">admin name</label>
                <input type="text" id="name" name="admin_name" required autocomplete="off" />
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="admin_email" required />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="admin_password" required />
            </div>

            <div class="form-group">
                <label for="password"> Confirm Password</label>
                <input type="password" id="conf_password" name="conf_password" required />
    </div>

            <div class="form-group">
                <label for="image">Profile Image</label>
                <input type="file" id="image" name="admin_image" accept="image/*" />
            </div>

          <button type="submit" class="submit-btn" name="admin_register">Register</button>
            <p class="small fw-bold mt-2pt-1">have account already?<a href="admin_login.php">admin login</a></p>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
