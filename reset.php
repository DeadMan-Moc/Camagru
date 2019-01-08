<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> Reset </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
<div class="bg"></div>
<header>
<nav>
<meta name="viewport" content="width=device-width, initial-scale=1">
<p><?php echo CAMAGRU ; ?> </p>
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
</header>
	
<div class="reset">

	
	</div>	
	<form method="post" action="forgot.php">
		<div class="Reset-Email">
		<div class="input-group">
       <label>Email</label>
       <input type="text" name="Email" placeholder="Email" required>
</div>
		</div>
		<div class="cd">
			<button type="submit" name="submit" class="btn">Submit</button>
		</div>
		<div class="ef">
		<span>
			<h4>
					</h4>
		</span>
		<?php
					if(isset($_SESSION['success'])){
                        echo $_SESSION['success'];
					$_SESSION['success'] = null;
					}else{
						echo $_SESSION['err'];
					$_SESSION['err'] = null;
					}
				?>	
		<p>
			Not yet a member ?<a href="index.php">Join now</a>
		</p>
	</div>
	</form>
	</div>
</body>
    <footer> <div class="footer">Camagru - amokgohl 2018</div></footer>
</html>
