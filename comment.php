<?php
require_once 'header.php';
require_once 'function.php';
require_once 'database.php';
session_start();
?>

<?php
require_logined_session();
?>

<?php
$post_id = $_GET['id'];
foreach ($mysqli->query("SELECT * FROM posts WHERE post_id = $post_id") as $row) {
  ?>
  <div class="post_content">
    <h1>お題：<?php echo $row['post_content']; ?></h1>
    <a href="comment-out.php?id=<?php echo $row['post_id']; ?>">ボケる</a>
  </div>
<?php } ?>
<?php
$comment_data = fetch_comments($post_id, $mysqli);
?>






<?php
if ($comment_data !== false){
  foreach ($comment_data as $comments_data){
    ?>
    <body>
      <div class="comment">
        <p class="name">ニックネーム：<?php  echo $comments_data['name']; ?></p>
        <h3 class="content">回答：<?php  echo $comments_data['comment_content']; ?></h3>
      </div>
    </body>
  <?php } ?>
<?php } ?>

<?php
//口コミの投稿
if ($_POST) {
  //必須項目が入っているか確認する
  if (!empty($_POST['add_comment'])) {
    $add_comment = $_POST['add_comment'];
    add_comment($post_id, $add_comment, $mysqli);
  } else {
    echo "口コミを入力してください";
  }
}
?>
