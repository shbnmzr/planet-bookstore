<?php
session_start();

if(!$_SESSION['loggedin']) header("Location: ../index.php");
require_once "../includes/Database_Configuration.php";

if(isset($_POST['Email'])){
	$conn = new mysqli($servername, $username, $password, $dbname);

	$Email = $_POST['Email'];
	$Address = $_POST['Address'];
	$Firstname = $_POST['Firstname'];
	$Lastname = $_POST['Lastname'];
	$Password = $_POST['Password'];
	$Phonenumber = $_POST['Phonenumber'];
	$Postalcode = $_POST['Postalcode'];
	if(!isset($_POST['Update'])){
		$conn->query("INSERT INTO User VALUES('', '$Firstname', '$Lastname', '$Email', '$Password', '$Postalcode', '$Phonenumber', '$Address')");
	}else{
		$InputID = $_POST['Userid'];
		$conn->query("UPDATE User SET Firstname='$Firstname', Lastname='$Lastname', Email='$Email', Password='$Password', PostalCode='$Postalcode', Phonenumber='$Phonenumber', Address='$Address' WHERE userid='$InputID'");
	}
	$conn->close();
	header("Location: UserManagement.php?Success");
}

?>

<?php include "theme/header.php"; ?>

<main>
	<h1>Add User To Database</h1>
	<?php if(isset($_GET['Success'])): ?>
		<h5 style="color:green">Done Successfully</h5>
	<?php elseif(isset($_GET['Failure'])): ?>
		<h5 style="color:red">Some Error Happened</h5>
	<?php endif; ?>
	<div style="display: flex;">
		<div style="flex:1">
			<?php include "theme/sidebar.php" ?>
		</div>
		<div style="flex:2;">
			<form action="AddUser.php" method="POST">
				<?php if(isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == "update"):?>
					<?php
						$conn = new mysqli($servername, $username, $password, $dbname);
						$InputID = $_GET['id'];
						$result = $conn->query("SELECT * FROM User WHERE userid='$InputID'");
						$row = $result->fetch_row()
					?>
					<input type="hidden" name="Update" value="true">
					<input type="hidden" name="Userid" value="<?php echo $InputID; ?>">
					<input type="text" name="Firstname" value="<?php echo $row[1]?>"> <br>
					<input type="text" name="Lastname" value="<?php echo $row[2]?>"> <br>
					<input type="text" name="Email" value="<?php echo $row[3]?>"> <br>
					<input type="text" name="Phonenumber" value="<?php echo $row[6]?>"> <br>
					<input type="text" name="PostalCode" value="<?php echo $row[5]?>"> <br>
					<input type="text" name="Password" value="<?php echo $row[4]?>"> <br>
					<textarea name="Address"><?php echo $row[7]?></textarea> <br>
				<?php else: ?>
					<input type="text" name="Firstname" placeholder="Firstname"> <br>
					<input type="text" name="Lastname" placeholder="Lastname"> <br>
					<input type="text" name="Email" placeholder="Email"> <br>
					<input type="text" name="Phonenumber" placeholder="Phonenumber"> <br>
					<input type="text" name="PostalCode" placeholder="PostalCode"> <br>
					<input type="text" name="Password" placeholder="Password"> <br>
					<textarea name="Address" placeholder="Address"></textarea> <br>
				<?php endif; ?>
				<input type="submit" value="Add!">
			</form>
		</div>
	</div>
</main>

<?php include "../theme/footer.php"; ?>