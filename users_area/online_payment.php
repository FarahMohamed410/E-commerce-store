
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title> Payment Page</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f4;
      padding: 50px;
      text-align: center;
    }
    .box {
      background: white;
      width: 400px;
      margin: auto;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 10px #ccc;
    }
    input, button {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
    }
    button {
      background-color: #27ae60;
      color: white;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>

<div class="box">
  <h2>Pay Now</h2>
  <form action="gateway.php" method="post">
    <input type="text" name="name" placeholder="Name on Card" required>
    <input type="number" name="amount" placeholder="Amount (EGP)" required>
    <input type="text" name="card" placeholder="Card Number" required>
    <input type="text" name="expiry" placeholder="MM/YY" required>
    <input type="text" name="cvv" placeholder="CVV" required>
    <button type="submit">Pay</button>
  </form>
</div>

</body>
</html>
