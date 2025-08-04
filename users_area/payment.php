<?php
include('../include/connect.php');
session_start();
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


if (!isset($_SESSION['user_id'])) {
    header('Location: user_login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Payment Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .payment-container {
      padding: 50px 15px;
    }

    .card {
      transition: transform 0.2s ease-in-out;
    }

    .card:hover {
      transform: scale(1.02);
    }

    .card img {
      max-width: 100%;
      height: auto;
    }

    .pay-offline-btn {
      text-decoration: none;
      display: block;
      padding: 15px;
      background-color: #0d6efd;
      color: white;
      text-align: center;
      border-radius: 5px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .pay-offline-btn:hover {
      background-color: #084298;
    }
  </style>
</head>
<body>

<div class="container payment-container">
  <h2 class="text-center text-info mb-5">Choose Your Payment Method</h2>
  <div class="row justify-content-center g-4">

  
    <div class="col-md-6 col-lg-5">
      <div class="card shadow text-center p-3">
        <a href="online_payment.php" target="_blank">
          <img src="../images/payment.jpg" alt="Pay with PayPal">
        </a>
      </div>
    </div>

    
    <div class="col-md-6 col-lg-5">
      <div class="card shadow text-center p-4 d-flex justify-content-center align-items-center">
        <a href="select_payment.php" class="pay-offline-btn">
          <i class="fas fa-money-bill-wave me-2"></i>Pay Offline
        </a>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
