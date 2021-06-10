<?php include "theme/header.php"; ?>
<?php
if(strlen(session_id()) < 1) session_start();
if( isset($_SESSION['loggedin']) ){
	if($_SESSION['loggedin']) header("Location: panel/");
}
$_POST = array();
?>
<main>
	<div class="form__container">
		<h1 class="section-title">ثبت نام کنید!</h1>
		<form action="RegisterFunctionality.php" method="POST">
			<label data-aos="fade-left" for="firstname">نام</label>
			<input data-aos="fade-left" type="text" id="firstname" name="Firstname" required> 
			<label data-aos="fade-left" for="lastname">نام خانوادگی</label>
			<input data-aos="fade-left" type="text" id="lastname" name="Lastname" required> 
			<label data-aos="fade-left" for="email">ایمیل</label>
			<input data-aos="fade-left" type="email" id="email" name="Email" placeholder="something@something.something" required> 
			<label data-aos="fade-left" for="email" class="error" id="email-error">*لطفا ایمیل معتبر وارد کنید</label>
			<label data-aos="fade-left" for="password">رمز عبور</label>
			<input data-aos="fade-left" type="password" id="password" name="Password" required> 
			<label data-aos="fade-left" for="phonenumber">تلفن</label>
			<input data-aos="fade-left" type="text" id="phonenumber" name="Phonenumber" required> 
			<label data-aos="fade-left" for="postalcode">کد پستی</label>
			<input data-aos="fade-left" type="text" id="postalcode" name="PostalCode" required> 
			<label data-aos="fade-left" for="postalcode" class="error" id="postalcode-error">*لطفا کدپستی معتبر وارد کنید</label>
			<label data-aos="fade-left" for="address" required>آدرس</label>
			<textarea data-aos="fade-left" id="address" name="Address"></textarea> 
			<div>
				<input data-aos="fade-left" type="submit" id="registeration" value="ثبت نام" class="primary-button--cta">
				<input data-aos="fade-left" type="reset" value="شروع مجدد!!" class="primary-button">
			</div>
		</form>
	</div>
</main>

<?php include "theme/footer.php"; ?>