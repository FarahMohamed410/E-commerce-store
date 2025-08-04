
<?php
session_start();
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

if (isset($_GET['add_to_cart'])) {
    $get_ip = getUserIP();
    $get_product_id = $_GET['add_to_cart'];

    $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip' AND product_id=$get_product_id";
    $result_query = mysqli_query($con, $select_query);
    $number_rows = mysqli_num_rows($result_query);

    if ($number_rows > 0) {
        echo "<script>alert('This item is already in your cart.')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    } else {
        $insert_query = "INSERT INTO cart_details (product_id, ip_address, quantity) VALUES ('$get_product_id', '$get_ip', 1)";
        mysqli_query($con, $insert_query);
        echo "<script>alert('Item added to cart.')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}
?>
<?php
include('include/connect.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $get_product = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($con, $get_product);
    $row = mysqli_fetch_assoc($result);

    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    $product_image1 = $row['product_image1'];
    $product_price = $row['product_price'];
} else {
    echo "<h2 class='text-center text-danger'>No product selected!</h2>";
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .product-img {
            width: 100%;
            max-height: 400px;
            object-fit: contain;
        }

        .btn-custom {
            width: 100%;
        }

        .product-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .price {
            font-size: 1.3rem;
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-6">
                <img src="./admin_area/product_images/<?php echo $product_image1; ?>" class="product-img img-fluid border" alt="<?php echo $product_title; ?>">
            </div>
            <div class="col-md-6">
                <div class="product-details">
                    <h2><?php echo $product_title; ?></h2>
                    <p class="text-muted"><?php echo $product_description; ?></p>
                    <p class="price">Price: <?php echo $product_price; ?> /-</p>

                    <div class="d-grid gap-2 mt-4">
                        <a href="index.php?add_to_cart=<?php echo $product_id;?>"class="btn btn-info btn-custom"><i class="fa fa-cart-plus"></i> Add to Cart</a>
                        <a href="index.php" class="btn btn-secondary btn-custom"><i class="fa fa-arrow-left"></i> Back to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
<?php
$related_query = "SELECT * FROM products WHERE category_id = {$row['category_id']} AND product_id != $product_id LIMIT 3";
$related_result = mysqli_query($con, $related_query);

if (mysqli_num_rows($related_result) > 0) {
    echo "<hr><h5 class='mt-5 mb-4 text-center text-info'>Related Products</h5>";
    echo "<div class='row justify-content-center g-4'>";
    
    while ($related = mysqli_fetch_assoc($related_result)) {
        $related_id = $related['product_id'];
        $related_title = $related['product_title'];
        $related_img = $related['product_image1'];
        $related_price = $related['product_price'];

        echo "
        <div class='col-md-3 col-sm-6'>
            <div class='card h-100 shadow-sm text-center'>
                <img src='./admin_area/product_images/$related_img' class='card-img-top img-fluid p-2' alt='$related_title'>
                <div class='card-body'>
                    <h6 class='card-title'>$related_title</h6>
                    <p class='text-success fw-semibold small mb-2'>Price: $related_price/-</p>
                    <div class='d-grid gap-2'>
                        <a href='product_details.php?product_id= $related_id' class='btn btn-sm btn-outline-primary'>View</a>
                        <a href='index.php?add_to_cart=$related_id' class='btn btn-sm btn-info'>Add</a>
                    </div>
                </div>
            </div>
        </div>";
    }

    echo "</div>";
}
?>


    <footer class="footer bg-info text-white text-center py-3">
        &copy; <?php echo date("Y"); ?> E-Commerce Store. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
