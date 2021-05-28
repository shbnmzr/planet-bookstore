<?php
session_start();
if( !isset($_SESSION['loggedin'])) header("Location: Login.php");



require_once "includes/Database_Configuration.php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$OrderID = $_GET['id'];
$UserID = $_SESSION['UserID'];
$conn->query("DELETE FROM Orders WHERE Orderid='$OrderID' AND Userid='$UserID'");

$conn->close();

header("Location: Profile.php");
?>