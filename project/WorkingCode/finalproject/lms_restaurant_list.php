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

$query3= "select restaurantname rn,  
		restaurantaddress1 ra1,
		restaurantcity rc,
		restaurantstate rs,
		restaurantzip rz,
		restaurantphone rp,
		restaurantemail re,
		restaurantcontactperson rcp
		From restaurant ;";

$result3 = $db->query($query3);

do 
{
if($result->num_rows===0) 
	{
	echo "Authentication Error.\r\n";
	}
if ($result->num_rows!=0)
	{
	#echo "Connected!! ".PHP_EOL;
	echo "\n";
	#echo "Trying to execute...".$query3;	this was just to check if the query looked okay 
	#echo "Let's try to add new restaurant.".PHP_EOL;


		    if ($result3->num_rows > 0) {
		    echo "List of Resturants with their details...".PHP_EOL;
		    echo "\n";
		    // output data of each row
		    while($row = $result3->fetch_assoc()) {
		    echo "\nRestaurant Name:".$row["rn"]."\nRestaurant Address:".$row["ra1"]."\nRestaurant City:".$row["rc"]."\nRestaurant State:".$row["rs"]."\nRestaurant Zip:".$row["rz"]."\nRestaurant Phone:".$row["rp"]."\nRestaurant Email:".$row["re"]."\nRestaurant Contact Person:".$row["rcp"]."\n";
		    echo "\n";
		    }
		    echo "\n";
		    } else {
		    echo "0 results. May be one of the paramters enterered have incorrect values.\n Try entering values as ./phpfilename.php username password 'inputdate' ";
		    }


echo "\n";
echo "\n--------------------------------------------------END OF RECORDS-----------------------------------------------------------------------".PHP_EOL;
echo "---------------------------------------------------------------------------------------------------------------------------------------\n".PHP_EOL;
echo "\n";



	}

}
 while(0);


echo "\n";
$db->close();
echo "\n";

?>
