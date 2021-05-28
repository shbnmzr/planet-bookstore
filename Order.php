<?php
if(strlen(session_id()) < 1) session_start();
if( !isset($_SESSION['loggedin'])) header("Location: login.php");
?>


<?php

require_once "includes/Database_Configuration.php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$UserID = $_SESSION['UserID'];
$BookID = $_GET['id'];
$OrderCount = $conn->query("SELECT orderid FROM Orders WHERE Bookid='$BookID' AND Userid='$UserID'")->num_rows;

if($OrderCount == 0){
	$Total = $conn->query("SELECT price FROM Book WHERE Bookid='$BookID'")->fetch_row()[0];

	$stmt = $conn->prepare("INSERT INTO Orders (UserID, BookID, OrderDate, Total) VALUES (?,?,NOW(),?)");
	$stmt->bind_param("ddd",$UserID, $BookID,$Total );
	$stmt->execute();
}
header("Location: Books.php");
?>