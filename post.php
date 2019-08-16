<?php
require_once 'database.php';
require_once 'function.php';
require_once 'header.php';
session_start();
require_logined_session();
?>

<?php
if($_POST) {
  if(!empty($_POST['add_post'])) {
    $add_post = $_POST['add_post'];
    add_post($add_post, $mysqli);
  } else {
    echo '文字を入力してください';
  }
}

 ?>


<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="" method="post">
      <div class="add_post">
      <h2>投稿する</h2>
        <div class="textarea">
          <textarea name="add_post" rows="12" cols="60"></textarea>
        </div>
        <input type="submit" value="送信">
      </div>
    </form>
  </body>
</html>

<?php
// 完成済みのSELECT文を実行する
$sql = "SELECT * FROM posts WHERE post_id=?";
if ($stmt = $mysqli->prepare($sql)) {
  $post_id = 1;
  $stmt->bind_param("is", $post_id);

  $stmt->execute();

  $stmt->bind_result($post_id);
  while ($stmt->fetch()) {
    echo "POST=$post_id";
  }
}

?>
