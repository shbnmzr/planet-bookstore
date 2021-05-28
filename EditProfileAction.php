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
		header("Location: EditProfile.php?Failure");
}

$UserID = $_SESSION['UserID'];

$InputedEmail = $_POST['Email'];
$InputedPassword = SHA1($_POST['Password']);
$InputedAddress = $_POST['Address'];
$InputedPhoneNumber = $_POST['Phonenumber'];
$InputedFirstname = $_POST['Firstname'];
$InputedLastname = $_POST['Lastname'];
$InputedPostalCode = $_POST['PostalCode'];

$Result = $conn->query("UPDATE User SET Firstname='$InputedFirstname', Lastname='$InputedLastname', Email='$InputedEmail', PostalCode='$InputedPostalCode', Password='$InputedPassword', Phonenumber='$InputedPhoneNumber', Address='$InputedAddress' WHERE Userid='$UserID'");

if($Result){
	header("Location: EditProfile.php?Success");
}

$conn->close();
?>