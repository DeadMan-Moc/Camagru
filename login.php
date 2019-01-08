<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> Login </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>


  <div class="bg"></div>
  <header>
  <div class="topnav">
<nav>
<meta name="viewport" content="width=device-width, initial-scale=1">
<p></p>
    <ul>
        <li><a href="home.php"> Home </a></li>
        <li><a href="gallery.php"> Gallery</a></li>  
        <li><a href="index.php">Register </a></li>
</nav>
</div> 
</header>

<div class="header">
    
    <h2> Camagru Login</h2>
</div>
<form method="post" action="signin.php">
        <div class="input-group">
        <label>Username</label>
        <input type="text" name="Username" placeholder="Username" required >
</div> 
   
<div class="input-group">
    <label> Password </label>
    <input type="password" name="Password" placeholder="Password" required />
        
</div>


    <label>

    <div class="input-group">
    <button  type="submit"  class="btn" name="Login"> Login</button>
</div>
    <?php
					if(isset($_SESSION['er'])){
                      ?> <p style ="color:red; font-style:italics;"> <?php echo $_SESSION['er']; ?></p>
					<?php $_SESSION['er'] = null;
					}
                    ?>
   

<p>
   Forgot Password? <a href="reset.php">Reset</a>
</p>

</form>
  <footer> <div class="footer">Camagru - amokgohl 2018</div></footer>
</body>
</html>


    
    