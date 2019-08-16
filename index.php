<?php
require_once 'header.php';
require_once 'function.php';
require_once 'database.php';
?>


<?php
$post_data = fetch_posts($mysqli);
foreach ($post_data as $posts_data){
  ?>
      <div class="post_data">
          <p class="name">出題者：<?php  echo $posts_data['name']; ?></p>
          <h3>お題：<?php  echo $posts_data['post_content']; ?></h3>
          <a href="comment.php?id=<?php echo $posts_data['post_id']; ?> ">&raquo; ボケる</a>
      </div>
    </body>
<?php } ?>
