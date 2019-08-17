<?php session_start(); ?>
<?php require_once '/var/www/html/database.php'; ?>
<?php require_once '/var/www/html/function.php'; ?>

<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>大喜利道場</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <body>
      <div class="kara">
      </div>
    <header>
        <div class="header">
          <h1 class="ogiri-title"><a href="index.php">大喜利道場</a></h1>
          <?php
          if(empty($_SESSION['user'])) {
            ?>
            <ul class="log">
              <li class="item"><a href="login.php">ログイン</a></li>
              <li class="item"><a href="register.php">登録</a></li>
            </ul>
            <?php
          } else {
            ?>
            <ul class="log">
              <li class="item"><a href="post.php">投稿</a>
              <li class="item"><a href="logout.php">ログアウト</a></li>
              <li class="item"><a href="withdraw2.php">退会</a></li>
            </ul>
          <?php } ?>
        </div>
    </header>
  </body>
