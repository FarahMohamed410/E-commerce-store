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
        <h1 class="text-center">All Users</h1>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-info">
                        <tr>
                            <th>#</th>
                            <th>username</th>
                            <th>image</th>
                            <th>email</th>
                            <th>mobile</th>
                            <th>address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $get_users = "SELECT * FROM `user_table`";
                        $result = mysqli_query($con, $get_users);
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $username = $row['user_username'];
                            $image = $row['user_image'];
                            $email = $row['user_email'];
                            $mobile = $row['user_mobile'];
                            $address = $row['user_address'];
                            $count++;
                        ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= $username ?></td>
                                <td><img src='../users_area/user_images/<?= $image ?>' class='user_img'></img></td>
                                <td><?= $email ?></td>
                                <td><?= $mobile ?></td>
                                <td><?= $address ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
</body>

</html>