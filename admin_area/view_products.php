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

        .user_img {
            width: 70px;
            height: auto;
        }
        
    </style>

</head>

<body>
    <div class="container">
        <h1 class="text-center">All Products</h1>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-info">
            <tr>
                <th>Product Id</th>
                <th>Product title</th>
                <th>Product image</th>
                <th>Product price</th>
                <th>Product sold</th>
                <th>status</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $get_products = "SELECT * FROM `products`";
            $result = mysqli_query($con, $get_products);
            $number = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_image = $row['product_image1'];
                $product_price = $row['product_price'];
                $product_status = $row['status'];
                $number++; ?>
                <?php
                $get_count = "SELECT * FROM `orders_pending` WHERE  product_id=$product_id";
                $count_result = mysqli_query($con, $get_count);
                $sold = mysqli_num_rows($count_result);
                ?>
                <tr class='text-center'>
                    <td><?= $number ?></td>
                    <td><?= $product_title ?></td>
                    <td><img src='./product_images/<?= $product_image ?>' class='product_img'></img></td>
                    <td><?= $product_price ?>/-</td>
                    <td><?= $sold ?></td>
                    <td><?= $product_status ?></td>
                    <td><a href='edit_product.php?product_id=<?= $product_id ?>' class='text-light'>
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class='fa-solid fa-pen-to-square'></i>
                        </a>

                    <td>
                        <form method="POST" action="delete_product.php" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            <input type="hidden" name="product_id" value="<?= $product_id ?>">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class='fa-solid fa-trash'></i>
                            </button>
                        </form>
                    </td>

                </tr>
            <?php
            }
            ?>
        </tbody>

    </table>
</body>

</html>