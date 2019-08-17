<?php
$post_id = $_GET['id'];
require_once '/var/www/html/function.php';
require_once '/var/www/html/database.php';
require_once '/var/www/html/header.php';
session_start();
?>
<?php
$post_id = $_GET['id'];
foreach ($mysqli->query("SELECT * FROM posts WHERE post_id = $post_id") as $row) {
  ?>
  <div class="post_content">
    <h1>お題：<?php echo $row['post_content']; ?></h1>
  </div>
<?php } ?>
<?php
$comment_data = fetch_comments($post_id, $mysqli);
?>

<?php
//口コミの投稿
if ($_POST) {
  //必須項目が入っているか確認する
  if (!empty($_POST['add_comment'])) {
    $add_comment = $_POST['add_comment'];
    add_comment($post_id, $add_comment, $mysqli);
  } else {
    ?>
<div class="button">
  <p>文字を入力してください</p>
</div>
  <?php } ?>
<?php } ?>

<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <form action="" method="post">
        <div class="add_post">
          <textarea name="add_comment" class="form-control" rows="12" cols="60" placeholder="文字を入力してください"></textarea> <br>
          <button type="submit" class="btn btn-default">投稿する</button>
        </div>
      </form>
    </div>
  </div>
</div>
