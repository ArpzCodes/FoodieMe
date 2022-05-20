<?php
session_start();

require_once "config.php";
$sql = "SELECT * FROM posts";
$result=mysqli_query($conn,$sql);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    
      foreach ($result as $row) { 
    $likes= $row["likes"] + 1;
    

// If there were no errors, go ahead and insert into the database
    $uploader = $row["username"];
  
    
        $sql = "UPDATE posts SET likes=? WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
      
        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "is", $param_likes, $param_uploader);
            

            // Set these parameters
            $param_uploader = $uploader;
            $param_likes = $likes;
            

            // Try to execute the query
            if (mysqli_stmt_execute($stmt)) {
                header("location: feed.php");
            } else {
                echo "Something went wrong... cannot redirect!";
            }
            
        }
        mysqli_stmt_close($stmt);
        
    }
}
    mysqli_close($conn);




?>


<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="app-css/feed.css?v=<?php echo time();?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
</head>
<body>

    <div class="nav-bar">
   

        <ul class="nav-links">

           
            <li> <a href="../registration/welcome.php">Home</a></li>
            <li> <a href="create_post.php">Create Post</a></li>
            <li> <a href="../registration/logout.php">Logout</a></li>
        </ul>
</div>

    
        <div class="posts">
            
            <?php  foreach ($result as $row) { ?>
            <div class="username">@<?php echo$row["username"]?></div>

            <div class="id"><?php echo$row['id']?></div>
            <div class="image"><img src="upload/<?php echo $row['image']?>" height= "400px" width="750px"></div>
            <div class="caption font-bold dark:text-white"><?php echo $row['caption']?></div>
            
            <form action="" method="post">
                
            <button type="submit" class="btn bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded" value="like">Like</button> <span><?php echo $row['likes']?></span>
            
            </form>
            
            <br><br><br><br>
            

    <?php } ?>

            </div>
        
        </div>
        
        
    
    
</body>
</html>