<?php
include('../include/connect.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$query = "SELECT * FROM user_orders WHERE order_status = 'awaiting_confirmation'";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Orders Awaiting Confirmation</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Invoice</th>
                <th>User ID</th>
                <th>Amount</th>
                <th>Payment</th>
                <th>Receipt</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Confirm</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($order = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($order['invoice_number']) ?></td>
                <td><?= htmlspecialchars($order['user_id']) ?></td>
                <td><?= htmlspecialchars($order['amount_due']) ?> L.E</td>
                <td><?= htmlspecialchars($order['payment_method']) ?></td>
<?php
$receipt = trim($order['receipt']);
$receipt_link = "../users_area/receipts/" . urlencode($receipt);
?>

<td>
    <?php if (!empty($receipt)): ?>
        <a href="<?= $receipt_link ?>" target="_blank">View</a>
    <?php else: ?>
        No Receipt
    <?php endif; ?>
</td>


                <td><?= nl2br(htmlspecialchars($order['detailed_address'])) ?></td>
                <td><?= htmlspecialchars($order['phone']) ?></td>
                <td>
                    <form method="POST" action="confirm_order.php">
                        <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                        <input type="text" name="shipping_company" placeholder="Shipping Company" class="form-control mb-1" required>
                        <input type="text" name="tracking_number" placeholder="Tracking #" class="form-control mb-1" required>
                        <input type="date" name="delivery_date" class="form-control mb-1" required>
                        <button type="submit" class="btn btn-sm btn-success">Confirm</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

