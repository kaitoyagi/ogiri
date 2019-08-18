<?php
require_once '/var/www/html/database.php';
require_once '/var/www/html/header.php';
require_once '/var/www/html/function.php';
?>
<?php
// 送信ボタンが押された時に下記を実行
if ($_POST) {
  //必須項目が入っているか確認する
  if(
    !empty($_POST['user_name']) &&
    !empty($_POST['user_email']) &&
    !empty($_POST['user_password']) &&
    !empty($_POST['user_pass_check'])
  ) {
    if($_POST['user_password'] == $_POST['user_pass_check']) {
      //エラーがない場合
      $user_name = $_POST['user_name'];
      $user_email = $_POST['user_email'];
      $user_password = $_POST['user_password'];
      //会員登録する
      save_user($user_name, $user_email, $user_password, $mysqli);
    } else {
      echo "パスワードが一致しません。";
    }
  } else {
    echo "エラーがあります";
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
