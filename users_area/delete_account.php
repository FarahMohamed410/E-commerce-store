<?php
$username = $_SESSION['user_username'];

if (isset($_POST['confirm_delete'])) {
    $delete_query = "DELETE FROM user_table WHERE user_username='$username'";
    $result = mysqli_query($con, $delete_query);

    if ($result) {
        session_destroy();
        echo "<script>alert('your profile is deleted successfully'); window.location.href = '../index.php';</script>";
        exit();
    } else {
        echo "<script>alert('error! try again please');</script>";
    }
}

if (isset($_POST['cancel'])) {
    echo "<script>window.location.href='profile.php';</script>";
}
?>

<div class="container mt-5 text-center">
    <h3 class="text-danger">delete your account?</h3>
    <form method="post">
        <button name="confirm_delete" class="btn btn-danger mt-3">yes,delete</button>
        <button name="cancel" class="btn btn-secondary mt-3">no</button>
    </form>  
</div>
