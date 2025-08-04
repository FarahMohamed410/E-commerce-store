<?php
include('../include/connect.php');
session_start();

if (!isset($_SESSION['user_username'])) {
    header('Location: user_login.php');
    exit;
}

if (!isset($_GET['order_id'])) {
    echo "Invalid request!";
    exit;
}

$order_id = intval($_GET['order_id']);
$user_username = $_SESSION['user_username'];

$query = "SELECT * FROM user_orders WHERE order_id = $order_id";
$result = mysqli_query($con, $query);
$order = mysqli_fetch_assoc($result);

if (!$order) {
    echo "Order not found!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $payment_method = strtolower($order['payment_method']);

    
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);


    $methods_need_receipt = ['bank_transfer', 'vodafone_cash'];

    if (in_array($payment_method, $methods_need_receipt)) {
        if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] === 0) {
            $upload_dir = 'receipts/';
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

            $filename = uniqid() . '_' . basename($_FILES['receipt']['name']);
            $target_file = $upload_dir . $filename;

            $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($_FILES['receipt']['type'], $allowed_types)) {
                echo "<p class='text-danger'>Invalid file type, Only JPG/PNG allowed.</p>";
                exit;
            }

            if (move_uploaded_file($_FILES['receipt']['tmp_name'], $target_file)) {
        
                $update_query = "UPDATE user_orders SET order_status='awaiting_confirmation', receipt='$filename', detailed_address='$address', phone='$phone' WHERE order_id=$order_id";
                mysqli_query($con, $update_query);
                header("Location: profile.php?user_orders.php"); 
            } else {
                echo "<p class='text-danger'>Failed to upload the receipt. Try again.</p>";
            }
        } else {
            echo "<p class='text-danger'>Please upload a receipt file.</p>";
        }
    } else {

        $update_query = "UPDATE user_orders SET order_status='awaiting_confirmation', detailed_address='$address', phone='$phone' WHERE order_id=$order_id";
        mysqli_query($con, $update_query);
            header("Location: profile.php?user_orders.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Confirm Payment</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h3>Confirm Payment for Invoice #<?= htmlspecialchars($order['invoice_number']) ?></h3>
    <p>Amount due: <?= htmlspecialchars($order['amount_due']) ?> L.E</p>
    <p>Payment method: <?= htmlspecialchars($order['payment_method']) ?></p>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3" id="receipt_section">
    <label for="receipt" class="form-label">Upload payment receipt</label>
    <input type="file" name="receipt" id="receipt" class="form-control" required>
</div>

        <div class="mb-3">
        <label for="address" class="form-label">Delivery Address</label>
        <textarea name="address" id="address" class="form-control" required><?= htmlspecialchars($order['address'] ?? '') ?></textarea>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="tel" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($order['phone'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Submit Confirmation</button>
    </form>

    <a href="profile.php" class="btn btn-link mt-3">Back to your profile</a>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const paymentMethod = "<?= strtolower($order['payment_method']) ?>";
    const receiptSection = document.getElementById("receipt_section");
    const receiptInput = document.getElementById("receipt");

   if (["cod", "cash_on_delivery"].includes(paymentMethod)) {
    receiptSection.style.display = "none";
    receiptInput.removeAttribute("required");
}

});
</script>


</body>
</html>
