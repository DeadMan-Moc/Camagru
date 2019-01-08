<?php
session_start();
function verify_signup($mail, $username, $password, $ip) {
  include_once 'config/database.php';


  $DB_USER = "root";
  $DB_DSN1= "mysql:host=localhost";
  $db_name = "Camagru";
  $DB_DSN = "mysql:host=localhost;dbname=$db_name";
  $DB_PASSWORD = "123456";
  
  $mail = strtolower($mail);


  try {
          $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $pdo= $dbh->prepare("SELECT * FROM users WHERE Username=? OR Email=?");
          $pdo->execute(array($username, $mail));
          $user_exist = $pdo->rowCount();

          if ($user_exist == 1) {
            $_SESSION['error'] = "Username or Email Already taken";
            return ;
          }
          $pass = hash("whirlpool", $password);

          $query= $dbh->prepare("INSERT INTO users (username, Email, Passwd, token) VALUES (?, ?, ?, ?)");
          $token = uniqid(rand(), true);
          $query->execute(array($username,$mail, $pass,$token));

          varification_email($mail, $username, $token, $ip);
          $_SESSION['signup_success'] = true;
          return (0);
          
    
      } catch (PDOException $e) {
          $_SESSION['error'] = "ERROR: ".$e->getMessage();
}
}


function varification_email($mail, $username, $token, $ip)
{
  
$to      = $mail; // Send email to our user
$subject = ' Camagru Signup | Verification'; // Give the email a subject 

$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
  
Please click this link to activate your account:


http://' .$ip.'verify.php?token='.$token.'
 

'; // Our message above including the link
                     
$headers = 'From:camagruteam@camagru.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

}

?>















