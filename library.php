<?php
require('connect.php');
$sql = "SELECT * FROM books where status = 'R'";
$result = $conn->query($sql);
$sql = "SELECT * FROM books where status = 'B'";
$result1 = $conn->query($sql);


$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    
    $sqlSearch = "SELECT title, author, price, image FROM books WHERE title LIKE '$search%' OR category Like '$search%'";

    $resultSearch = $conn->query($sqlSearch);
    
    if ($resultSearch === false) {
        die("Error executing the search query: " . $conn->error);
    }
    if ($resultSearch->num_rows > 0) {
        $result = $resultSearch;
    }
} else {
    if ($result === false) {
        die("Error executing the initial query: " . $conn->error);
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>ReaderNeeds - Library</title>
  <link rel="stylesheet" type="text/css" href="buybook.css">
  <!-- Add Slick Slider CSS and JS files -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</head>
<body>
  <header>
    <h1>Welcome to ReaderNeeds</h1>
    <!-- User Profile Icon -->
    <main>
      <!-- Your main content here -->
      <p>Welcome to ReaderNeeds library. Read books or Rent It of you need!</p>

      <!-- Add a link/button to the user profile page -->
      <h2>
      <?php
      session_start();
      if (isset($_SESSION['user'])) {
          echo '<a href="profile.php" style="color: black;">View Your Profile</a>';
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
  
    <h1>Read Books</h1>
   <div class="section">
    <div class="books-slider">
        <?php
        // Assume $result is the result set containing books from the database
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $title = $row['title'];
                $author = $row['author'];
                $image = $row['image'];
                $file = $row['file'];
                ?>
                <div class="book">
                    <!-- Add Read Books Slides Here -->
                    <div class="slide">
                        <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
                        <h1><?php echo $title; ?></h1>
                        <p>Author: <?php echo $author; ?></p>
                    </div>
                    <!-- Add more slides as needed -->
                </div>
                <?php
            }
        } else {
            echo "No books found in the database.";
        }
        ?>
    </div>
    <div class="center-button">
        <button class="button-read"><a href="readBook.php">Read Book</a></button>
    </div>
</div>
    <h1>Rent Books</h1>
    <!-- Rent Books Section -->
    <div class="section">
    <div class="books-slider">
        <?php
        // Assume $result is the result set containing books from the database
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $title = $row['title'];
                $author = $row['author'];
                $image = $row['image'];
                ?>
                <div class="book">
                    <!-- Add Read Books Slides Here -->
                    <div class="slide">
                        <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
                        <h1><?php echo $title; ?></h1>
                        <p>Author: <?php echo $author; ?></p>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No books found in the database.";
        }
        ?>
    </div>
    <div class="center-button">
        <button class="button-read"><a href="rentBook.php">Rent Book</a></button>
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

</body>
<footer>
    <p>Contact us at support@readerneeds.com</p>
  </footer>
</html>
