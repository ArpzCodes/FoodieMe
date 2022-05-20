<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.Php");
}
?>

 <!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="registration-css/welcome.css">
<link rel="stylesheet" href="cssGlob/welcome.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodieMe</title>
</head>
<body>
    <div class="nav-bar">
    <a href="../index.php"><img src="logo.png" height="60px" alt="" class="logo"></a>

        <ul class="nav-links">
            <li> <a href="../app/cook.php">Cook</a></li>
            <li> <a href="../app/feed.php">Feed</a></li>
            <li> <a href="./logout.php">Logout</a></li>
        </ul>


    </div>
    <section class="main">
        <div class="content">
            <div class="landing-msg"> 
                <div class="first">                           
                  Welcome @<?php echo $_SESSION['username'] ?>   <p> We at FoodieMe are happy to have you :D
            </p>
            </div>  

    </section>
    
</body>
</html>