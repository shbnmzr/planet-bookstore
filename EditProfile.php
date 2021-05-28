<?php include "theme/header.php"; ?>
<?php
if(strlen(session_id()) < 1) session_start();
if( !$_SESSION['loggedin']) header("Location: Login.php");

require_once "includes/Database_Configuration.php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$UserID = $_SESSION['UserID'];
$sql = "SELECT Firstname,Lastname,Email,Password,Phonenumber,PostalCode, Address FROM User WHERE Userid='$UserID'";
$row = $conn->query($sql)->fetch_row();
?>
<main>
  	<div class="sidebar__container">
			<?php include "theme/sidebar.php"; ?>
	</div>
		
		<div class="form__container">
			<h1 class="section-title">اطلاعات شما</h1>
			<form action="EditProfileAction.php" method="POST">
				<label data-aos="fade-left" for="firstname">نام</label>
				<input data-aos="fade-left" type="text" name="Firstname" value="<?php echo $row[0] ?>"> 
				<label data-aos="fade-left" for="lastname">نام خانوادگی</label>
				<input data-aos="fade-left" type="text" name="Lastname" value="<?php echo $row[1] ?>"> 
				<label data-aos="fade-left" for="email">ایمیل</label>
				<input data-aos="fade-left" type="email" name="Email" value="<?php echo $row[2] ?>"> 
				<label data-aos="fade-left" for="email" class="error" id="email-error">*لطفا ایمیل معتبر وارد کنید</label>
				<label data-aos="fade-left" for="phonenumber">تلفن</label>
				<input data-aos="fade-left" type="text" name="Phonenumber" value="<?php echo $row[4] ?>"> 
				<label data-aos="fade-left" for="postalcode">کد پستی</label>
				<input data-aos="fade-left" type="text" name="PostalCode" value="<?php echo $row[5] ?>"> 
				<label data-aos="fade-left" for="address">آدرس</label>
				<textarea data-aos="fade-left" name="Address"><?php echo $row[6] ?></textarea> 
				<div>
					<input data-aos="fade-left" type="submit" value="بروز رسانی" class="primary-button--cta">
					<input data-aos="fade-left" type="reset" value="شروع مجدد!!" class="primary-button">
				</div>
			</form>
		</div>
</main>

<?php include "theme/footer.php"; ?>