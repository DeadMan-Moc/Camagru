<?php
session_start();
include 'config/database.php';
htmlspecialchars($_SESSION['username']);
try
{
    $Username		= $_SESSION['username'];
    $image_id 		= trim(htmlspecialchars($_POST['image_id']));
    $comment 		= htmlspecialchars($_POST['comment_txt']);

    if (!isset($Username) || empty($Username))
    {
        $_SESSION['er'] = "You need to login to comment";
        header("Location: login.php");
    }
    else if (!isset($comment) || empty($comment))
    {
        header("Location: gallery.php");
    }
    else if ((isset($Username) && !empty($Username))
        && (isset($image_id) && !empty($image_id))
        && (isset($comment) && !empty($comment))) {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $dbh->prepare("INSERT INTO comments (Commenter, comment, image_id)
				VALUES (:Username, :comment, :image_id)");
        $sql->execute(array(':Username' => $Username, ':comment' => $comment, ':image_id' => $image_id));
        mailNotif($image_id, $Username);
    }
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

function mailNotif($img_id,$Username) {
    $DB_NAME = "camagru";
    $DB_DSN = "mysql:host=localhost;dbname=".$DB_NAME;
    $DB_USER = "root";
    $DB_PASSWORD = "123456";
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $wat = $pdo->prepare("SELECT * FROM gallery WHERE img_id = $img_id");
        $wat->execute();
        $found = $wat->rowCount();
        while ($row = $wat->fetch(PDO::FETCH_ASSOC)) {
            $name  = $row['username'];
        }
        if ($found == 1)
        {
            checkUser($name, $Username);

        }
        else{
            header("Location: index.php");
        }
    }catch(PDOexception $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
}
function checkUser($name, $Username) {
    $DB_NAME = "camagru";
    $DB_DSN = "mysql:host=localhost;dbname=".$DB_NAME;
    $DB_USER = "root";
    $DB_PASSWORD = "123456";
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $wat = $pdo->prepare("SELECT Email FROM users WHERE Username = :username AND mailNotif = :num");
        $wat->execute(array(':username' => $name, ':num'=> 1));
        $found = $wat->rowCount();
        $row = $wat->fetch(PDO::FETCH_ASSOC);
        $mail = $row['Email'];
        if ($found == 1)
        {
            func_mail($Username,$mail);
        }
    } catch(PDOexception $e)
    {
        echo  $e->getMessage();
    }
}
function func_mail($username, $mail) {

    $to      = $mail;
    $subject = ' Camagru Signup | Verification';
    $message = ''.$username.' commented on your picture
		
		';

    $headers = 'From:camagruteam@camagru.com' . "\r\n";
    mail($to, $subject, $message, $headers);
}
header("Location: gallery.php");
$conn = null;
?>
