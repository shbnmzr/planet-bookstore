<?php
session_start();

if(!$_SESSION['loggedin']) header("Location: ../index.php");
require_once "../includes/Database_Configuration.php";

if(isset($_GET['action']) && isset($_GET['id'])){
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	switch($_GET['action']){
		case "del":
			$UserToBeDeleted = $_GET['id'];
			$sql = "DELETE FROM User WHERE userid='$UserToBeDeleted'";
			if ($conn->query($sql) === TRUE) {
			  header("Location: UserManagement.php?Success");
			} else {
			  header("Location: UserManagement.php?Failed");
			}
			break;
		case "update":

			break;

		default:
			header("Location: UserManagement.php");
	}
	$conn->close();
}

?>

<?php include "theme/header.php"; ?>

<main>
	<h1>User Management</h1>
	<a style="margin-bottom:20px;" href="AddUser.php"> Add New</a>
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
			<table>
				<tr style="font-weight: bold;">
					<td>ID</td>
					<td>Name</td>
					<td>Email</td>
					<td>Actions</td>
				</tr>
			<?php
			$conn = new mysqli($servername, $username, $password, $dbname);

			if ($conn->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM User";

			if ($result = $conn->query($sql)) {
			  while ($row = $result->fetch_row()) {
			    echo "<tr><td>$row[0]</td><td>$row[1] $row[2]</td><td>$row[3]</td><td>
			    <a href='?action=del&id=$row[0]'>D</a>
			    <a href='AddUser.php?action=update&id=$row[0]'>U</a>
			    </td></tr>";
			  }
			  $result->free_result();
			}

			$conn->close();
			?> 
			</table>
		</div>
	</div>
</main>

<?php include "../theme/footer.php"; ?>