<?php
require_once "includes/Database_Configuration.php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<aside class="sidebar">
	<div class="username">
		نام کاربری:
		<?php
		$UserName = $_SESSION['UserName'];
		echo $UserName;
		?>
	</div>
	<ul class="sidebar__items">
		<li class="sidebar__item">
			<a class="sidebar__link" href="Profile.php">
				 سفارشات شما 
			</a>
		</li>
		<li class="sidebar__item">
			<a class="sidebar__link" href="EditProfile.php">
				 ویرایش اطلاعات
			</a>
		</li>
		<li class="sidebar__item">
			<a class="sidebar__link" href="ChangePassword.php">
				  تغییر رمز‌عبور
			</a>
		</li>
	</ul>
</aside>