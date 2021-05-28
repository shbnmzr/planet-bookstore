<?php
session_start();
require_once "includes/Database_Configuration.php";

$conn = new mysqli($servername, $username, $password, $dbname);

$InputedEmail = $_POST['Email'];
$InputedPassword = SHA1($_POST['Password']);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$Query = $conn->query("SELECT UserID,Firstname,Lastname FROM User WHERE email='$InputedEmail' AND password='$InputedPassword'");
$UsersCount = $Query->num_rows;

$UserData = $Query->fetch_row();

$conn->close();

if($UsersCount == 1){
	# Login Successful
	$_SESSION['loggedin'] = true;
	$_SESSION['UserName'] = $UserData[1]. " " . $UserData[2];
	$_SESSION['UserID'] = $UserData[0];
	header("Location: Profile.php");
	
}else{
	# Login Failed
	session_unset();
	session_destroy();
	header("Location: index.php?Failed");
	
}

?> 