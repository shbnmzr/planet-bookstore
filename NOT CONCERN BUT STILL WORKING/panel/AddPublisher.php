<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shabnamoptionalname";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("INSERT INTO Publisher (title) VALUES (?)");
$stmt->bind_param("s", $title);


$title = "Jangal Publications";

if($conn->query("SELECT PublisherID FROM Publisher WHERE Title='$title'")->num_rows == 0)
	$stmt->execute();




$title = "Planet Independent Publications";
if($conn->query("SELECT PublisherID FROM Publisher WHERE Title='$title'")->num_rows == 0)
	$stmt->execute();

echo "New records created successfully";

$stmt->close();
$conn->close();
?> 