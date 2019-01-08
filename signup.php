<?php

session_start();
include_once('config/database.php');
include_once('verify_signup.php');


$mail = $_POST['Email'];
$username = $_POST['Username'];
$pwd = $_POST['Password'];
$cpwd = $_POST['cPassword'];

$_SESSION['error'] = null;

if(empty($mail) || empty($username) || empty($pwd) || empty($cpwd))
{
    $_SESSION['error'] = "Field/s cannot be empty";
    header("Location: index.php");
    exit();
}
if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
{
    $_SESSION['error'] = "Enter a valid Email";
    header("Location: index.php");
    exit();
}
if (!preg_match("#[a-zA-Z]+#", $pwd))
{
    $_SESSION['error'] = "Password shoud contain at least Lowercase, Uppercase";
    header("Location: index.php");
    exit();
}
if (!preg_match("#[0-9]+#", $pwd))
{
    $_SESSION['error'] = "Password shoud contain at least a digit ";
    header("Location: index.php");
    exit();
}
if (strlen($pwd) < 4)
{
    $_SESSION['error'] = "Password should contain at least 4 chars";
    header("Location: index.php");
    exit();
}
if (strlen($username) < 4)
{
    $_SESSION['error'] = "username should contain at least 4 chars";
    header('Location: index.php');
    exit();
}
if (!preg_match("/^[a-zA-Z0-9]{3,}$/", $username)) 
{
    $_SESSION['error'] = "Username should cocntain Lower/Upper case and should have atleast 3 chars";
    header('Location: index.php');
    exit();
}
if ($pwd != $cpwd)
{
    $_SESSION['error'] = "Passwords dont match try again";
    header('Location: index.php');
    exit();
}
$url = $_SERVER['HTTP_HOST'] . str_replace("signup.php", "", $_SERVER['REQUEST_URI']);

verify_signup($mail, $username, $pwd, $url);

header("Location: index.php");
?>
