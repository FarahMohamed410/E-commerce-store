<?php
include('include/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search Results</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  
  <style>
    body {
      background-color: #f8f9fa;
    }

    .product-card {
      border: none;
      border-radius: 10px;
      transition: transform 0.2s ease-in-out, box-shadow 0.2s;
    }

    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .card-title {
      font-size: 1.2rem;
      font-weight: 600;
    }

    .price-tag {
      color: #28a745;
      font-weight: bold;
    }

    .search-heading {
      font-size: 2rem;
      font-weight: bold;
      color: #343a40;
    }

    .no-results {
      font-size: 1.3rem;
      color: #dc3545;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <h2 class="mb-4 search-heading">Search Results</h2>
  <div class="row">
    <?php
    if (isset($_GET['search_data']) && !empty($_GET['search_data'])) {
        $search_data = $_GET['search_data'];
        $search_query = "SELECT * FROM `products` WHERE product_keywords LIKE '%$search_data%'";
        $result_query = mysqli_query($con, $search_query);

        if (mysqli_num_rows($result_query) == 0) {
            echo "<div class='col-12 text-center'><p class='no-results'>No results found for '<strong>$search_data</strong>'</p></div>";
        }

        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];

      echo "
<div class='col-md-4 mb-4'>
  <div class='card product-card h-100'>
    <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
    <div class='card-body d-flex flex-column'>
      <h5 class='card-title'>$product_title</h5>
      <p class='card-text text-muted small' style='height: 60px; overflow: hidden;'>$product_description</p>
      <p class='price-tag'>$$product_price</p>
      <div class='mt-auto d-flex justify-content-between'>
        <a href='cart.php?product_id=" . $row['product_id'] . "' class='btn btn-sm btn-info'><i class='fas fa-cart-plus'></i> Add to cart</a>
        <a href='product_details.php?product_id=" . $row['product_id'] . "' class='btn btn-sm btn-outline-secondary'>View more</a>
      </div>
    </div>
  </div>
</div>";

        }
    } else {
        echo "<div class='col-12'><p class='no-results'>Please enter a search keyword.</p></div>";
    }
    ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

