<?php session_start();
if (empty($_SESSION['username']))
{
    $_SESSION['er'] = "need to be logged in to change email notifications settings";
    header("Location: login.php");
}?>
<!DOCTYPE html>
<html>

    <head>
   
        <title> Login </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>

<nav>
<p> Camagru  </p>
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
</ul>
        </li>
        <li><a href="logout.php">Logout </a></li>
</ul>
    
</nav>
<form action="notif.php" method="post">
  <p><h3>Do You want to recieve notifications from comments <h3></p>
  <input type="radio" name="check" value="Yes"> Yes <br>
  <input type="radio" name="check" value="No"> No
  <p><input type="submit" name="submit" value="submit"></p>

<?php
					if(isset($_SESSION['notif'])){
                        echo $_SESSION['notif'];
					$_SESSION['notif'] = null;
					}
                    ?>
<hr>
<?PHP 
include ('footer.php');?>
</form>
</body>
</html>