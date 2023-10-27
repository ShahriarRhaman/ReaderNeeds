<!DOCTYPE html>
<html>
<head>
  <title>Your Profile - ReaderNeeds</title>
  <link rel="stylesheet" type="text/css" href="profile.css">
  <style>
    .edit-profile-section {
      display: none;
    }
  </style>
</head>
<body>
  <header>
     <nav>
      <ul class="main-menu">
        <!-- Navigation Links -->
        <li><a href="index.php">Home</a></li>
        <li><a href="library.php">Library</a></li>
        <li><a href="get_books.php">Buy</a></li>
        <li><a href="SellBook.php">Sell</a></li>
         <li class="dropdown">
              <a href="blog.php" class="dropbtn">BookClub</a>
              <div class="dropdown-content">
                <a href="bprofile.php">Profile</a>
                <a href="exchange.php">Donate/Exchange</a>
                <a href="contact.php">Chats</a>
                
              </div>
            </li>
        <?php
        if (!isset($_SESSION['user'])) {
           echo '<li class="right-corner"><a href="log_out.php" class="button">Log Out</a></li>';
        }
        ?>
      </ul>
    </nav>
  </header>
  <main>
    <section class="profile-section">
      <?php
      
      session_start();
      if (isset($_SESSION['user'])) {
            require('connect.php');
          if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
          }

          $user_id = $_SESSION['user']['user_id'];

          $user_query = "SELECT * FROM user WHERE user_id = $user_id";
          $user_result = mysqli_query($conn, $user_query);
          $user_data = mysqli_fetch_assoc($user_result);

          
          $order_query = "SELECT * FROM book_order WHERE user_id = $user_id";
          $order_result = mysqli_query($conn, $order_query);
          $order_history = array();

          if ($order_result) {
              while ($order_row = mysqli_fetch_assoc($order_result)) {
                  $order_history[] = $order_row;
              }
          }

          
          echo '<img src="' . htmlspecialchars($user_data['image']) . '" alt="Profile Picture">';
          
          
          echo '<h2>Welcome, ' . $user_data['user_name'] . '</h2>';
          echo '<p>Email: ' . $user_data['email'] . '</p>';

          
          echo '<h3>Order History</h3>';
          foreach ($order_history as $order) {
              echo '<p>Order ID: ' . $order['order_id'] . '</p>';
              echo'<p>Items: ' . $order['items'] .'</p>';
              echo'<p>Total Amount: ' . $order['total_amount'] .'</p>'.'<br>';
              // Display other order details as needed
          }

          // Add a button to toggle the edit form
          echo '<button id="edit-profile">Edit Profile</button>';

          mysqli_close($conn);
      } else {
          echo "<p>Please log in to see your profile.</p>";
      }
      ?>
    </section>
    <section class="edit-profile-section">
      <form id="edit-form" action="update_profile.php" method="post" enctype="multipart/form-data">
        <label for="new-name">New Name:</label>
        <input type="text" id="new-name" name="new-name" required><br>

        <label for="new-email">New Email:</label>
        <input type="email" id="new-email" name="new-email" required><br>

        <label for="new-picture">New Profile Picture:</label>
        <input type="file" id="new-picture" name="new-picture"><br>

        <input type="submit" value="Update Profile">
      </form>

    </section>
  </main>
  <footer>
    <p>Contact us at support@readerneeds.com</p>
  </footer>

  <script>
    // JavaScript to toggle the visibility of the edit form
    const editButton = document.getElementById('edit-profile');
    const editFormSection = document.querySelector('.edit-profile-section');

    editButton.addEventListener('click', () => {
      editFormSection.style.display = 'block';
    });
  </script>
</body>
</html>
