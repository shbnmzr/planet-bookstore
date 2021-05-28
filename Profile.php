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
$sql = "SELECT Bookid,OrderDate,Orderid FROM Orders WHERE Userid='$UserID'";
?>
<main>
	<div class="sidebar__container">
		<?php include "theme/sidebar.php"; ?>
	</div>
		
	<div class="books__container">
		<h1 class="section-title">خرید‌های شما</h1>
		<ul class="table__columns">
			<li class="table__column"> عنوان </li>
			<li class="table__column"> تاریخ </li>
		</ul>
		<?php
			$result = $conn->query($sql);
			if($result && $result->num_rows != 0) {
				while ($row = $result->fetch_row()) {
				$BookTitle = $conn->query("SELECT Title FROM Book WHERE Bookid='$row[0]'")->fetch_row()[0];
				echo "<ul class='book__details__container'>
					<li class='book__details'>$BookTitle</li>
					<li class='book__details'>$row[1]</li>
					<li class='book__details'><a style='color:red' href='CancelOrder.php?id=$row[2]'>Cancel</a></li>
				</ul>";
				}
			}else{
				echo "<ul class='book__details__container'><li class='book__details'>شما تاکنون سفارشی نداشته‌اید</li></ul>";
			}
		?>
		<ul  class='book__details__container'> 
			<li class='book__details'> پرداختی کل:</li>
			<li class='book__details'>
				<u>
				<?php
					$Total = $conn->query("SELECT SUM(Total) FROM Orders WHERE Userid='$UserID'")->fetch_row()[0];
					if(is_numeric($Total))
						echo $Total;
					else
						echo 0;
				?>
				</u>
			</li>
		</ul>
	</div>
	
</main>

<?php include "theme/footer.php"; ?>