<?php
if(strlen(session_id()) < 1) session_start();
if( !$_SESSION['loggedin']) header("Location: Login.php");

require_once "includes/Database_Configuration.php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

foreach ($_POST as $key => $value) {
	if($value == "")
		header("Location: ChangePassword.php?Failure");
}

$UserID = $_SESSION['UserID'];
$InputedPassword = SHA1($_POST['Password']);
$Result = $conn->query("UPDATE User SET Password='$InputedPassword' WHERE Userid='$UserID'");

if($Result){
	header("Location: ChangePassword.php?Success");
}

$conn->close();
?>