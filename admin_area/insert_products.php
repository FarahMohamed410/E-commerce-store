<?php
include('../include/connect.php');
if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_categories']; 
    $product_brand = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = "true";

    $product_image1 = $_FILES['product_image1']['name'];
   

    $tmp_image1 = $_FILES['product_image1']['tmp_name'];
   

    if ($product_title == '' or $product_description == '' or $product_category == '' or $product_brand == '' or $product_image1 == '') {
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    } else {
        move_uploaded_file($tmp_image1, "./product_images/$product_image1");
       

        $insert_products = "INSERT INTO `products`( `product_title`, `product_description`, `product_keywords`, `category_id`, `brand_id`, `product_image1`, `product_price`, `date`, `status`) VALUES ('$product_title','$product_description','$product_keywords','$product_category','$product_brand','$product_image1','$product_price',NOW(),'$product_status')";
        
        $result_query =mysqli_query($con, $insert_products);

        if (!$result_query) {
            die("Query Failed: " . mysqli_error($con)); 
        } else {
            echo "<script>alert('Successfully inserted the product')</script>";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Insert Products</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #f8f9fa;
            }

            .card {
                border: none;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            .form-control,
            .form-select {
                border-radius: 8px;
            }

            .btn-custom {
                background-color: #17a2b8;
                color: white;
                border-radius: 8px;
            }

            .btn-custom:hover {
                background-color: #138496;
            }
        </style>
    </head>

<body>

    <div class="container py-5">
        <div class="card mx-auto" style="max-width: 700px;">
            <div class="card-body">
                <h2 class="text-center mb-4"> Insert Product</h2>
                <form action="" method="POST" enctype="multipart/form-data">

                    
                    <div class="mb-3">
                        <label for="product_title" class="form-label">Product Title</label>
                        <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" required>
                    </div>

                   
                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description</label>
                        <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" required>
                    </div>

                   
                    <div class="mb-3">
                        <label for="product_keywords" class="form-label">Product Keywords</label>
                        <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" required>
                    </div>

                   
                    <div class="mb-3">
                        <label class="form-label">Product Category</label>
                        <select name="product_categories" class="form-select" required>
                            <option value="">Select a category</option>

                            <?php
                            $select_query = "SELECT * FROM `categories`";

                            $result_query = mysqli_query($con, $select_query);
                            while ($row = mysqli_fetch_assoc($result_query)) {
                                $category_title = $row['category_title'];
                                $category_id = $row['category_id'];
                                echo "<option value='$category_id'>$category_title</option>";
                            }
                            ?>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Brand</label>
                        <select name="product_brands" class="form-select" required>
                            <option value="">Select a brand</option>
                            <?php
                            $select_query = "SELECT * FROM `brands`";

                            $result_query = mysqli_query($con, $select_query);
                            while ($row = mysqli_fetch_assoc($result_query)) {
                                $brand_title = $row['brand_title'];
                                $brand_id = $row['brand_id'];
                                echo "<option value='$brand_id'>$brand_title</option>";
                            }
                            ?>

                        </select>
                    </div>

                   
                    <div class="mb-3">
                        <label for="product_image1" class="form-label">Product Image 1</label>
                        <input type="file" name="product_image1" id="product_image1" class="form-control" required>
                    </div>


                    
                    <div class="mb-3">
                        <label for="product_price" class="form-label">Product Price</label>
                        <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" required>
                    </div>

                  
                    <div class="d-grid mt-4">
                        <button type="submit" name="insert_product" class="btn btn-custom">Insert Product</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>


</body>

</html>