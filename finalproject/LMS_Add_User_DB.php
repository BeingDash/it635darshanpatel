<?php

session_start();

include 'LMS_DB_Connection.php';

$adduser=$_POST['p_adduser'];
$addpass=$_POST['p_addpassword'];

$addemail=$_POST['p_addemail'];
$addrole=$_POST['p_addrole'];


$query1="insert into user 
(uname, password, empid, email, create_timestamp, roleid)
values 
('$adduser',sha2('$addpass',256),NULL,'$addemail',sysdate(),'$addrole');";

$result1 = $conn->query($query1); 

header("Location: LMS_View_User.php");


?>



