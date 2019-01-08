<?php session_start(); 
if (empty($_SESSION['username']))
 header("Location: login.php");
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Login</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="cass.css">

</head>
<body>

<div class="bg"></div>

<nav>
<meta name="viewport" content="width=device-width, initial-scale=1">

<p></p>
    <ul>
        <li><a href="home.php"> Home </a></li>
        <li><a href="gallery.php"> Gallery</a></li>   
        <li><a href="cam.php">CAMERA</a></li>
       <li><a href="#">Edit Profile <i class="arrow down"> </i> </div> </a>
        <ul>
        <li> <a href="update_password.php">Password</a></li>
                    <li> <a href="editUsername.php">Usernames</a></li>
                    <li> <a href="editMail.php">Change Email</a></li>
                    <li> <a href="mailNotif.php">Mail Notification</a></li>
                    <li> <a href="deleteAcc.php">Delete Account</a></li>
</ul>
        </li>
        <li><a href="logout.php">Logout </a></li>
</nav>

<div class="home"> <h1><?php echo $_SESSION['username'] ;?> welcome to your gallery </h1></div>
<div class="lin"> <p> No pictures? Go to gallery to view more images or <br> camera to take pictures <a href="gallery.php">view more images</a> </p></div>

<?php
session_start();
    require_once('config/database.php');
    $name = $_SESSION['username'];
    $result;
    try{
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("SELECT * FROM `gallery` WHERE username = '". $name ."' ORDER BY upload_date DESC ", PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "ERROR EXECUTING: \n".$e->getMessage();
    }
?>


 <?php

            if($result)
            foreach ($result as $row) {
                ?><div class="me"> <img id="e1" src=<?= $row['img_name']; ?> width="100%" height="auto">
             <button> <a href="delete.php?value=<?php echo $row['img_id'] ;?>"> Delete</a></button>
                <br>
            
            </div>
            <?php
        
            }
            else
            echo "Gallery empty"; ?>
                <?php
        ?>
       
    
       <footer> <div class="footer">Camagru - amokgohl 2018</div></footer>
        </body>
        </html>
