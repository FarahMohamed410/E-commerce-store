<?php
include('../include/connect.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = intval($_POST['order_id']);
    $shipping_company = mysqli_real_escape_string($con, $_POST['shipping_company']);
    $tracking_number = mysqli_real_escape_string($con, $_POST['tracking_number']);
    $delivery_date = $_POST['delivery_date'];

    $update = "UPDATE user_orders SET 
        order_status = 'confirmed',
        shipping_company = '$shipping_company',
        tracking_number = '$tracking_number',
        delivery_date = '$delivery_date'
        WHERE order_id = $order_id";

    if (mysqli_query($con, $update)) {
        header("Location:index.php");
        exit;
    } else {
        echo "Failed to confirm order.";
    }
}
?>


