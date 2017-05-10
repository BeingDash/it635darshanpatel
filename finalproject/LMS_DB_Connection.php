<?php
$servername = "localhost";
$username = "root";
$password = "rootpassword";

$conn =  mysqli_connect($servername, $username, $password, "LunchManagement");
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
echo "";
?>
