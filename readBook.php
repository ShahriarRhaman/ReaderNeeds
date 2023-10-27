<?php
require('connect.php');
$sql = "SELECT * FROM books WHERE status = 'R'";
$result = $conn->query($sql);

$search = '';

if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $sqlSearch = "SELECT title, author, price, image, file FROM books WHERE (title LIKE '$search%' OR category LIKE '$search%') AND status = 'R'";
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
  <title>ReaderNeeds - Read Book</title>
  <link rel="stylesheet" type="text/css" href="buybook.css">
</head>
<body>
  <header>
    <h1>Welcome to ReaderNeeds</h1>
    <!-- User Profile Icon -->
    <main>
    <!-- Your main content here -->
    <p>Welcome to ReaderNeeds. Explore our books!</p>

    <!-- Add a link/button to the user profile page -->
    <?php
    session_start();
    if (isset($_SESSION['user'])) {
        echo '<a href="profile.php">View Your Profile</a>';
    }
    ?>
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
<div class="search-container">
    <form method="GET" action="">
      <input type="text" name="search" id="search-input" placeholder="Search by title..." value="<?php echo $search; ?>">
      <button type="submit" id="search-button">Search</button>
      <button type="button" id="clear-search-button">Clear Search</button>
      <script>
        document.addEventListener("DOMContentLoaded", function() {
          const searchInput = document.getElementById("search-input");
          const clearSearchButton = document.getElementById("clear-search-button");
          clearSearchButton.addEventListener("click", function() {
            searchInput.value = "";
            searchInput.closest("form").submit();
          });
        });
      </script>
    </form>
  </div>

  <section id="book-list">
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
      <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
      <h1><?php echo $title; ?></h1>
      <p>Author: <?php echo $author; ?></p>
      <a href="<?php echo $file; ?>" target="_blank" class="button-read">Read</a>
    </div>
    <?php
        }
    } else {
        echo "No books found in the database.";
    }
    ?>
  </section>
  <footer>
    <p>Contact us at support@readerneeds.com</p>
  </footer>
</body>
</html>
