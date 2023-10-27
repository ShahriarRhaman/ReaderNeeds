<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SellBook - Sell Used Books</title>
    <link rel="stylesheet" type="text/css" href="sellbook.css">
    
</head>
<body>
     <header>
    <h1>Welcome to ReaderNeeds</h1>
    <!-- User Profile Icon -->
    <main>
    <!-- Your main content here -->
    <p>Buy And Sell Your Old Book!</p>

    <!-- Add a link/button to the user profile page -->
    <h2>
      <?php
      session_start();
      if (isset($_SESSION['user'])) {
          echo '<a href="profile.php" style="color: black;">View Your Profile</a>';
          $user = $_SESSION['user'];
          $id = $user['user_id'];
      }
      ?>
      </h2>
  </main>
        <!-- End of User Profile Icon -->
    <nav>
      <ul class="main-menu">
        <!-- Navigation Links -->
        <li><a href="index.php">Home</a></li>
        <li class="dropdown">
          <a href="library.php" class="dropbtn">Library</a>
          <div class="dropdown-content">
            <a href="readBook.php">Read Book</a>
            <a href="rentBook.php">Rent Book</a>
          </div>
        </li>
        <li><a href="get_books.php">Buy</a></li>
        <li><a href="SellBook.php">Sell</a></li>
        <li class="dropdown">
          <a href="javascript:void(0);" class="dropbtn">Book Clubs</a>
          <div class="dropdown-content">
          <a href="blog.php">Blog</a>
                <a href="bprofile.php">Profile</a>
                <a href="exchange.php">Donate/Exchange</a>
                <a href="contact.php">Chats</a>
          </div>
        </li>
        <?php
        if (!isset($_SESSION['user'])) {
            echo '<li class="right-corner"><a href="signup.html" class="button">Sign Up/Login</a></li>';
        }else {
            echo'<li class="right-corner"><a href="log_out.php" class="button">log out</a></li>';
        }
        ?>
      </ul>
    </nav>
  </header>
    <div class="container">
        <div class="post-form">
            <h2>Create a New Post</h2>
            <form action="sell_post.php" method="post" enctype="multipart/form-data">
                <label for="title">Book Title:</label>
                <input type="text" id="title" name="title" required>
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required>
                <label for="condition">Condition:</label>
                <input type="text" id="condition" name="condition" required>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>
                <label for="Book-picture">Book Picture:</label>
                <input type="file" id="book-picture" name="book-picture"><br>
                <button type="submit">Post for Sale</button>
            </form>
        </div>

        <div class="book-list">
            <h1>Use Books for Sale</h1>
            <section id="book-list">

            
<?php
require('connect.php');

// Fetch books from the database
$result = $conn->query("SELECT * FROM books where status = 'S'");
if ($result === false) {
    echo "Error executing the query: " . $conn->error;
} elseif ($result->num_rows > 0) {
    // Process the query result as before
    while ($row = $result->fetch_assoc()) {
      $R_id = $row['user_id']; 
      
        echo '<div class="book">';
        echo '<img src="' . $row["image"] . '" alt="' . $row["title"] . ' Cover">';
        echo '<h3>' . $row["title"] . '</h3>';
        echo '<p>Author: ' . $row["author"] . '</p>';
        echo '<p>Condition: ' . $row["condition"] . '</p>';
        echo '<p>Price: $' . $row["price"] . '</p>';
        if($R_id != $id){
          echo '<form action="contact.php" method="POST"><input type="text" class="pass" name="R_id" value='.$row["user_id"].'><button name="contact" >Contact Seller</button></form>';  
        }
        else{
          echo '<form action="delete_sell.php" method="POST"><input type="text"  class="pass" name="del" value='.$row["b_id"].'><button name="delete" >Delete</button></form>';

        }
        
        echo '</div>';
      
    }
} else {
  
    echo '<p>No books for sale yet.</p>';
}

// Close the database connection
$conn->close();
?>


     
    </div>
    </div>
    </div>
    <footer style="background-color: #6B12A6; color: #fff; text-align: center; padding: 10px;">
    <p>Contact us at support@readerneeds.com</p>
  </footer>
</body>
</html>
