<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once '/var/www/html/header.php';
require_once '/var/www/html/function.php';
require_once '/var/www/html/database.php';
require_logined_session();
?>
<?php
$user_id = $_GET['id'];
?>
<?php
if($_POST["yes"]) {
  $query1 = "DELETE FROM
                        comments
            WHERE
                        comments.comment_user_id = $user_id";
  $query2 = "DELETE FROM
                        posts
            WHERE
                        posts.post_user_id = $user_id";
  $query3 = "DELETE FROM
                        users
            WHERE
                        users.user_id = $user_id";
  $result1 = $mysqli->query($query1);
  $result2 = $mysqli->query($query2);
  $result3 = $mysqli->query($query3);
  echo '削除完了しました';
  session_destroy();
} else {
  header('Location:index.php');
}
?>
