<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rent From</title>
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
    
    .rent-form {
      background-color: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
      width: 450px;
    }
    
    .rent-form label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    
    .rent-form input[type="text"],
    .rent-form input[type="email"],
    .rent-form input[type="tel"],
    .rent-form textarea {
      width: 75%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    
    .rent-form button {
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      cursor: pointer;
    }
    
    .rent-form button:hover {
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
  <div class="rent-form">
    <h2>Rent Form</h2>
    <form action="rent.php" method="post">
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

      <label for="total_amount">Total Amount:</label>
      <input type="text" id="total_amount" name="total_amount" value="<?php echo "$total" + 2 . "$" ?>" readonly>

      <label for="paymentMethod">Payment Method:</label>
    <div id="paymentMethod">
        <label>
            <input type="radio" name="paymentMethod" value="" readonly>
            Credit Card
        </label>
        <label>
            <input type="radio" name="paymentMethod" value="cash" readonly>
            Cash
        </label>
    </div>

      <label for="note">Note:</label>
      <textarea id="note" name="note"></textarea>
      <label for="return_by">Return Option:</label>
    <div id="return_by">
    <label>
        <input type="radio" name="return_by" value="sundarban courier: Name:ReaderNeeds,Phone Number:01745345312, Address: Sector:6,Uttara,Dhaka" readonly>
        sundarban courier
    </label>
    <label>
        <input type="radio" name="return_by" value="SA Paribahan: Name:ReaderNeeds,Phone Number:01745345312, Address: Sector:6,Uttara,Dhaka" readonly>
        SA Paribahan
    </label>
</div>

    <div>
        <input type="checkbox" id="view-policy-link" required>
        <label href="javascript:void(0);" id="view-policy-link">View Library Policy</label>
    </div>
      <button type="submit">Submit Order</button>
    </form>
  </div>
  <script>
    function openPolicyPopup() {
      const policyUrl = 'library_policy.html';
      const policyWindow = window.open(policyUrl, '_blank', 'width=600,height=400');
      if (policyWindow) {
        policyWindow.focus();
      } else {
        alert('Popup window blocked. Please allow pop-ups for this site to view the policy.');
      }
    }
    document.getElementById('view-policy-link').addEventListener('click', openPolicyPopup);
  </script>
</body>
</html>
