<?php
include('../include/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $stmt = $con->prepare("UPDATE payments SET status = ? WHERE order_id = ?");
    $stmt->bind_param("ss", $status, $order_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<p style='color:green; text-align:center;'>payment process is done successfully for order <strong>$order_id</strong>.</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>No order found to update.</p>";
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}
?>
