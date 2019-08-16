<?php
require_once 'header.php';
require_once 'database.php';
require_once 'function.php';
?>

<?php
if ($_POST) {
  //必須項目に情報が入っているかを確認する
  if (
    !empty($_POST['email']) &&
    !empty($_POST['password'])
  ) {
    //エラーがない場合
    $email = $_POST['email'];
    $password = $_POST['password'];
    //ログインする
    login_user($email, $password, $mysqli);
  } else {
    echo "エラーがあります";
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>ログイン</title>
  </head>
  <body>
    <div class="login">
      <h1>ログイン画面</h1>
      <form action="" method="post">
        <label for="email">Email</label> <input type="email" name="email" id="email"> <br>
        <label for="password">パスワード</label> <input type="password" name="password" id="password"> <br>
        <input type="submit" name="login" value="ログイン">
      </form>
    </div>
  </body>
</html>
