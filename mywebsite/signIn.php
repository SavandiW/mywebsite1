<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="signIn.css">
    <link href="https://fonts.googleapis.com/css2?family=Agbalumo&family=Anek+Odia:wght@100..800&family=Merienda:wght@300..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">

    <title>signin</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Twisted Cakes Logo">
            <span>Twisted Cakes<br><small>by Savandi </small></span>
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
      <img src="signInimg.png" alt="Delicious cakes">
    </div>
    <div class="signin-form">
      <h1>WELCOME</h1>
      <p>Create an account to run wild through our curated experiences</p>
      
      <?php
    if (isset($_POST["submit"])) {

        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $errors = array();

        if (empty($email) || empty($password)) {
            array_push($errors, "All fields are required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        }
        if (strlen($password) < 8) {
            array_push($errors, "Password must be at least 8 characters long");
        }
        
        require_once "database.php";
         $sql= "SELECT * FROM signin WHERE email= '$email'";
         $result= mysqli_query($conn,$sql);
         $rowCount = mysqli_num_rows($result);
         if ($rowCount>0){
            array_push($errors,"Email already exists!");
         }

         if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
          

            // Check again if connection is successful
            if (!$conn) {
            die("<div class='alert alert-danger'>Connection failed: " . mysqli_connect_error() . "</div>");
        }

        $sql = "INSERT INTO signin(email, password) VALUES(?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt=mysqli_stmt_prepare($stmt,$sql);
        if($prepareStmt){
            mysqli_stmt_bind_param($stmt, "ss", $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            echo " <div class='alert alert-success'>you are registered successfully.</div>";
        }else{
            die("something went wrong");
        }
       
        
    }
}
?>



      
      <form action="signIn.php" method="POST">
        <label for="email">E-mail</label>
        <input type="email" id="email" placeholder="Enter Email"  name="email">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Enter password"  name="password">
        <button type="submit" class="signin-btn" name="submit">Sign up</button>
        <p>Do you have an account? <a href="login.php">Log In</a></p>
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
        Privacy policy | Refund Policy | All rights Reserved.since2021
    </div>
  </body>
</html>