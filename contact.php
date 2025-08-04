<?php 
include('include/connect.php');
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $phone=$_POST['number'];
    $message=$_POST['message'];
    $insert_query ="INSERT INTO `contact_table`(`name`, `phone_number`, `message_text`) VALUES ('$name','$phone','$message')";
    $result=mysqli_query($con,$insert_query);
    if($result){
        echo "<script>alert('your message is sent successfully , we will contact with you soon');window.open('index.php')</script>";
    }
    else{
        echo "<script>alert(' something went wrong try again please')</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
     <style>
        .back-button{
            width: 100%;
            padding: 10px;
            background: #fafffbff;
            border: none;
            color: white;
            font-size: 16px; 
        }
        .back-button:hover{
           background: #f9fafaff; 
        }
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            background-color: #f2f2f2;
        }

        .contact_us_form {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .contact_us_form h2 {
            text-align: center;
        }

        .contact_us_form input,
        .contact_us_form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        .contact_us_form button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            border: none;
            color: white;
            font-size: 16px;
        }

        .contact_us_form button:hover {
            background: #218838;
        }

        .client_service {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .client_service h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .client_service a {
            color: #007bff;
            text-decoration: none;
            display: block;
            margin: 5px 0;
        }

        .socialmedia-links a {
            display: inline-block;
            margin-right: 10px;
            text-decoration: none;
            font-weight: bold;
        }

        .socialmedia-links a:hover {
            color: #0056b3;
        }

        .fa {
            margin-left: 8px;
        }
    </style>
</head>
<body>
    <div class="contact_us_form" >
    <form method="POST" action="">
        <input type="text" name="name" placeholder="name" required>
           <input type="text" name="number" placeholder="phone number" required>
              <textarea type="text" name="message" placeholder="please leave your message here" required></textarea>
              <button type="submit" name="submit"><i class="fa fa-paper-plane"></i>send</button>
            
    </form>
    <div class="back-button">
     <center><a href="index.php" class="btn btn-success">Back to home page</a></center>
     </div>
    <div class="client_service">
     <h3>contact us</h3>
            <a href="https://wa.me/201017172115" target="_blank">
                <i class="fab fa-whatsapp"></i> whatsapp:01017172115 
            </a>
            <a href="mailto:farahmohamedahmed976@gemail.com">
                <i class="fa fa-envelope"></i> gmail:farahmohamedahmed976@gmail.com
            </a>
            <h3 style="margin-top: 20px;">follow us</h3>
            <div class="socialmedia-links">
                <a href="https://www.facebook.com/farah.m.ahmed.187436" target="_blank">
                    <i class="fab fa-facebook"></i> Facebook
                     <a href="https://www.linkedin.com/in/farah-mohamed-159100351?trk=contact-info" target="_blank">
                    <i class="fab fa-linkedin"></i> LinkedIn
                </a>
               
                  </div>
        </div>
    </div>
</body>
</html>