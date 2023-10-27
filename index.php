<?php
// Database configuration
require('connect.php');
// Fetch books from the database
$sql = "SELECT title, author, price, image FROM books WHERE status = 'B'";
$result = $conn->query($sql);

$search = '';

// Check if the search form is submitted
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    
    // Construct the SQL query based on the search
    $sql_sell = "SELECT title, author, price, image FROM books WHERE title LIKE '$search%' OR category Like '$search' AND status = 'B'";
    $sql_read = "SELECT title, author, price, image FROM books WHERE title LIKE '$search%' OR category Like '$search' AND status = 'B'";
    // Execute the query
    $result = $conn->query($sql_sell);
    $result1 = $conn->query($sql_read);
} else {
    // If search is not provided, fetch all books
    $sql = "SELECT title, author, price, image FROM books WHERE status = 'B'";
    $result = $conn->query($sql);
}
    $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>ReaderNeeds - Home</title>
  <link rel="stylesheet" type="text/css" href="buybook.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</head>
<body>
  <header>
    <h1>Welcome to ReaderNeeds</h1>
    <h2>
      <?php
      session_start();
      if (isset($_SESSION['user'])) {
          echo '<a href="profile.php" style="color: black;">View Your Profile</a>';
      }
      ?>
      </h2>
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
              <a href="blog.php" class="dropbtn">BookClub</a>
              <div class="dropdown-content">
                <a href="bprofile.php">Profile</a>
                <a href="exchange.php">Donate/Exchange</a>
                <a href="contact.php">Chats</a>
                
              </div>
            </li>
        <?php
        if (!isset($_SESSION['user'])) {
            echo '<li class="right-corner"><a href="signup.html" class="button">Sign Up/Login</a></li>';
        } else {
            echo '<li class="right-corner"><a href="log_out.php" class="button">Log Out</a></li>';
        }
        ?>
      </ul>
    </nav>
  </header>
  
  <!-- Section 1: Books on Sale -->
    <h1>Books on Sale</h1>
    <div class="section">
    <div class="books-slider">
    <?php
    // Assume $result is the result set containing books from the database
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $title = $row['title'];
            $author = $row['author'];
            $price = $row['price'];
            $image = $row['image'];
    ?>
    <div class="book">
      <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
      <h1><?php echo $title; ?></h1>
      <p>Author: <?php echo $author; ?></p>
      <p>Price: $<?php echo $price; ?></p>
    </div>
    <?php
        }
    } else {
        echo "No books found in the database.";
    }
    ?>
  </div>
  <div class="center-button">
        <button class="button-read"><a href="get_books.php">Buy Book</a></button>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.books-slider').slick({
            // Slick Slider options and settings
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1, 
            autoplay: true, 
            autoplaySpeed: 2000, 
        });
    });
</script>

<!-- Section 2: Old Books for Sale -->
    <h1>Read Free book From the Library</h1>
   <div class="section">
    <div class="books-slider">
      <?php
             require('connect.php');
             $sql = "SELECT title, author, price, image FROM books WHERE status = 'R'";
             $result = $conn->query($sql);
            // Fetch books from the database
            if ($result === false) {
                echo "Error executing the query: " . $conn->error;
            } elseif ($result->num_rows > 0) {
                // Process the query result as before
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="book">';
                    echo '<img src="' . $row["image"] . '" alt="' . $row["title"] . ' Cover">';
                    echo '<h3>' . $row["title"] . '</h3>';
                    echo '<p>Author: ' . $row["author"] . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No books for sale yet.</p>';
            }
            $conn->close();
            ?>
      </div>
      <div class="center-button">
        <button class="button-read"><a href="readBook.php">Read Book</a></button>
    </div>
    </div>

  
  <footer>
    <p>Contact us at support@readerneeds.com</p>
  </footer>
</body>
</html>
