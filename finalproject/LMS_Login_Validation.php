<?php
$error=''; //Variable to Store error message;
if(isset($_POST['p_login'])){
 if(empty($_POST['p_user']) || empty($_POST['p_password'])){
 $error = "Username or Password is Invalid";
 }
 else
 {
 //Define $user and $pass
 $user=$_POST['p_user'];
 $pass=$_POST['p_password'];
 //Establishing Connection with server by passing server_name, user_id and pass as a patameter
 $conn = mysqli_connect("localhost", "root", "rootpassword");
 //Selecting Database
 $db = mysqli_select_db($conn, "LunchManagement");
 //sql query to fetch information of registerd user and finds user match.
 $query = mysqli_query($conn, "SELECT * FROM user WHERE password='$pass' AND uname='$user'");
 
 $rows = mysqli_num_rows($query);
 if($rows == 1){
 header("Location: LMS_Review.php"); // Redirecting to other page
 }
 else
 {
 $error = "Username or Password is Invalid";
 }
 mysqli_close($conn); // Closing connection
 }
}
 
?>
