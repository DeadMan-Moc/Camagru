<?php
session_start();
    $uid = $_SESSION['username'];
    echo $uid ;
    $val = $_GET['value'];
    echo $val. "me" ;
    require_once 'config/database.php';
    try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $dbh->prepare("SELECT * FROM gallery WHERE img_id= ? AND username= ?");
        $sql->execute(array($val, $uid));

        $sql = $dbh->prepare("DELETE FROM `likes` WHERE image_id= ?");
        $sql->execute(array(($val)));

        $sql = $dbh->prepare("DELETE FROM comments WHERE image_id= ?");
        $sql->execute(array($val));

        $sql = $dbh->prepare("DELETE FROM gallery WHERE img_id= ?  AND username = ?");
        $sql->execute(array($val,$uid));

        header("Location: home.php");
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
    ?>