<?php include "theme/header.php"; ?>

<?php

require_once "includes/Database_Configuration.php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$ToBeSearched = $_POST['Search'];
$sql = "SELECT Title,Language,Price,Bookid,Authorid,Categoryid FROM Book WHERE Title Like '%{$ToBeSearched}%' Order By Title";
?>

<main>
	<div class="books__container">
		<h1 data-aos="fade-down" class="section-title">لیست کتاب‌ها</h1>
		<ul  data-aos="fade-down" class="table__columns">
			<li class="table__column"> عنوان </li>
			<li class="table__column"> زبان </li>
			<li class="table__column"> نویسنده </li>
			<li class="table__column"> موضوع </li>
			<li class="table__column"> قیمت </li>
			<?php
				if(isset($_SESSION['loggedin'])){
					echo "<li></li>";
				}
			?>
		</ul>
		<?php
			if($result = $conn->query($sql)) {
				while ($row = $result->fetch_row()) {
				$AuthorName = $conn->query("SELECT Firstname,Lastname FROM author WHERE authorid='$row[4]'")->fetch_row();
				$Category = $conn->query("SELECT Title FROM category WHERE categoryid='$row[5]'")->fetch_row();
				echo "<ul data-aos='fade-up' class='book__details__container'><li class='book__details'>$row[0]</li><li class='book__details'>$row[1]</li><li class='book__details'>$AuthorName[0] $AuthorName[1]</li><li class='book__details'><a class='primary-link' href='Category.php?id=$row[5]'>$Category[0]</a></li><li class='book__details'>$$row[2]</li>";
					if(isset($_SESSION['loggedin'])){
						$UserName = $_SESSION['UserName'];
						$BookID = $row[3];
						$UserID = $_SESSION['UserID'];
						$OrderCount = $conn->query("SELECT orderid FROM Orders WHERE Bookid='$BookID' AND Userid='$UserID'")->num_rows;
						if($OrderCount == 0){
							echo "<li class='book__details'><a class='primary-link' title='Order as $UserName' href='Order.php?id=$BookID'>Order</a></li>";
						}else{
							echo "<li class='book__details' style='text-decoration:line-through;'>Ordered</li>";
						}	
					}
					echo "</ul>";
				}
				$result->free_result();
			}
		?>
	</div>
</main>

<?php $conn->close(); ?>
<?php include "theme/footer.php"; ?>