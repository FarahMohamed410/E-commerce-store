<?php
include('../include/connect.php');
if(isset($_POST['category_id'])){
    $category_id=$_POST['category_id'];
    $delete_cat="DELETE FROM `categories`WHERE category_id=$category_id";
    $result=mysqli_query($con,$delete_cat);
    if($result){
        echo"<script>alert('category is deleted successfully');window.location.href='index.php?view_categories'</script>";
    }
    else{
        echo"<script>alert('error')</script>";
    }
}
?>