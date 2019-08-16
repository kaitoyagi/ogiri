<?php require_once 'header.php'; ?>
<?php
session_start();
if (!empty($_POST)) {
  if ($_POST['yes']) {
    if (isset($_SESSION['user'])) {
      unset($_SESSION['user']);
      header("Location:logout-out.php");
    }
  } else {
    header("Location:index.php");
  }
}
?>

<div class="logout">
  <p>本当にログアウトしますか？</p>
  <form action="" method="post">
    <input type="submit" name="yes" value="はい">
    <input type="submit" name="no" value="いいえ">
  </form>
</div>
