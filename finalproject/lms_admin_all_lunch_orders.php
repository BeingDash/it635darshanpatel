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
$query = "SELECT * from user u inner join role r on u.roleid = r.roleid WHERE uname='$username' and password='$password' and roletype = 'admin';";
$result = $db->query($query);

$query2="select roletype from user u inner join role r on u.roleid = r.roleid where uname = '$username' lmit 1;";

$restaurantname="select restaurantname from restaurantschedule rs
inner join restaurant r on rs.restaurantid = r.restaurantid 
where scheduledate = curdate();";
$restaurantnameresult = $db->query($restaurantname);

$lunchorder = "select l.uid, empname, orderitem, orderdate from lunchorder l
inner join user u on l.uid = u.uid 
inner join employees e on u.empid = e.empid 
where orderdate = curdate();";
$lunchorderresult = $db->query($lunchorder);
 
$ratingreview="select aaa.* From restaurantschedule rs 
inner join 
(select restaurantid, restaurantname, avg_rating, total_reviews,  
case when avg_rating = 5 then concat('mostly ' ,ratingdescription) 
when avg_rating > 4 and avg_rating < 5 then 'between good and excellent'
when avg_rating = 4 then concat('mostly ' ,ratingdescription)  
when avg_rating > 3 and avg_rating < 4 then 'between average and good'
when avg_rating = 3 then concat('mostly ' ,ratingdescription)  
when avg_rating > 2 and avg_rating < 3 then 'between bad and average'
when avg_rating = 2 then concat('mostly ' ,ratingdescription)  
when avg_rating > 1 and avg_rating < 2 then 'between horrible and bad'
when avg_rating = 1 then concat('mostly ' ,ratingdescription)  end as ratingdescription
From 
(select r.restaurantid, restaurantname, truncate(avg(rr.rating),2) avg_rating, count(1) total_reviews from restaurantreview rr 
inner join restaurant r on rr.restaurantid = r.restaurantid
group by r.restaurantid,restaurantname) aa
left join ratingmaster rm on aa.avg_rating = rm.rating) aaa
on rs.restaurantid = aaa.restaurantid 
and scheduledate = curdate();";
$ratingreviewresult = $db->query($ratingreview);

$employeesnotorderedyet="select * From employees e 
inner join user u on e.empid = u.empid 
where u.uid not in 
(select uid from lunchorder l 
where orderdate = curdate())
and e.empid not in 
(Select empid from empdayoff 
where dayoffdate = curdate());";
$employeesnotorderedyetresult = $db->query($employeesnotorderedyet);

$employeesnotintoday="select empname, reason from employees e 
inner join empdayoff ed
on e.empid = ed.empid 
where dayoffdate = curdate();";
$employeesnotintoday = $db->query($employeesnotintoday);


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
	echo "Either your username and/or password is wrong or you're not authorized to view lunch orders of all the employees.\r\n";
	}
if ($result->num_rows!=0)
	{
	#echo "Connected!! ".PHP_EOL;
	echo "\n";
	#echo "Trying to execute...".$query3;	this was just to check if the query looked okay 
	#echo "Hi Admin, Here are lunch orders for the day and detailed reports.".$restaurant.".".PHP_EOL;

              	   if ($ratingreviewresult->num_rows > 0) {
		    echo "Hi Admin." .PHP_EOL; 
		    // output data of each row
		    while($row = $ratingreviewresult->fetch_assoc()) {
			echo "Today we will be ordering from ".$row["restaurantname"]." which has an average rating of ".$row["avg_rating"]." from ".$row["total_reviews"]." user reviews and them being ".$row["ratingdescription"]."."."\n";
		    }
		    echo "\n";

		        echo "\n---------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL;
		        echo "---------------------------------------------------------------------------------------------------------------------------------------\n".PHP_EOL;       		        if ($lunchorderresult->num_rows > 0) {
		        echo "Here are the Lunch orders of all the employees... " .PHP_EOL; 
			echo "\n";
		        while($row = $lunchorderresult->fetch_assoc()) {
       		        echo "\nUID:".$row["uid"]."\nEmployee Name:".$row["empname"]."\nOrder Item:".$row["orderitem"]."\n";
		        echo "\n";
		        } 
		        echo "\n";
				
			        echo "\n---------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL;
			        echo "---------------------------------------------------------------------------------------------------------------------------------------\n".PHP_EOL;
				if ($employeesnotorderedyetresult->num_rows > 0) {
			        echo "Here are the employees who haven't ordered yet today... " .PHP_EOL;
				echo "\n";
				while($row = $employeesnotorderedyetresult->fetch_assoc()) {
	       		        echo "\nEmployee Name:".$row["empname"]."\n";
				echo "\n";
				} 
				echo "\n";


					echo "\n---------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL;
					echo "---------------------------------------------------------------------------------------------------------------------------------------\n".PHP_EOL;
					if ($employeesnotintoday->num_rows > 0) {
					echo "Here are the employees who are out of the office today and the reason if they cared to share." .PHP_EOL;
					echo "\n";
					while($row = $employeesnotintoday->fetch_assoc()) {
		       		        echo "\nEmployee Name:".$row["empname"]."\nWhere are they? What happened?:".$row["reason"]."\n";
					echo "\n";
					} 
					echo "\n";
					} else { 
					echo "No One is out Today!";
					}

	
				} else { 
				echo "Everyone Ordered Today!\n";
	
					if ($employeesnotintoday->num_rows > 0) {
					echo "Here are the employees who are out of the office today and the reason if they cared to share." .PHP_EOL;
					echo "\n";
					while($row = $employeesnotintoday->fetch_assoc()) {
		       		        echo "\nEmployee Name:".$row["empname"]."\nWhere are they? What happened?:".$row["reason"]."\n";
					echo "\n";
					} 
					echo "\n";
					} else { 
					echo "No One is out Today!";
					}

				}

		        } else { 
			echo "No one ordered yet. May be they dont like the restaurant? Gotta find out..!!";
			}


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
