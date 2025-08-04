<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: user_login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>select payment method</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .payment-option {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }
        .payment-option:hover {
            background-color: #e9ecef;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h3 class="text-center mb-4">offline payment</h3>
    <form action="order.php" method="POST" class="row justify-content-center">

        <div class="col-md-6">
            <label class="payment-option d-block">
                <input type="radio" name="payment_method" value="cash_on_delivery" required>
                cash on delivery            
            </label>
            <label class="payment-option d-block">
                <input type="radio" name="payment_method" value="bank_transfer" required>
                bank transfer
            </label>
            <label class="payment-option d-block">
                <input type="radio" name="payment_method" value="vodafone_cash" required>
                vodafone cash
            </label>

            <button type="submit" class="btn btn-primary w-100 mt-4">continue the order</button>
        </div>
    </form>
</div>
</body>
</html>
