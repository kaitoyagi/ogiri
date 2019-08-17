<?php
require_once 'database.php';
require_once 'header.php';
require_once 'function.php';
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
