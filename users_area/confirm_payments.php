<?php
session_start();
include('../include/connect.php');

if (!isset($_SESSION['payment_data'])) {
    header("Location: payment.php");
    exit;
}

$data = $_SESSION['payment_data'];

$order_id = "ORD" . rand(100000, 999999);
$invoice_id = "INV" . rand(1000, 9999);
$date = date("Y-m-d H:i:s");
$stmt = $con->prepare("INSERT INTO payments (order_id, invoice_id, name, amount, payment_date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $order_id, $invoice_id, $data['name'], $data['amount'], $date);
$stmt->execute();
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
  <style>
    body { font-family: Arial; text-align: center; padding: 50px; background: #f4f4f4; }
    .box { background: #fff; width: 500px; margin: auto; padding: 30px; box-shadow: 0 0 10px #ccc; border-radius: 10px; text-align: left; }
    h2 { text-align: center; }
@media print {
  body {
    background: white;
    color: black;
  }
  .box {
    box-shadow: none;
    border: none;
  }
  button, form, a {
    display: none;
  }
}
</style>

</head>
<body>
  <div class="box">
    <h2>Payment Successful</h2>
    <p><strong>Invoice ID:</strong> <?= $invoice_id ?></p>
    <p><strong>Order ID:</strong> <?= $order_id ?></p>
    <p><strong>Name:</strong> <?= htmlspecialchars($data['name']) ?></p>
    <p><strong>Amount:</strong> <?= number_format($data['amount'], 2) ?> EGP</p>
    <p><strong>Date:</strong> <?= $date ?></p>
    <form method="post" action="webhook.php">
      <input type="hidden" name="order_id" value="<?= $order_id ?>">
      <input type="hidden" name="status" value="paid">
      <button type="submit"> Webhook</button>
<button onclick="window.print()" style="margin-top: 20px;">Print Invoice</button>
<button onclick="window.open('../index.php')" style="margin-top: 20px;">back to home page</button>
 
    </form>
  </div>
</body>
</html>
