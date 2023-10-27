<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    
    .checkout-form {
      background-color: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
      width: 450px;
    }
    
    .checkout-form label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    
    .checkout-form input[type="text"],
    .checkout-form input[type="email"],
    .checkout-form input[type="tel"],
    .checkout-form textarea {
      width: 75%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    
    .checkout-form button {
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      cursor: pointer;
    }
    
    .checkout-form button:hover {
      background-color: #0056b3;
    }
  </style>

<?php
session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
  }
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve cart items and total from the GET data
    $cartItemsJson = urldecode($_GET['cartItems']);
    $total = urldecode($_GET['total']);
    $decodedCartItems = json_decode($cartItemsJson, true);
}
?>

</head>
<body>
  <div class="checkout-form">
    <h2>Checkout</h2>
    <form action="checkout.php" method="post">
      <label for="userName">User Name:</label>
      <input type="text" id="userName" name="userName" value="<?php echo $user['user_name'] ?>" readonly>
      
      <label for="userEmail">User Email:</label>
      <input type="email" id="userEmail" name="userEmail" value="<?php echo $user['email']; ?>" readonly>
      
      <label for="phoneNumber">Phone Number:</label>
      <input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo $user['phone_number']; ?> " readonly>
      
      <label for="address">Address:</label>
      <input type="text" id="address" name="address" required>

      <label for="items">Items:</label>
       <textarea name="items" readonly>
<?php
    foreach ($decodedCartItems as $index => $item) {
        echo ($index + 1) . '. ' . $item['title'] . "\n";
    }
?>
</textarea>
      <label for="Total Amount">Total Amount:</label>
      <input type="text" id="Total Amount" name="Total Amount" value="<?php echo "$total" ?>" readonly>

      <label for="note">Note:</label>
      <textarea id="note" name="note"></textarea>

      <button type="submit">Submit Order</button>
    </form>
  </div>
</body>
</html>
