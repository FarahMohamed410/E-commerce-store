<?php

session_start();
include('../include/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['payment_data'] = $_POST;
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

$get_ip_address = getUserIP();
$empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
mysqli_query($con, $empty_cart);

    header('Location: confirm_payments.php');
    exit;
}
?>
