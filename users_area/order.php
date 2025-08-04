<?php
include('../include/connect.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: user_login.php');
    exit;
}

if (!isset($_POST['payment_method'])) {
    header('Location: select_payment.php');
    exit;
}
$payment_method = $_POST['payment_method'];

$user_id = $_SESSION['user_id'];

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
$total_price = 0;

$price_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_price = mysqli_query($con, $price_query);

$invoice_number = mt_rand();
$status = 'pending';
$count_product = mysqli_num_rows($result_price);

while ($row_price = mysqli_fetch_array($result_price)) {
    $product_id = $row_price['product_id'];
    $select_product = "SELECT * FROM `products` WHERE product_id=$product_id";
    $run_price = mysqli_query($con, $select_product);

    while ($row_product_price = mysqli_fetch_array($run_price)) {
        $product_price = $row_product_price['product_price'];
        $total_price += $product_price;
    }
}

$get_cart = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
$run_cart = mysqli_query($con, $get_cart);
$quantity = 1;

if ($cart_row = mysqli_fetch_array($run_cart)) {
    $quantity = $cart_row['quantity'] > 0 ? $cart_row['quantity'] : 1;
}
$subtotal = $total_price * $quantity;

$insert_orders = "INSERT INTO `user_orders`(`user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`, `payment_method`) 
                  VALUES ('$user_id','$subtotal','$invoice_number','$count_product',NOW(),'$status', '$payment_method')";
$result = mysqli_query($con, $insert_orders);
$order_id = mysqli_insert_id($con);

mysqli_data_seek($result_price, 0); 
while ($row_price = mysqli_fetch_array($result_price)) {
    $product_id = $row_price['product_id'];
    if(mysqli_num_rows($result_price)>0){
    $insert_pending_orders = "INSERT INTO `orders_pending`(`user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) 
                              VALUES ('$user_id','$invoice_number','$product_id','$quantity','$status')";
    mysqli_query($con, $insert_pending_orders);
    }else{
        header('location:profile.php');
    }
}

$empty_cart = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_address'";
mysqli_query($con, $empty_cart);

if ($payment_method == 'cash_on_delivery') {
   header("Location: confirm_payment.php?order_id=$order_id");
    exit;
} else {
   header("Location: confirm_payment.php?order_id=$order_id");
exit;
}
?>


<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>order confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .confirmation-box {
            max-width: 600px;
            margin: 50px auto;
            padding: 40px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .payment-options li {
            margin: 10px 0;
        }
    </style>
</head>
<body>
<div class="confirmation-box text-center">
    <h2 class="text-success mb-4">your order is submitted successfully</h2>
    <p><strong>bill number:</strong> <?php echo $invoice_number; ?></p>
    <p><strong>products number:</strong> <?php echo $count_product; ?></p>
    <p><strong>total:</strong> <?php echo $subtotal; ?>L.E</p>
    <p><strong>payment method:</strong> 
        <?php 
            if ($payment_method == 'cash_on_delivery') echo"cash on delivery";
            elseif ($payment_method == 'bank_transfer') echo "bank transfer";
            elseif ($payment_method == 'vodafone_cash') echo "vodafone cash";
        ?>
    </p>

    <h5 class="mt-4">order details:</h5>
    <ul class="payment-options list-unstyled">
        <?php if ($payment_method == 'bank_transfer'): ?>
            <li>transfer to:AL-AHLY BANK:account num: <strong>#####</strong></li>
        <?php elseif ($payment_method == 'vodafone_cash'): ?>
            <li> vodafone cash:<strong>0100xxxxxxx</strong></li>
        <?php else: ?>
            <li>cash on delivey</li>
        <?php endif; ?>
    </ul>

    <a href="profile.php?user_order.php" class="btn btn-primary mt-4">back to your profile</a>
</div>
</body>
</html>

