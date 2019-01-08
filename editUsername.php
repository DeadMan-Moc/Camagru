<?php session_start();
if (empty($_SESSION['username']))
{
    $_SESSION['er'] = "Need to be logged in to edit usernames";
    header("Location: login.php");
}?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> UpdateUser </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>

<nav>
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
</ul>
    
</nav>


    <div class="header">
    
    <h2>Update Username</h2>
</div>
<form method="post" action="usernames.php">
        <div class="input-group">
        <label>Old Username</label>
        <input type="text" name="oldUsername" placeholder="old Username" required>
</div> 
   
<div class="input-group">
    <label> New Username </label>
    <input type="text" name="newUsername" placeholder="New Username" required >
</div>     

<div class="input-group">
    <button  type="submit"  class="btn" name="UpdateUser">Update Username</button>
</div>
   
    <?php
					if(isset($_SESSION['t'])){
                        echo $_SESSION['t'];
					$_SESSION['t'] = null;
					}
                    ?>
   



</form>



</body>

</html>
<?PHP include ('footer.php');?>