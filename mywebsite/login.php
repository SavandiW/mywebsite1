<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Agbalumo&family=Anek+Odia:wght@100..800&family=Merienda:wght@300..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">

    <title>Login</title>
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
            <a href="shopping.php" class="icon"><i class="fas fa-shopping-cart"></i></a>
        </nav>
    </header>

    <div class="image-banner">
        <img src="loginimg.png" alt="Delicious cakes">
    </div>
    <div class="login-form">
        <h1>WELCOME</h1>
        <p>Create an account to run wild through our curated experiences</p>
       <?php
       if (isset($_POST["login"])){
         $email=$_POST["email"];
         $password=$_POST["password"];
         require_once "database.php";
         $sql = "SELECT * FROM signin WHERE email = '$email'";
         $result = mysqli_query($conn,$sql);
         $user=mysqli_fetch_array($result,MYSQLI_ASSOC);
         if($user){
          if (password_verify($password,$user["password"])){
            session_start();
            $_SESSION["user"]="yes";
              header("Location: index.php ");
              die();
           } else{
            echo "<div class='alert alert-danger'>password does not match</div>";
          }

         }else{
            echo"<div class='alert alert-danger'>Email does not match</div>";
         }
       }
       ?>
        <form action="login.php" method="post">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="Enter Email" >
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" >
            <button type="submit" class="login-btn" name="login" >Login</button >
            <p>Don't you have an account? <a href="signIn.php">Sign up</a></p>
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
        Privacy policy | Refund Policy | All rights Reserved. since 2021
    </div>
</body>
</html>
