<?php
session_start();
require_once "includes/Database_Configuration.php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$userEmail = $_POST['Email'];
$userPassword = SHA1($_POST['Password']);
$userAddress = $_POST['Address'];
$userPhoneNumber = $_POST['Phonenumber'];
$userFirstname = $_POST['Firstname'];
$userLastname = $_POST['Lastname'];
$userPostalCode = $_POST['PostalCode'];

$UsersExists = $conn->query("SELECT userid FROM User WHERE email='$userEmail'")->num_rows;

if($UsersExists > 0)
	header("Location: register.php?UserExists");

$stmt = $conn->prepare("INSERT INTO user (Firstname, Lastname, Password, Email, PostalCode, Phonenumber, Address) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("ssssdds", $userFirstname,$userLastname,$userPassword,$userEmail,$userPostalCode,$userPhoneNumber,$userAddress);

$stmt->execute();
$_SESSION['loggedin'] = true;
$_SESSION['UserName'] = $userFirstname. " " . $userLastname;
$_SESSION['UserID'] = $conn->insert_id;

$conn->close();

header("Location: Profile.php");

?> 