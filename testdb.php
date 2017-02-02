#!/usr/bin/php
<?php
$db = new mysqli("localhost","root","rootpassword","Classes");

//this is a C++ style comment
/* this is a c style comment */
# shell style comment 


if ($db -> connect_errno != 0)
{	
	echo "error connecting to db" .	$db -> connect_error.PHP_EOL;
	exit();
}

echo "successfully connected!".PHP_EOL;


$query  = "select * from class;";

$queryresponse = $db -> query($query);

var_dump ($queryresponse);

while($row = $queryresponse -> fetch_assoc())

{
	print_r($row);
}


$db -> close();

echo "program closed";


?>
