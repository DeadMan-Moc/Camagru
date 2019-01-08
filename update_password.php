<?php session_start();
if (empty($_SESSION['username']))
{
    $_SESSION['er'] = "You need to be logged in to change password";
    header("Location: login.php");
}?>

<!DOCTYPE html>
<html>
    <head>
   
        <title> HOME </title>
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

        </li>
</ul>
        <li><a href="logout.php">Logout </a></li>
</ul>
</nav>
<div class="header">
    
    <h2>Update Password</h2>
</div>
<form method="post" action="change_pass.php?">
<div class="input-group">
        <label>Old Password</label>
        <input type="password" name="oPassword" placeholder="Old Password" required>
</div> 
        <div class="input-group">
        <label>Password</label>
        <input type="password" name="Password" placeholder="New Password" required>
</div> 
   
<div class="input-group">
    <label> Confirm Password </label>
    <input type="password" name="cPassword" placeholder="Confirm Password" required>
</div>

<div class="input-group">
    <button  type="submit"  class="btn" name="Update" >Update</button>
</div>
<?php
					if(isset($_SESSION['f'])){
                        echo $_SESSION['f'];
					$_SESSION['f'] = null;
					}
                    ?>
   
</form>
    
    


<footer> <div class="footer">Camagru - gkganakg 2018</div></footer>
</body>

</html>



