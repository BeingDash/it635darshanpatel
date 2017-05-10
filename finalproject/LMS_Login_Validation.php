<?php

session_start();

include 'LMS_DB_Connection.php';

$error=''; //Variable to Store error message;
if(isset($_POST['p_login'])){
if(empty($_POST['p_user']) || empty($_POST['p_password'])){
$error = "Username or Password is Invalid";
}
else
{


$user=$_POST['p_user'];
$pass=$_POST['p_password'];
$hashed = hash('sha256',$pass);


//this is the query i used to hash password in databases
//update user set password = sha2(password,256) where uid in (1,2)

$query = mysqli_query($conn, "SELECT * FROM user WHERE password='$hashed' AND uname='$user'");
$result = $conn->query($query); 

$rows = mysqli_num_rows($query);

//added this section to test session

	if (isset($_SESSION['uname']))	{
		echo $_SESSION['uname'];
	} else {
		echo "";
	}

//session section ends here 	


 if($rows == 1){
 header("Location: LMS_Review.php"); // Redirecting to other page
 $_SESSION['uname'] = $rows["uname"];
 }
 else
 {
 $error = "Username or Password is Invalid";
 }
 mysqli_close($conn); // Closing connection
 }
}



?>


