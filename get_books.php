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
    
  
    $sql = "SELECT title, author, price, image FROM books WHERE (title LIKE '$search%' OR category LIKE '$search%') AND status = 'B'";
    
    // Execute the query
    $result = $conn->query($sql);
} else {
    $sql = "SELECT title, author, price, image FROM books WHERE status = 'B'";
    $result = $conn->query($sql);
}
    $conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>ReaderNeeds - Buy Book</title>
  <link rel="stylesheet" type="text/css" href="buybook.css">
</head>
<body>
  <header>
    <h1>Welcome to ReaderNeeds</h1>
    <!-- User Profile Icon -->
    <main>
    <!-- Your main content here -->
    <p>Explore our books!</p>

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
      <div class="cart-container" style="color: black;">
        <button class="add-to-cart-button">Add to Cart &#9662;</button>
        <div class="cart-dropdown">
          <ul class="cart-items" id="cart-items">
          </ul>
          <p class="cart-total">Total: $<span id="cart-total-value">0.00</span></p>
          <?php
          if (isset($_SESSION['user'])) {
              echo '<button class="checkout-button" onclick="redirectToCheckoutForm()">Checkout</button>';
          } else {
              echo '<p>Login to proceed to checkout.</p>';
          }
          ?>
        </div>
      </div>
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
            $price = $row['price'];
            $image = $row['image'];
    ?>
    <div class="book">
      <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
      <h1><?php echo $title; ?></h1>
      <p>Author: <?php echo $author; ?></p>
      <p>Price: $<?php echo $price; ?></p>
      <button onclick="addToCart('<?php echo $title; ?>', <?php echo $price; ?>)">Add to Cart</button>
    </div>
    <?php
        }
    } else {
        echo "No books found in the database.";
    }
    ?>
  </section>
  <script>
    // Add your JavaScript functions here
    let cartItems = [];
    let total = 0;

    function addToCart(bookTitle, price) {
        cartItems.push({ title: bookTitle, price: price });
        total += price;
        updateCart();
    }

    function updateCart() {
  const cartItemsElement = document.getElementById('cart-items');
  const cartTotalValueElement = document.getElementById('cart-total-value');
  
  cartItemsElement.innerHTML = ''; // Clear the previous items
  cartItems.forEach(item => {
    const li = document.createElement('li');
    li.textContent = `${item.title} - $${item.price.toFixed(2)}`;
    cartItemsElement.appendChild(li);
  });

  cartTotalValueElement.textContent = total.toFixed(2);
}
function redirectToCheckoutForm() {
    const encodedCartItemsJson = encodeURIComponent(JSON.stringify(cartItems));
    const encodedTotal = encodeURIComponent(total.toFixed(2));
    const redirectTo = `checkout_form.php?cartItems=${encodedCartItemsJson}&total=${encodedTotal}`;
    window.location.href = redirectTo;
}


  </script>
  <footer>
    <p>Contact us at support@readerneeds.com</p>
  </footer>
</body>
</html>
