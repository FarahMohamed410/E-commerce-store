<?php
include('../include/connect.php');
if (isset($_POST['insert_brand'])) {
    $brand_title = $_POST['brand_title'];

    $select_query= "SELECT * FROM `brands` WHERE brand_title ='$brand_title'";
    $result_select = mysqli_query($con, $select_query );
    $number = mysqli_num_rows($result_select);
    if ($number>0) {
        echo "<script>alert('this brand is present in the database')</script>";
    } else{
        $insert_query = "INSERT INTO `brands`(`brand_title`) VALUES ('$brand_title')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('brand has been inserted successfully')</script>";
        } else {
            echo "<script>alert('Error inserting brand')</script>";
        }
    }
}
?>


<h2 class="text-center">Insert Brands</h2>
<form action="" method="POST" calss="mb-2">
    <div class="input_group">
        <div class="input-group flex-nowrap w-90 mb-2">
            <span class="input-group-text bg-info" id="addon-wrapping"><i class="fa-solid fa-reciept"></i></span>
            <input type="text" class="form-control" name="brand_title" placeholder="insert brands" aria-label="Username" aria-describedby="addon-wrapping">
        </div>
        <div class="input-group flex-nowrap w-10 mb-2 m-auto">
<input type="submit" class=" bg-info border-0 p-2 my-3" name="insert_brand"value="insert brands">
        </div>
           
               
        </div>
</form>