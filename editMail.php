<?php session_start();
if (empty($_SESSION['username']))
{
    $_SESSION['er'] = "Need to be logged in to change Email";
    header("Location: login.php");
}?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> UpdateMail </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
<div class="bg"></div>
<nav>
<meta name="viewport" content="width=device-width, initial-scale=1">
<p> Camagru               <?php echo $_SESSION['username'] ; ?> </p>
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
</nav>


<div class="header">
    
   	<h2>Update Mail</h2>
  </div>

<form method="post" action="updateMail.php">
        <div class="input-group">
        <label>Old Email</label>
        <input type="text" name="oldMail" placeholder="old Email" required>
</div> 
   
<div class="input-group">
    <label> New Email</label>
    <input type="text" name="newMail" placeholder="New Email"  required >
       

<div class="input-group">
    <button  type="submit"  class="btn" name="UpdateMail">Update Email</button>
</div>

    <?php
					if(isset($_SESSION['y'])){
                        echo $_SESSION['y'];
					$_SESSION['y'] = null;
					}
                    ?>
   



</form>
<hr>
<?PHP 
include ('footer.php');?>
</body>
</html>
