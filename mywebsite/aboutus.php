<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="aboutus.css">
  <link href="https://fonts.googleapis.com/css2?family=Agbalumo&family=Anek+Odia:wght@100..800&family=Merienda:wght@300..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
  <title>About Us</title>
</head>
<body>
  <header>
    <div class="logo">
      <img src="logo.png" alt="Twisted Cakes Logo">
      <span>Twisted Cakes<br><small>by Savandi</small></span>
    </div>
    <nav>
      <a href="index.php">Home</a>
      <a href="gallery.php">Gallery</a>
      <a href="shop.php">Shop</a>
      <a href="aboutus.php">About Us</a>
      <a href="signIn.php" class="icon"><i class="fas fa-user"></i></a>
      <a href="#cart" class="icon"><i class="fas fa-shopping-cart"></i></a>
    </nav>
  </header>

  <div class="image-banner">
    <img src="aboutusimg.png" alt="Delicious cakes">
  </div>

  <div class="about-section">
    <h1>About Us</h1>
    <div class="about-section-content">
      <div class="text">
        <p>Since 2022, Twisted Cakes has been bringing sweetness and creativity to celebrations of all kinds. What started as a small passion project has grown into crafting homemade cakes that are as unique as the people who enjoy them.</p>
        <p>At Twisted Cakes, we believe every cake should tell a story. Whether it’s a towering wedding masterpiece or whimsical birthday creation, we strive for elegant dessert perfection. Our mission is to make each cake unforgettable.</p>
      </div>
      <img src="aboutUs.jpg" alt="About Us Image">
    </div>
  </div>

  <div class="contact-container">
    <h2>Contact Us</h2>

    <?php
    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

        require_once "database.php";

        $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Message submitted successfully!'); window.location.href='aboutus.php';</script>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }

        mysqli_close($conn);
    }
    ?>

    <form class="contact-form" action="aboutus.php" method="post">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label for="message">Your Message</label>
      <textarea id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>

      <button type="submit" name="submit">Submit</button>
    </form>
  </div>

  <footer>
    <div class="footer-content">
      <div class="contact-info">
        <div><i class="fas fa-phone"></i><span>(+94)715514841</span></div>
        <div><i class="fas fa-map-marker-alt"></i><span>No,27/4, Wattegama, Kandy.</span></div>
        <div><i class="fas fa-envelope"></i><span>twistedcakes@gmail.com</span></div>
      </div>
      <div class="links">
        <a href="aboutus.php">About Us</a>
        <a href="signIn.php">Sign up</a>
        <a href="login.php">Login</a>
      </div>
      <div class="social-media">
        <p>Follow us on </p> 
        <a href="https://www.instagram.com/twisted.cakes._?igsh=aHg4ajhhYXNmeWRv"><i class="fab fa-instagram"></i></a>
        <a href="https://www.facebook.com/share/1Dxg5MyD9F/?mibextid=wwXIfr"><i class="fab fa-facebook"></i></a>
      </div>
    </div>
  </footer>

  <div class="bottom-bar">
    Privacy policy | Refund Policy | All rights Reserved. Since 2021
  </div>
</body>
</html>
