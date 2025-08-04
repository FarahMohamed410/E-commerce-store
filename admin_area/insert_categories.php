<?php
include('../include/connect.php');
if (isset($_POST['insert_cat'])) {
    $category_title = $_POST['cat_title'];

    $select_query= "SELECT * FROM `categories` WHERE category_title ='$category_title'";
    $result_select = mysqli_query($con, $select_query );
    $number = mysqli_num_rows($result_select);
    if ($number>0) {
        echo "<script>alert('this category is present in the database')</script>";
    } else{
        $insert_query = "INSERT INTO `categories`(`category_title`) VALUES ('$category_title')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('Category has been inserted successfully')</script>";
        } else {
            echo "<script>alert('Error inserting category')</script>";
        }
    }
}
?>
<h2 class="text-center">Insert Categories</h2>
<form action="" method="POST" class="mb-2">
    <div class="input_group w-90 mb-2">
        <div class="input-group flex-nowrap w-90 mb-2">
            <span class="input-group-text bg-info" id="addon-wrapping">
                <i class="fa-solid fa-receipt"></i>
            </span>
            <input type="text" class="form-control" name="cat_title" placeholder="Insert category" aria-label="categories" aria-describedby="addon-wrapping">
        </div>
        <div class="input-group flex-nowrap w-10 mb-2 m-auto">
            <input type="submit" class="bg-info border-0 p-2" name="insert_cat" value="Insert category">
        </div>
    </div>
</form>