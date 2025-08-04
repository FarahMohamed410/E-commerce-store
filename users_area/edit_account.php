
<?php 
if(isset($_GET['edit_account'])){
    $user_session=$_SESSION['user_username'];
    $select_query="SELECT * FROM `user_table` WHERE user_username='$user_session'";
    $result=mysqli_query($con,$select_query);
    $row_fetch=mysqli_fetch_assoc($result);
    $user_id=$row_fetch['user_id'];
    $user_username=$row_fetch['user_username'];
    $email=$row_fetch['user_email'];
    $user_address=$row_fetch['user_address'];
   $user_mobile=$row_fetch['user_mobile'];
   $user_image=$row_fetch['user_image'];

   if(isset($_POST['update'])){
    $update_id = $user_id;
    $username = !empty($_POST['user_username']) ? $_POST['user_username'] : $user_username;
    $email = !empty($_POST['user_email']) ? $_POST['user_email'] : $email;
    $address = !empty($_POST['user_address']) ? $_POST['user_address'] : $user_address;
    $mobile = !empty($_POST['user_mobile']) ? $_POST['user_mobile'] : $user_mobile;

    if(!empty($_FILES['user_image']['name'])){
        $image = $_FILES['user_image']['name'];
        $image_tmp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($image_tmp,"./user_images/$image");
    } else {
        $image = $user_image;
    }

    $update_query = "UPDATE `user_table` SET 
        user_username = '$username',
        user_image = '$image',
        user_email = '$email',
        user_address = '$address',
        user_mobile = '$mobile' 
        WHERE user_id = $update_id";

    $result_update = mysqli_query($con, $update_query);

    if($result_update){
    
        $_SESSION['user_username'] = $username;

        echo "<script>alert('your data is updated successfully')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit profile</title>
    <style>
        .form-container {
            background-color: rgb(164, 219, 156);
            padding: 40px 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 700px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .h3 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        .edit_image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 20px;
            border: 3px solid #ccc;
        }
    </style>
</head>
<body><center><div class="h3">
<h3 class="text-center text-success mb-4"> Edit account</h3></div>
<div class="form-container">
<form action="" method="POST" enctype="multipart/form-data"class="text-center">
    <div class="form-outline mb-4">
        <input type="text" class="form-control w-50 m-auto" name="user_username" placeholder="<?php echo $user_username ?>">
    </div>
     <div class="form-outline mb-4">
        <input type="email" class="form-control w-50 m-auto" name="user_email" placeholder="<?php echo $email ?>">
    </div>
     <div class="form-outline mb-4 d-flex w-50 m-auto">
        <input type="file" class="form-control " name="user_image">
        <img src="./user_images/<?php echo"$user_image"?>" alt="" class="edit_image">
    </div>
     <div class="form-outline mb-4">
        <input type="text" class="form-control w-50 m-auto" name="user_address" placeholder="<?php echo $user_address ?>">
    </div>
     <div class="form-outline mb-4">
        <input type="text" class="form-control w-50 m-auto" name="user_mobile" placeholder="<?php echo $user_mobile ?>">
    </div>
    <input type="submit" class="bg-info py-2 px-3 border-0 btn btn-outline-dark" value="update" name="update">
</form>
</div>
</body>
</center>
</html>