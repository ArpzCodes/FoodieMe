<?php




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="app-css/cook.css?v=<?php echo time();?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cook</title>
</head>
<body>
<div class="nav-bar">
   

        <ul class="nav-links">

           
            <li class="l"> <a href="../registration/welcome.php">Home</a></li>
            <li> <a href="create_post.php">Create Post</a></li>
            <li> <a href="../registration/logout.php">Logout</a></li>
        </ul>
</div>


</div>
<h1>Cook</h1>
  <input type="text" placeholder="Enter Food Name" id="searchInput">
  <div id="results"></div>

  <script src="cook.js"></script>


</body>
</html>