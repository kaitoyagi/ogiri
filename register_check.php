<?php require_once '/var/www/html/database.php'; ?>
<?php require_once '/var/www/html/function.php'; ?>
<?php
session_start();
header("Content-type: text/html; charset=utf-8");


$name = $_POST["name"];
$email = $_POST['email'];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];


  if ($password != $confirm_password) {
    //パスワード不一致
    $_SESSION["error_status"] = 1;
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: register.php");
    exit();
  }

  // IDチェック

  // プレースホルダの型を指定
$sql = 'select count(*) as cnt from users where email=?';
$stmt = $mysqli->prepare($sql);

$arrParam = array();
$arrParam[] = $mail;
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (0 < $row['cnt']) {
      echo "{$email}は既に登録されています";
    }
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>確認画面</h1>
    <h2>登録しますか？</h2>
    <form action="register_submit.php" method="post">
      <table border="0">
        <tr>
          <td>ニックネーム</td>
          <td><?php echo htmlspecialchars($name, ENT_QUOTES, "UTF-8") ?></td>
        </tr>
        <tr>
          <td>メールアドレス</td>
          <td><?php echo htmlspecialchars($email, ENT_QUOTES, "UTF-8") ?></td>
        </tr>
      </table>
      <input type="hidden" name="name" value="<?php echo htmlspecialchars($name , ENT_QUOTES, "UTF-8") ?>">
      <input type="hidden" name="email" value="<?php echo htmlspecialchars($email , ENT_QUOTES, "UTF-8") ?>">
      <input type="hidden" name="password" value="<?php echo htmlspecialchars($password , ENT_QUOTES, "UTF-8") ?>">
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token'] , ENT_QUOTES, "UTF-8") ?>">
      <input type="submit" value="登録">
      <input type="button" value="戻る" onclick="history.back();">
    </form>
  </body>
</html>
