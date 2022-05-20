<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location:welcome.Php");
    exit;
}
require_once "config.php";
$username = $password = "";
$err = "";
// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){

    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username and password";
        echo $err;
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


    if(empty($err))
    {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;

// Try to execute this statement
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                if(mysqli_stmt_fetch($stmt))
                {
                    if(password_verify($password, $hashed_password))
                    {
// this means the password is correct. Allow user to login
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;

//Redirect user to welcome page
                        header("location: welcome.php");

                    }
                }

            }

        }
    }


}


?>

<!doctype html>
<html lang="en">
<head>
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css?v=<?php echo time(); ?>" rel="stylesheet">
<link rel="stylesheet" href="registration-css/register.css?v=<?php echo time(); ?>">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PHP login system!</title>
</head>
<body>
<div class="nav-bar">
   <a href="../index.php"> <img src="logo.png" height="80px" alt="" class="logo"></a>

        <ul class="nav-links">
            <li> <a href="../index.php"> <button class="home-btn">Home</button> </a></li>
            <li> <a href="register.php"><button class="log-btn">Register</button></a></li>

        </ul>


    </div>







    <hr>
    <div class="log-form w-full max-w-xs">
    <form action="login.php"  class="reg-form bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Username:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="username" id="email" placeholder="Enter Username">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password:</label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" id="password" placeholder="Enter Password"> <br>
        <button class=" btn-form bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" >Submit</button>
    </form>

</div>
</body>
</html>