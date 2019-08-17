<?php
require_once '/var/www/html/database.php';
require_once '/var/www/html/header.php';
require_once '/var/www/html/function.php';
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h2>会員登録</h2>
    <form action="signup-out.php" method="post">
      <div class="">
        <label for="user_name">名前</label>
        <input type="text" name="user_name">
      </div>
      <div class="">
        <label for="user_name">Email</label>
        <input type="email" name="user_email">
      </div>
      <div class="">
        <label for="user_password">パスワード</label>
        <input type="password" name="user_password">
      </div>
      <div class="">
        <label for="user_pass_check">パスワード確認</label>
        <input type="password" name="user_pass_check">
      </div>
      <button type="submit" name="button">登録する</button>
    </form>
  </body>
</html>
