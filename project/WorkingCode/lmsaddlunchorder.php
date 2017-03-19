#!/usr/bin/php
<?php
$username = $argv[1];
$password = $argv[2];
$orderitem = $argv[3];

$db = new mysqli('localhost','root','rootpassword','LunchManagement');
if ($db->connect_errno > 0)
{
   echo "Can not connect to the DB:". $db->connect_error.PHP_EOL;
   exit(0);
}
echo "Validating credentials for: $username".PHP_EOL;
$query = "SELECT * FROM user WHERE uname='$username' and password='$password';";
$result = $db->query($query);

$query2="select roletype from user u inner join role r on u.roleid = r.roleid where uname = '$username' lmit 1;";

$query3="insert into lunchorder(orderitem,uid,restaurantid,orderdate) VALUES 
			('$orderitem',
				(select uid from user where uname = '$username'),
				(select restaurantid from restaurantschedule where scheduledate = date_format(curdate(), '%Y%m%d')),
                date_format(curdate(), '%Y%m%d'));";
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
	echo "Hey there ". $username . ", " . $orderitem . " is a great option. Let's see if we can place that order.".PHP_EOL;

		if ($db->query($query3) === TRUE) {
		    echo "\n";
		    echo "Your lunch order has been placed successfully and it should be delivered soon.".PHP_EOL;
		    echo "\n";
		} else {
		    echo "\n";
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
