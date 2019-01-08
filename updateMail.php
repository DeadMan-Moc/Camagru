<?php session_start();
if (empty($_SESSION['username']))
{
    header("Location: login.php");
}
include('config/database.php');

$_SESSION['y'] = null;
$oldMail = $_POST['oldMail'];
$newMail = $_POST['newMail'];

if(isset($_POST['UpdateMail']))
{
    $mail =  $_SESSION['mail'];
    try{
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo = $conn->prepare("SELECT * FROM users WHERE Email = ?");
        $pdo->execute($mail);
    }catch (PDOexception $e){
        $_SESSION['y'] = "Connection Error";
        header("Location: editMail.php");
    }
    $row = $pdo->fetch(PDO::FETCH_ASSOC);
    $email = $row['Email'];
    if ($mail == $oldMail)
    {
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo = $conn->prepare("SELECT Email FROM users WHERE Email = ?");
        $pdo->execute(array($newMail));
        $found = $pdo->rowCount();

        if ($found == 0)
        {
            $pdo = $conn->prepare("UPDATE users SET Email = ? WHERE Email = ?");
            $pdo->execute(array($newMail, $mail));
            $_SESSION['y'] = "Email succesfully changed";
            header("Location: editMail.php");
        }
        else{
            $_SESSION['y'] = "Email Already taken ";
            header("Location: editMail.php");
        }

    }else
    {
    $_SESSION['y'] = "User not found  " ;
    header("Location: editMail.php");
    }
}
else
{
    $_SESSION['y'] = "Something went wrong we working on it";
    header("Location: editMail.php");
}
