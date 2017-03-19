#!/usr/bin/php
<?php
$username = $argv[1];
$password = $argv[2];
$restaurantrecomendation = $argv[3];

$db = new mysqli('localhost','root','rootpassword','LunchManagement');
if ($db->connect_errno > 0)
{
   echo "Can not connect to the DB: $db->connect_error".PHP_EOL;
   exit(0);
}
echo "Validating credentials for: $username".PHP_EOL;
$query = "SELECT * FROM user WHERE uname='$username' and password='$password';";
$result = $db->query($query);

$query2="select roletype from user u inner join role r on u.roleid = r.roleid where uname = '$username' lmit 1;";

$query3="insert into restaurantrecomendation (uid,recomendation) VALUES 
			((select uid from user where uname = '$username'),
			 '$restaurantrecomendation');";
/*
echo "executing SQL statement:\n".$query3."\n";
	if (!$this->db->query($query3))
	{
		echo "failed to insert record for $username".PHP_EOL;
	}*/

do 
{
if($result->num_rows===0)
	{
	echo "Authentication error\r\n";
	}
if ($result->num_rows!=0)
	{
	echo "Connected!! ".PHP_EOL;
	echo "\n";
	#echo "Trying to execute...".$query3;	this was just to check if the query looked okay 
	echo "What's up ". $username . ". Everyone loves to try new places to eat. Let's go ahead and try to add the restaurant you recommended.".PHP_EOL;

		if ($db->query($query3) === TRUE) {
		    echo "\n";
		    echo "Your recomendation has been entered. We hope it is in 25 miles radius. We will do some R&D on that.".PHP_EOL;
		    echo "\n";
		} else {
		    echo "\n";
		    echo "OOPSS.".PHP_EOL;
		    echo "Error: " . $query3 . "\n" . $db->error;
	            echo "\n";
		}		


	}

}
 while(0);
echo "\n";
$db->close();
echo "\n";

?>
