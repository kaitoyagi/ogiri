<?php
  session_start();
  require_once '/var/www/html/header.php';
  header("Content-type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <script src="/var/www/html/passwordchecker.js" type="text/javascript"></script>
   <script src="/var/www/html/common.js" type="text/javascript"></script>
   <script type="text/javascript">
      /*
      * 登録前チェック
      */
      function conrimMessage() {
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var pass = document.getElementById("password").value;
        var conf = document.getElementById("confirm_password").value;

       //必須チェック
       if((name == "") || (email == "") || (pass == "") || (conf == "")) {
          alert("必須項目が入力されていません。");
          return false;
       }

        //パスワードチェック
        if (pass != conf) {
            alert("パスワードが一致していません。");
            return false;
        }

        if (passwordLevel < 3) {
          return confirm("パスワード強度が弱いですがよいですか？");
        }
        return true;
      }

   </script>
</head>
  <body class="register">
  <h1>登録画面</h1>

    <?php
      if ($_SESSION["error_status"] == 1) {
        echo "<h2 style='color:red;'>入力内容に誤りがあります。</h2>";
      }
      if ($_SESSION["error_status"] == 2) {
        echo "<h2 style='color:red;'>IDは既に登録されています。</h2>";
      }
      if ($_SESSION["error_status"] == 3) {
        echo "<h2 style='color:red;'>タイムアウトか不正な URL です。</h2>";
      }
      if ($_SESSION["error_status"] == 4) {
        echo "<h2 style='color:red;'>登録に失敗しました。</h2>";
      }
    ?>

    <form action="register_check.php" method="post" onsubmit="return conrimMessage();">
      <table border="0">
        <tr>
          <td>ニックネーム</td>
          <td><input type="text" name="name" id="name"></td>
        </tr>
        <tr>
          <td>メールアドレス </td>
          <td><input type="email" name="email" id="email"></td>
        </tr>
        <tr>
          <td>パスワード</td>
          <td><input type="password" name="password" id="password" onkeyup="setMessage(this.value);"></td>
          <td><div id="pass_message"></div></td>
        </tr>
        <tr>
          <td>パスワード（確認）</td>
          <td><input type="password" name="confirm_password" id="confirm_password" onkeyup="setConfirmMessage(this.value);"></td>
          <td><div id="pass_confirm_message"></div></td>
        </tr>
      </table>
      <input type="submit" value="登録">
      <input type="reset" value="リセット">
      <input type="button" value="戻る" onclick="history.back();">
    </form>
  </body>
</html>
