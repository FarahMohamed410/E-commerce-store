
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
        <h1 class="text-center">All Payments</h1>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-info">
                        <tr>
                            <th>#</th>
                            <th>invoice number</th>
                            <th>amount</th>
                            <th>payment mode</th>
                            <th>date</th>

                        </tr>
    </thead>
    <tbody>
        <?php 
        $get_payment="SELECT * FROM `user_payment`";
        $result=mysqli_query($con,$get_payment);
        $count=0;
        while($row=mysqli_fetch_assoc($result)){
            $invoice=$row['invoice_number'];
            $amount=$row['amount'];
            $payment_mod=$row['payment_mode'];
            $date=$row['date'];
            $count++;
        ?>
        <tr>
            <td><?=$count?></td>
             <td><?=$invoice?></td>
              <td><?=$amount?></td>
              <td><?=$payment_mod?></td>
               <td><?=$date?></td> 
        </tr>
    </tbody>
    <?php 
        }
        ?>
</body>
</html>