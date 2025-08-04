<?php
include('../include/connect.php');
if(isset($_POST['brand_id'])){
   $brand_id = intval($_POST['brand_id']);
    $delete_brand="DELETE FROM `brands` WHERE brand_id=$brand_id";
    $result=mysqli_query($con,$delete_brand);
    if($result){
           echo "<script>alert('deleted successfully'); window.location.href='index.php?view_brands';</script>";
    }
    else{
        echo "<script>alert('error')</script>";
    }
    }
