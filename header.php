<head>
  <title>ReaderNeeds - Home</title>
  <link rel="stylesheet" type="text/css" href="css/exchange.css">
  <link rel="stylesheet" type="text/css" href="css/buybook.css">
  <link rel="stylesheet" type="text/css" href="css/bookclub.css">
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
              <a href="javascript:void(0);" class="dropbtn">BookClub</a>
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
        } else {
            echo '<li class="right-corner"><a href="log_out.php" class="button">Log Out</a></li>';
        }
        ?>
      </ul>
    </nav>
  </header>