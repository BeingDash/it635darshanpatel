#!/usr/bin/php
<?php
$username = $argv[1];
$password = $argv[2];
$review = $argv[3];
$restaurant = $argv[4];

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

$query3="insert into restaurantreview (restaurantid,uid,review) VALUES 
			((select restaurantid from restaurant where restaurantname = '$restaurant' or restaurantname like '%" . $restaurant . "%'),
			 (select uid from user where uname = '$username'),
			 '$review');";
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
	echo "Hey there ". $username . ". Let's see if we can find a restraurnat with the keyword you entered add that review for ".$restaurant.".".PHP_EOL;

		if ($db->query($query3) === TRUE) {
		    echo "\n";
		    echo "Your review has been entered. We know lunches are important for our employees and we will take this review in to consideration.".PHP_EOL;
		    echo "\n";
		} else {
		    echo "\n";
		    echo "Either there is no restuarant called '". $restaurant . "' or the search string associates with multiple restaurants. Please check if you typed the name correctly. 
			  If you want to recommend some restuarant so you can review later, there is a way you can do it.".PHP_EOL;
		    echo "Error: " . $query3 . "<br>" . $db->error;
	            echo "\n";
		}		


	}

}
 while(0);
echo "\n";
$db->close();
echo "\n";

?>
