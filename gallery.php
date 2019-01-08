<?php
session_start();
require_once('config/database.php');
$name =$_SESSION['username'];
if (isset($_GET['page']) && $_GET['page'] >= 5) {
    $curpage = $_GET['page'];
} else {
    $curpage = 0;
}
$result;
$lyk;

$curpager = $curpage;

   try {
       $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $count_page = $conn->query("SELECT COUNT(*) FROM `gallery`", PDO::FETCH_ASSOC)->fetchColumn();

       if ($curpage < $count_page && $curpage != -6) {
           $result = $conn->query("SELECT * FROM `gallery` ORDER BY upload_date DESC LIMIT 6 OFFSET $curpage", PDO::FETCH_ASSOC)->fetchAll();
       }else if($curpage == -6){
           if ($count_page == 0){
               $curpage = 0;
           }elseif ($count_page % 6 == 0){
               $curpage = $count_page - 6;
           }else{
               $curpage = $count_page - $count_page % 6;
           }
           $result = $conn->query("SELECT * FROM `gallery` ORDER BY upload_date DESC LIMIT 6 OFFSET $curpage", PDO::FETCH_ASSOC)->fetchAll();
       }
       else
       {
           $curpage = 0;
           $result = $conn->query("SELECT * FROM `gallery` ORDER BY upload_date DESC LIMIT 6 OFFSET $curpage", PDO::FETCH_ASSOC)->fetchAll();
       }

   } catch (PDOException $e) {
       echo "ERROR EXECUTING: \n" . $e->getMessage();
   }

   if ($curpager == 0){
       $pageNum = 1;
   } else {
       $pageNum = intdiv($curpage, 6) + 1;
   }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
    <link rel="stylesheet" href="cass.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>

<div class="bg"></div>
<nav>
<meta name="viewport" content="width=device-width, initial-scale=1">
<p> </p>
    <ul>
        <li><a href="home.php"> Home </a></li>  
        <li><a href="cam.php">CAMERA</a></li>
       <li><a href="#">Edit Profile <i class="arrow down"> </i> </div> </a>
        <ul>
        <li> <a href="update_password.php">Password</a></li>
                    <li> <a href="editUsername.php">Usernames</a></li>
                    <li> <a href="editMail.php">Change Email</a></li>
                    <li> <a href="mailNotif.php">Mail Notification</a></li>
</ul>
        </li>

      <li>
      <?php if(empty($_SESSION['username'])) echo "<li><a href='login.php'>Login </a>"; else echo "<li><a href='logout.php'>Logout </a> "?> </li>
        
</nav>

<div class="home"> <h1>Welcome <?php echo $_SESSION['username'] ; ?></h1></div>
<div id="main"> <?php
    if ($result)
        foreach ($result as $row) {
            $count = 0;
            $lyk1 = $conn->query("SELECT * FROM `likes`", PDO::FETCH_ASSOC);
            ?>
            <p> posted by <?php echo $row['username']; ?></p>
            <img id="e1" src=<?= $row['img_name']; ?> width="20%" height="15%">

            <?php foreach ($lyk1 as $pic) {
                if ($pic['image_id'] == $row['img_id']) {
                    $count++;
                }
            }
            ?>
           <p><button><a class="fa fa-thumbs-up" aria-hidden="true"
                       href="like.php?type=image&image_id=<?php echo $row['img_id']; ?>"></a>
            </button>
            <b><?php echo $count; ?> people like this</b></p>
           
                <?php
                $id = $row['img_id'];
               $sql = $conn->prepare("SELECT * FROM comments WHERE image_id=:image_id ORDER BY date_added ASC ");
                $sql->execute(array(':image_id' => $id));
                $comments = $sql->fetchAll();
                ?>
                <div class="div">
                <?php
                echo '<table><ul style="list-style-type: none">';
                for ($j = 0; $j < sizeof($comments); $j++) {
                    $comment = $comments[$j]['comment'];
                    $comment_by = $comments[$j]['Commenter'];
                    echo '
						<tr style="background-color: whitesmoke">
						<td><li style="list-style-type: none; text-decoration-color: deepskyblue">'
                        . $comment_by .
                        ' - </li><td>'
                        . $comment .
                        '</td>' .
                        '</td>
						</tr>
						';
                }
                echo '
					</ul></table>
					';
                ?>
           </div>
                
            <form action="comments.php" id="commentform" method="POST">
                <input type="hidden" value="<?php echo $row['img_id']; ?>" name="image_id">
                <textarea name="comment_txt" placeholder="Comment on picture"></textarea>
                <br>
                <input type="submit">
            </form>
           <?php
        }
    else
        echo "Gallery empty";
    ?>
</div>
<div class="page">
    <ul>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $curpage+6?>"><span aria-hidden="true">&raquo;</span>Next Page</a></li>
    <?php echo "Page"  .$pageNum; ?>
    <li class="page-item"><a class="page-link" href="?page=<?php if($curpage != 0) echo $curpage-6; else echo $curpage; ?>">previous Page<span aria-hidden="true">&laquo;</span></a></li>
    </ul>
</div>
<footer> <div class="footer">Camagru - amokgohl 2018</div></footer>

</body>
</html>
