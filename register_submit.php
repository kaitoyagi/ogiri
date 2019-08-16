<?php require_once 'DBManager.php'; ?>
<?php require_once 'menu.php'; ?>
<?php require_once 'function.php'; ?>
<?php require_once 'database.php'; ?>
<?php
session_start();
header("Content-type: text/html; charset=utf-8");

if ($_SESSION['token'] != $_POST['token']) {
  $_SESSION = array();
  session_destroy();
  session_start();

  $_SESSION["error_status"] = 2;
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: login.php");
  exit;
}

$_SESSION["error_status"] = 0;

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

if($_POST) {
  save_user($name, $email, $password, $mysqli);
} else {
  echo "エラーがあります";
}





?>
