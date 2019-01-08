<?php session_start();
?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> Register </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


  <?php include('head.php');?>

<form method="post" action="changeUsername.php">
        <div class="input-group">
        <label>Old Username</label>
        <input type="text" name="oldUsername" placeholder="old Username" required>
</div> 
   
<div class="input-group">
    <label> New Username </label>
    <input type="text" name="newUsername" placeholder="New Username" required >
       

<div class="input-group">
    <button  type="submit"  class="btn" name="UpdateUser">Update Username</button>
</div>
   
    <?php
					if(isset($_SESSION['er'])){
                        echo $_SESSION['er'];
					$_SESSION['er'] = null;
					}
                    ?>
   

<p>
   Forgot Password? <a href="reset.php">Reset</a>
</p>

</form>
<hr>
<?PHP 
include ('footer.php');?>
</body>
</html>
