<?php
include('../include/connect.php');
session_start();
?>
<?php
if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $get_product = "SELECT * FROM products WHERE product_id=$product_id";
    $result = mysqli_query($con, $get_product);
    $row = mysqli_fetch_assoc($result);

    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    $product_keywords = $row['product_keywords'];
    $product_image = $row['product_image1'];
    $product_price = $row['product_price'];
    $status = $row['status'];
}
if(isset($_POST['update_product'])){
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_price = $_POST['product_price'];
    $status = $_POST['status'];
    $update_query = "UPDATE products SET  product_title='$product_title',product_description='$product_description',product_keywords='$product_keywords', product_price='$product_price',status='$status' WHERE product_id=$product_id";

    $result_update = mysqli_query($con, $update_query);

    if($result_update){
        echo "<script>alert('updated successfully'); window.location.href='index.php?view_products';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">update the product</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">product title</label>
            <input type="text" name="product_title" class="form-control" value="<?=$product_title?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">description</label>
            <textarea name="product_description" class="form-control" rows="3" required><?=$product_description?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">keywords</label>
            <input type="text" name="product_keywords" class="form-control" value="<?=$product_keywords?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">price</label>
            <input type="number" name="product_price" class="form-control" value="<?=$product_price?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">status</label>
            <select name="status" class="form-select">
                <option value="available" <?= $status == 'available' ? 'selected' : '' ?>>available</option>
                <option value="unavailable" <?= $status == 'unavailable' ? 'selected' : '' ?>>unavailable</option>
            </select>
        </div>
        <button type="submit" name="update_product" class="btn btn-primary">update</button>
        <a href="view_products.php" class="btn btn-secondary">back</a>
    </form>
</div>
</body>
</html>
