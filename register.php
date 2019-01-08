<?php 

include('connect.php');
$Username = $_POST['Username'];
$Email = $_POST['Email'];
$Passwrd = $_POST['Passowrd'];
$CPassword = $_POST['Confirm_Password'];
$flname = hash('whirlpool', $Password);

$sql = "INSERT INTO `Camagru`.`Users` (`Username`,`email`, Passwrd`)
VALUES ('$Username','$email', '$password');";
$conn->exec($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Register </title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
  	<h1>register</h1>
  </div>
<form method="post" action="register.php">
    <?php include ('errors.php'); ?>
       <div class="input-group">
        <label>Username</label>
        <input type="text" name="Username" placeholder="Username" required>
</div> 
   <div class="input-group">
       <label>Email</label>
       <input type="text" name="Email" placeholder="Email" required>
</div>
<div class="input-group">
    <label> Password </label>
    <input type="text" name="Password" placeholder="Password" required>
</div>
<div class="input-group">
    <label>Confirm_Password</label>
    <input type="text" name="confirm_Password" placeholder="Confirm Password" required>
</div>
<div class="input-group">
    <button  type="submit"  class="btn" name="Register" >Register</button>
</div>
<p>
    Already a registered? <a href="login.php">Sign in</a>
</p>
</form>
</body>
</html>


    
         
