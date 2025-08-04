<?php
include('../include/connect.php');


if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $delete = "DELETE FROM contact_table WHERE contact_id = '$id'";
    $res = mysqli_query($con, $delete);
    header("Location:index.php?messages");
    exit();
}

if (isset($_GET['read'])) {
    $id = intval($_GET['read']);
    $read = "UPDATE contact_table SET is_read = 1 WHERE contact_id = '$id'";
    $res = mysqli_query($con, $read);
    header("Location:index.php?messages");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Messages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            background-color: #f9f9f9;
        }

        .container {
            width: 90%;
            margin: 50px auto;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: right;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .empty {
            text-align: center;
            color: black;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>📬 All Messages</h2>

        <?php
        $get_message = "SELECT * FROM contact_table ORDER BY message_date DESC";
        $result = mysqli_query($con, $get_message);

        if (mysqli_num_rows($result) > 0) {
        ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Sending Date</th>
                        <th>Status</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['contact_id'] ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['phone_number']) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['message_text'])) ?></td>
                            <td><?= $row['message_date'] ?></td>
                            <td>
                                <?php if ($row['is_read']): ?>
                                    <span style="color: green;" title="seen">
                                        <i class="fas fa-eye"></i> Seen
                                    </span>
                                <?php else: ?>
                                    <span style="color: red;" title="unseen">
                                        <i class="fas fa-eye-slash"></i> Unseen
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if (!$row['is_read']): ?>
                                    <a href="user_messages.php?read=<?= $row['contact_id'] ?>" title="Mark as Seen" style="margin-left: 8px; text-decoration: none; color: #007bff;">
                                        <i class="fas fa-envelope-open"></i>
                                    </a>
                                <?php endif; ?>

                                <a href="user_messages.php?delete=<?= $row['contact_id'] ?>"
                                    onclick="return confirm('Are you sure you want to delete this message?');"
                                    title="Delete Message" style="margin-left: 8px; text-decoration: none; color: #dc3545;">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php
        } else {
            echo "<p class='empty'>There are no messages right now.</p>";
        }
        ?>
    </div>

</body>

</html>