<?php
session_start();
include('config/database.php');
$_SESSION['err'] = null;

$mail = $_POST['Email'];
try{
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo = $conn->prepare("SELECT * FROM users WHERE Email = ? AND varified = ?");
    $pdo->execute(array($mail, '1'));
    $all = $pdo->fetch(PDO::FETCH_ASSOC);
    $found = $pdo->rowCount();
    

    if ($found == 1)
    {
        
        $pass = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pass = str_shuffle($pass);
        $pass = substr($pass,0, 8);
         

        $user = $all['Username'];
        $url = $_SERVER['HTTP_HOST'] . str_replace("forgot.php", "", $_SERVER['REQUEST_URI']);
        reset_password($mail,$pass, $user, $url);

        $hashed = hash("whirlpool", $pass);
        $pdo = $conn->prepare("UPDATE users SET Passwd = ? WHERE Email = ? AND varified = ?");
        $pdo->execute(array($hashed, $mail, '1'));

        $_SESSION['er'] = "Check Email to change password";
        header('Location: login.php');
        
        exit();
    }
    else
    {
        $_SESSION['err'] = "Email incorrect or not found";
        header('Location: reset.php');
        exit();
    }

}
catch(PDOEXCEPTION $e)
{
    $_SESSION['err'] = "Something went wrong try again later";
    header('Location: reset.php');
    exit();
}

function reset_password($mail,$pass, $user, $ip)
{
 
 $to      = $mail; 
$subject = 'Create New Password'; 

$message = '
Your login credentials are as follows:
------------------------
Username: '.$user.'
Password: '.$pass.'
------------------------ 
Please click this link to login into your account:

http://'.$ip.'login.php



'; 
                     
$headers = 'From:camagruteam@camagru.com' . "\r\n";
mail($to, $subject, $message, $headers); 
}
?>