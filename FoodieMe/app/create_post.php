<?php
session_start();
require_once "config.php";

// Define variables and initialize with empty values
$caption = "";
$caption_err =  "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Validate first name
    $input_caption = trim($_POST["caption"]);
    if (empty($input_caption)) {
        $caption_err = "Please enter  caption.";
        echo "Please enter caption.";

    } 
     else {
        $caption = $input_caption;
    }






    if (empty($caption_err_err) ) {
// Prepare an insert statement

        $temp_name=$_FILES['image']['tmp_name'];
        $filename=$_FILES['image']['name'];
        $folder = "upload/".$filename;
        if (move_uploaded_file($temp_name, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
        }

        $sql = "INSERT INTO posts (username,caption,image,likes) VALUES (?, ?,?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $username, $caption,$filename,$likes);

            // Set parameters

            $username = $_SESSION["username"];
            $caption = trim($_POST['caption']);
            $filename=$_FILES['image']['name'];
            $likes = 0;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                header("location: feed.php");
            } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
            }
        } else {
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
        }

// Close statement
        mysqli_stmt_close($stmt);

// Close connection
        mysqli_close($conn);
    }
}
?>


<!doctype html>
<html lang="en">
<head>
<link rel="stylesheet" href="app-css/cook.css?v=<?php echo time();?>">
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="app-css/feed.css?v=<?php echo time();?>">
    <title>Form</title>
</head>
<body>
<div class="nav-bar">
<a href="../registration/welcome.php"><img src="logo.png" height="60px" alt="" class="logo"></a>


<ul class="nav-links">
    <li> <a href="cook.php"> Cook </a></li>
    <li> <a href="feed.php"> Feed </a></li>
    <li> <a href="../registration/logout.php"> Logout </a></li>


</ul>


</div>
<div class="create-post w-full max-w-xs">
<form  class=" bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 action="" method="post" enctype="multipart/form-data">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Upload Image</label>
    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="file" placeholder="Upload Image" name="image" required>

    <label class="block text-gray-700 text-sm font-bold mb-2" for="caption">Caption</label>
    
    <input  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Your Caption" name="caption" > <br> <br>

    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="Submit">
  
   
</form>
</div>

</body>
</html>