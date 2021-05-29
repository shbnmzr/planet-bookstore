<?php include "theme/header.php"; ?>

<?php
if(strlen(session_id()) < 1) session_start();
if( isset($_SESSION['loggedin'])) header("Location: panel/");
?>

<main>
	<div class="form__container">
		<h1 class="section-title">وارد شوید!</h1>
		<div class="message-fail">
		ورود ناموفق بود! دوباره تلاش کنید
		</div>
		<div class="message-success">
			با موفقیت وارد شدید...
		</div>
		<form method="POST" action="LoginFunctionality.php">
			<label data-aos="fade-left" for="email">ایمیل</label>
			<input data-aos="fade-left" id="email" type="email" name="Email">
			<label data-aos="fade-left" for="password">رمز عبور</label>
			<input data-aos="fade-left" type="password" id="Password" name="Password">
			<div>
				<input data-aos="fade-left" type="submit"  value="ورود!" class="primary-button">
			</div>		
		</form>
	</div>
	
</main>



<?php include "theme/footer.php"; ?>