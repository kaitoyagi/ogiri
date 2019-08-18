<?php
require_once '/var/www/html/header.php';
require_once '/var/www/html/function.php';
require_once '/var/www/html/database.php';
?>


<?php
$post_data = fetch_posts($mysqli);
foreach ($post_data as $posts_data){
  ?>
      <div class="post_data">
          <p class="name">出題者：<?php  echo $posts_data['name']; ?></p>
          <h3>お題：<?php  echo $posts_data['post_content']; ?></h3>
          <a href="comment.php?id=<?php echo $posts_data['post_id']; ?> ">&raquo; 回答</a>
          <a href="post.php?id=<?php echo $posts_data['post_id']; ?> ">&raquo; ボケる</a>
      </div>
    </body>
<?php } ?>
