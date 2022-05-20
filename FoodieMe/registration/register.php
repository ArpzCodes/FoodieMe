<?php
session_start();
if(isset($_SESSION['username']))
{
    header("location:welcome.Php");
    exit;
}

require_once "config.php";

$username = $email = $password = $confirm_password = "";
$username_err = $email_err =  $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty(trim($_POST['username']))) {
        $username_err = "Full name cannot be blank";
    } 
    else {
        $username = trim($_POST['username']);
    }

    // Check if email is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Email cannot be blank";
    } else {
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set the value of param username
            $param_email= trim($_POST['email']);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken";
                    echo $email_err;
                } else {
                    $email = trim($_POST['email']);
                }
            } else {
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


  
   
 

// Check for password
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = "Password cannot be less than 5 characters";
    } else {
        $password = trim($_POST['password']);
    }

// Check for confirm password field
    if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
        $password_err = "Passwords should match";
    }


// If there were no errors, go ahead and insert into the database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users (username, email, password) VALUES (?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

            // Set these parameters
            $param_username = $username;
            $param_email = $_POST["email"];
            
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            

            // Try to execute the query
            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "Something went wrong... cannot redirect!";
            }
            
        }
        mysqli_stmt_close($stmt);
        
    }
    mysqli_close($conn);
}

?>




















<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css?v=<?php echo time(); ?>" rel="stylesheet">

<link rel="stylesheet" href="registration-css/register.css?v=<?php echo time(); ?>">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodieMe | Sign Up</title>
</head>
<body>
    <div class="nav-bar">
    <a href="index.php"> <img src="logo.png" height="80px" alt="" class="logo"></a>
   <!-- <a href="../index.php"> <img src="images/logo.png" height="80px" alt="" class="logo"></a> -->

        <ul class="nav-links">
            <li> <a href="../index.php"> <button class="home-btn">Home</button> </a></li>
            <li> <a href="/foodieMe/registration/login.php"><button class="log-btn">Login</button></a></li>

        </ul>


    </div>
    <section class="main">
   
    <div class="errors">
    
    </div>


    <div class="w-full max-w-xs">

   
    <form action="" class="log-form bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post"> 

        
<label class="block text-gray-700 text-sm font-bold mb-2" for="username"> Username </label>
<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="username" placeholder="Enter your username"> <br>

<label class="block text-gray-700 text-sm font-bold mb-2" for="email"> Email </label>
<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" name="email" placeholder="Enter your email"> <br>


<label class="block text-gray-700 text-sm font-bold mb-2" for="password"> Enter Password </label>
<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" placeholder="Enter your password"> <br>

<label class="block text-gray-700 text-sm font-bold mb-2" for="confirm_password"> Confirm Password </label>
<input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="confirm_password" placeholder="Confirm your password"> <br> <br>

<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Sign In</button>

</form>
</div>


        <p class="already">*Already Signed Up ? <a href="login.php">Login</a> </p>

    </div>

    </section>
    
</body>
</html>



