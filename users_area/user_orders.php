<?php
include('../include/connect.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_username'])) {
    header("Location: user_login.php");
    exit;
}

$username = $_SESSION['user_username'];
$get_user = "SELECT * FROM `user_table` WHERE user_username='$username'";
$result = mysqli_query($con, $get_user);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<p>User not found!</p>";
    exit;
}

$row_fetch = mysqli_fetch_assoc($result);
$user_id = $row_fetch['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-success mb-4 text-center">All My Orders</h3>
        <table class="table table-bordered table-striped">
            <thead class="bg-info text-white">
                <tr>
                    <th>SI No</th>
                    <th>Amount Due</th>
                    <th>Total Products</th>
                    <th>Invoice Number</th>
                    <th>Date</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Confirm Payment</th>
                </tr>
            </thead>
            <tbody class="bg-secondary text-light">
                <?php
                $get_order_details = "SELECT * FROM `user_orders` WHERE user_id='$user_id' ORDER BY order_date DESC";
                $result_details = mysqli_query($con, $get_order_details);

                if (mysqli_num_rows($result_details) == 0) {
                    echo "<tr><td colspan='8' class='text-center'>No orders found.</td></tr>";
                } else {
                    $number = 1;
                    while ($row = mysqli_fetch_assoc($result_details)) {
                        $order_id = $row['order_id'];
                        $amount_due = $row['amount_due'];
                        $total_products = $row['total_products'];
                        $invoice_num = $row['invoice_number'];
                        $order_status = $row['order_status'];
                        $order_date = $row['order_date'];
                        $payment_method = $row['payment_method'];

                    $number++;
                        switch ($payment_method) {
                            case 'cash_on_delivery':
                                $payment_method_text = 'Cash on Delivery';
                                break;
                            case 'bank_transfer':
                                $payment_method_text = 'Bank Transfer';
                                break;
                            case 'vodafone_cash':
                                $payment_method_text = 'Vodafone Cash';
                                break;
                            default:
                                $payment_method_text = $payment_method;
                        }

                    
                        if ($order_status == 'complete') {
                            $order_status_text = '<span class="text-success">Complete</span>';
                        } elseif ($order_status == 'pending') {
                            $order_status_text = '<span class="text-warning">Pending</span>';
                        } else {
                            $order_status_text = htmlspecialchars($order_status);
                        }

                        echo "<tr>
                            <td>{$number}</td>
                            <td> {$amount_due} L.E</td>
                            <td>{$total_products}</td>
                            <td>{$invoice_num}</td>
                            <td>{$order_date}</td>
                            <td>{$payment_method_text}</td>
                            <td>{$order_status_text}</td>";

                    
    echo "<td>";
if ($order_status != 'confirmed') {
echo "<span class='badge bg-success'>waiting to be reviewed</span>";
} else {
  echo "<a href='order_details.php?order_id={$order_id}' class='text-light btn btn-sm btn-success'>view details</a>";
}
echo "</td>";
                    }
                    }
?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

