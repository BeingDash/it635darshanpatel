#!/usr/bin/php
<?php
$username = $argv[1];
$password = $argv[2];
$restaurantname = $argv[3];
$restaurantaddress1 = $argv[4];
$restaurantphone = $argv[5];


$db = new mysqli('localhost','root','12345','LunchManagement');
if ($db->connect_errno > 0)
{
   echo "Can not connect to the DB: $db->connect_error".PHP_EOL;
   exit(0);
}
echo "Validating credentials for: $username".PHP_EOL;
$query = "SELECT * from user u inner join role r on u.roleid = r.roleid WHERE uname='$username' and password='$password' and roletype = 'admin';";
$result = $db->query($query);

$query2="select roletype from user u inner join role r on u.roleid = r.roleid where uname = '$username' lmit 1;";

$query3="insert into restaurant (restaurantname,restaurantaddress1,restaurantphone,delivery) VALUES 
			('$restaurantname','$restaurantaddress1','$restaurantphone','Y');";


do 
{
if($result->num_rows===0) 
	{
	echo "Either your username and/or password is wrong or you're not authorized to add new restuarants.\r\n";
	}
if ($result->num_rows!=0)
	{
	echo "Connected!! ".PHP_EOL;
	echo "\n";
	#echo "Trying to execute...".$query3;	this was just to check if the query looked okay 
	echo "Let's try to add new restaurant.".PHP_EOL;

		if ($db->query($query3) === TRUE) {
		    echo "\n";
		    echo "New restaurant has been enterered.".PHP_EOL;
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
