#!/usr/bin/php
<?php
$db = new mysqli("localhost","root","rootpassword","LunchManagement");

//this is a C++ style comment
/* this is a c style comment */
# shell style comment 


if ($db -> connect_errno != 0)
{	
	echo "error connecting to db" .	$db -> connect_error.PHP_EOL;
	exit();
}

echo "successfully connected!".PHP_EOL;


$query  = "select l.* from lunchorder l 
	   inner join user u on l.uid = u.uid 
	   inner join employees e on u.uid = e.empid
	   where e.empname like '%Darsh%'  ;";

$queryresponse = $db -> query($query);

/*var_dump ($queryresponse); */   #this was to display the column information. We probably do not need this. 

while($row = $queryresponse -> fetch_assoc())

{
	print_r($row);
}


$db -> close();

echo "program closed";


?>
