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
$sql = "SELECT Password FROM User WHERE Userid='$UserID'";
$row = $conn->query($sql)->fetch_row();
?>
<main>
  	<div class="sidebar__container">
			<?php include "theme/sidebar.php"; ?>
	</div>
    <div class="form__container">
        <h1 class="section-title">تغییر رمزعبور</h1>
        <form action="ChangePasswordAction.php"  method="POST">
            <label for="password"> رمز عبور جدید</label>
            <input type="text" name="Password" id="Password" placeholder="رمز عبور جدید را وارد کنید!"> 
            <div>
                <input data-aos="fade-left" type="submit" id="update-password" value="بروز رسانی" class="primary-button--cta">
                <input data-aos="fade-left" type="reset" value="شروع مجدد!!" class="primary-button">
            </div>
        </form>
    </div>
</main>

<?php include "theme/footer.php"; ?>