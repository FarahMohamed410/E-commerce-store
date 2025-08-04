<?php
include('../include/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        h1 {
            margin-top: 30px;
            margin-bottom: 20px;
            color: #343a40;
        }
</style>
</head>
<body> 
    <div class="container">
        <h1 class="text-center">confirmed orders details</h1>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-info">
                        <tr>
                            <td>#</td>
                            <td>amount due</td>
                            <td>invoice number</td>
                            <td>total products</td>
                            <td>order date</td>
                             <td>payment method</td>
                              <td>shipping company</td>
                              <td>tracking number</td>
                              <td>delivery date</td>
                              <center><a href="profile.php" class="btn btn-success mt-3">Back to your profile</a></center>
                        </tr> 
                        
                    </thead>
                    
                    <tbody>
                        <?php
                        $get_orders="SELECT * FROM `user_orders` where order_status='confirmed'";
                        $result=mysqli_query($con,$get_orders);
                        $count=0;
                        while($row=mysqli_fetch_assoc($result)){
                            $amount=$row['amount_due'];
                            $invoice=$row['invoice_number'];
                            $total_products=$row['total_products'];
                            $date=$row['order_date'];
                            $payment_method=$row['payment_method'];
                            $shipping_comp=$row['shipping_company'];
                            $track_num=$row['tracking_number'];
                            $del_date=$row['delivery_date'];
                            $user_id=$row['user_id'];
                            $count++;
                         ?>

                         <tr>
                            <th><?=$count?></th>
                            <th><?=$amount?></th>
                            <th><?=$invoice?></th>
                             <th><?=$total_products?></th>
                              <th><?=$date?></th>
                               <th><?=$payment_method?></th>
                                <th><?=$shipping_comp?></th>
                                 <th><?=$track_num?></th>
                                 <th><?=$del_date?></th>
                         </tr>
                         
                    </tbody>
                    
                    <?php } ?>  
                    
                        </body>
</html>