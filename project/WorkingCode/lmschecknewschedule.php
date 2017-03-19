#!/usr/bin/php
<?php
$username = $argv[1];
$password = $argv[2];



$db = new mysqli('localhost','root','rootpassword','LunchManagement');
if ($db->connect_errno > 0)
{
   echo "Can not connect to the DB: $db->connect_error".PHP_EOL;
   exit(0);
}
echo "Validating credentials for: $username".PHP_EOL;
$query = "SELECT * from user u inner join role r on u.roleid = r.roleid WHERE uname='$username' and password='$password'";
$result = $db->query($query);

$query2="select roletype from user u inner join role r on u.roleid = r.roleid where uname = '$username' lmit 1;";

$query3= "select scheduledate, restaurantname from restaurantschedule rs
		   inner join restaurant r on rs.restaurantid = r.restaurantid
	           where scheduledate > curdate() 
		   order by scheduledate  ;";

$result3 = $db->query($query3);
$response =  array();


do 
{
if($result->num_rows===0) 
	{
	echo "Either your username and/or password is wrong or you're not authorized to add new restuarants.\r\n";
	}
if ($result->num_rows!=0)
	{
	#echo "Connected!! ".PHP_EOL;
	echo "\n";
	#echo "Trying to execute...".$query3;	this was just to check if the query looked okay 
	#echo "Let's try to add new restaurant.".PHP_EOL;


		    if ($result3->num_rows > 0) {
		    echo "Hi " . $username . ". Here's the schedule for the rest of the week:".PHP_EOL; 

		    echo "\n";
		    // output data of each row
		    while($row = $result3->fetch_assoc()) {
			echo "\n Date:".$row["scheduledate"]."\n Restaurant:".$row["restaurantname"]."\n";
		    }
		    echo "\n";
		    } else {
		    echo "0 results";
		   }


	}

}
 while(0);


echo "\n";
$db->close();
echo "\n";

?>
