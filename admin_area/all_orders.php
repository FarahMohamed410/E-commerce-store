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
        <h1 class="text-center">All Orders</h1>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-info">
                        <tr>
                            <td>#</td>
                            <td>user id</td>
                            <td>username</td>
                            <td>total price</td>
                            <td>Invoice Number</td>
                             <td>Total products</td>
                              <td>Date</td>
                              <td>status</td>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php
                        $get_orders="SELECT * FROM `user_orders`";
                        $result=mysqli_query($con,$get_orders);
                        $count=0;
                        while($row=mysqli_fetch_assoc($result)){
                            $amount=$row['amount_due'];
                            $invoice=$row['invoice_number'];
                            $total_products=$row['total_products'];
                            $date=$row['order_date'];
                            $status=$row['order_status'];
                            $user_id=$row['user_id'];
                            $count++;
                             $get_username="SELECT * FROM `user_table` WHERE user_id='$user_id'";
                             $res=mysqli_query($con,$get_username);
                             $row=mysqli_fetch_assoc($res);
                             $username=$row['user_username'];
                         ?>

                         <tr>
                            <th><?=$count?></th>
                            <th><?=$user_id?></th>
                            <th><?=$username?></th>
                             <th><?=$amount?></th>
                              <th><?=$invoice?></th>
                               <th><?=$total_products?></th>
                                <th><?=$date?></th>
                                 <th><?=$status?></th>
                         </tr>
                    </tbody>
                    <?php } ?>  
</body>
</html>