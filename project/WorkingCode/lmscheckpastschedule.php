#!/usr/bin/php
<?php
$username = $argv[1];
$password = $argv[2];
$inputdate = $argv[3];



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

$query3= "select date_format(scheduledate,'%W %M %D %Y') as scheduledate , restaurantname from 
		(select scheduledate, restaurantname, '$inputdate' as inputdate, '20170101' as fixeddate 
		from restaurantschedule rs
		inner join restaurant r on rs.restaurantid = r.restaurantid) aa
		where scheduledate > 
			(case when (length(inputdate) < 8 or length(inputdate) = 0 or str_to_date(inputdate, '%Y%m%d') is null) then fixeddate 
		    	else inputdate end)
			and scheduledate < date_format(curdate(), '%Y%m%d')
		order by date_format(scheduledate, '%Y%m%d') ;";

$result3 = $db->query($query3);
#$response =  array();

$query4= "select restaurantname, 
		min(date_format(scheduledate,'%W %M %D %Y')) as First_Order_Date, 
		max(date_format(scheduledate,'%W %M %D %Y')) as Last_Order_Date, 
		count(1) Numer_of_times_ordered from 
		(select scheduledate, restaurantname, '$inputdate' as inputdate, '20170101' as fixeddate 
		from restaurantschedule rs
		inner join restaurant r on rs.restaurantid = r.restaurantid) aa
		where scheduledate > 
			(case when (length(inputdate) < 8 or length(inputdate) = 0 or str_to_date(inputdate, '%Y%m%d') is null) then fixeddate 
		    else inputdate end)
			and scheduledate < date_format(curdate(), '%Y%m%d')
		group by restaurantname
		order by 4 desc ;";

$result4 = $db->query($query4);

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
		    echo "Hi " . $username . ". Here's the historical schedule for date range ". $inputdate . " till today. ".PHP_EOL;
		    echo "If you entered an incorrect date or left it empty. We will show you all the data from 20170101 till today. " .PHP_EOL; 

		    echo "\n";
		    // output data of each row
		    while($row = $result3->fetch_assoc()) {
		    echo "\nDate:".$row["scheduledate"]."\nRestaurant:".$row["restaurantname"]."\n";
		    echo "\n";
		    }
		    echo "\n";
		    } else {
		    echo "0 results. May be one of the paramters enterered have incorrect values.\n Try entering values as ./phpfilename.php username password 'inputdate' ";
		    }


echo "\n";
echo "\n---------------------------------------------------------------------------------------------------------------------------------------\n".PHP_EOL;
echo "\n---------------------------------------------------------------------------------------------------------------------------------------\n".PHP_EOL;
echo "\n";


		    if ($result4->num_rows > 0) {
       	            echo "This displays the Resturant, First Ordered Date, Last Ordered Date, and Total Number or Times Ordered. " .PHP_EOL;

		    echo "\n";
		    // output data of each row
		    while($row = $result4->fetch_assoc()) {
		    echo "\nRestaurant:".$row["restaurantname"]."\nFirst Order Date:".$row["First_Order_Date"]."\nLast Order Date:".$row["Last_Order_Date"]."\nTotal No. of time we ordered:".$row["Numer_of_times_ordered"]."\n";
		    echo "\n";
		    }
		    echo "\n";
		    } else {
		    echo "0 results. May be one of the paramters enterered have incorrect values.\n Try entering values as ./phpfilename.php username password 'inputdate' ";
		    }


	}

}
 while(0);


echo "\n";
$db->close();
echo "\n";

?>
