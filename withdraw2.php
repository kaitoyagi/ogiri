<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once '/var/www/html/header.php';
require_once '/var/www/html/function.php';
require_once '/var/www/html/database.php';
require_logined_session();
?>
<?php
$user_id = $_SESSION['user'];
?>

<form action="withdraw2-out.php?id=<?php echo $user_id; ?>" method="post">
	<section class="popup">
		<p>本当に退会しますか？</p>
		<div class="btn-container">
			<input type="submit" name="yes"  value="はい">
			<input type="submit" name="no"  value="いいえ">
		</div>
	</section>
</form>
