<?php
    // if   ( $_SESSION["loggedin"] = true){

    //Redirect user to welcome page
                            // header("location: registration/welcome.php");
    // }

?> 

<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">

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
   <a href="index.php"> <img src="images/logo.png" height="80px" alt="" class="logo"></a>

        <ul class="nav-links">
            <li> <a href="/foodieMe/registration/register.php"><button class="reg-btn">Register</button></a></li>
            <li> <a href="/foodieMe/registration/register.php"><button class="log-btn">Login</button></a></li>
            

        </ul>


    </div>
    <section class="main">
        <div class="content">
            <div class="landing-msg"> 
                <div class="first">                           
                  Welcome to FoodieMe <p> I heard that you have not signed up :(
            </p>
            </div>  
            <a href="/foodieMe/registration/register.php"><button class="btn-land">
                 Get Started
            </button></a> 
            <p class="already">*Already Signed Up ? <a href="login.php">Login</a> </p>
        </div>

    </section>
    
</body>
</html>