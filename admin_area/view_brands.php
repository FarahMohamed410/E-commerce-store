<?php
include('../include/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Categories</title>
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
        <h1 class="text-center">All Categories</h1>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-info">
                        <tr>
                            <th>#</th>
                            <th>Brand Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        <?php
                        $get_query = "SELECT * FROM `brands`";
                        $result = mysqli_query($con, $get_query);
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $brand_id = $row['brand_id'];
                            $brand_name = $row['brand_title'];
                            $count++;
                        ?>
                            <tr>
                                <td> <?= $count ?></td>
                                <td> <?= $brand_name ?></td>
                                <td>
                                    <form method="POST" action="delete_brands.php" onsubmit="return confirm('Are you sure you want to delete this brand?');">
                                        <input type="hidden" name="brand_id" value="<?= $brand_id ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>