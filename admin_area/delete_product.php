<?php 
include('../include/connect.php');
if(isset($_POST['product_id'])){
    $product_id=$_POST['product_id'];
    $delete_product="DELETE FROM `products` WHERE product_id=$product_id";
    $result=mysqli_query($con,$delete_product);
    if($result){
     echo "<script>alert('deleted successfully'); window.location.href='index.php?view_products';</script>";
    }
    else{
        echo "<script>alert('error')</script>";
    }
}
?>