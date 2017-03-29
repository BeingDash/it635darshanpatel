#!/usr/bin/php
<?php
$username = $argv[1];
$password = $argv[2];
$review = $argv[3];
$restaurant = $argv[4];
$rating = $argv[5];

$db = new mysqli('localhost','root','12345','LunchManagement');
if ($db->connect_errno > 0)
{
   echo "Can not connect to the DB: $db->connect_error".PHP_EOL;
   exit(0);
}
echo "Validating credentials for: $username".PHP_EOL;
$query = "SELECT * FROM user WHERE uname='$username' and password='$password';";
$result = $db->query($query);

$query2="select roletype from user u inner join role r on u.roleid = r.roleid where uname = '$username' lmit 1;";


$validatationquery = "select * From restaurantreview where  
restaurantid = (select restaurantid from restaurant where restaurantname = '$restaurant' or restaurantname like '%" . $restaurant . "%')
and uid = (select uid from user where uname = '$username')
and date_format(review_timestamp, '%Y%m%d') =  date_format(curdate(), '%Y%m%d')
and restaurantid in 
(select rs.restaurantid from restaurantschedule rs 
inner join  restaurant r on rs.restaurantid = r.restaurantid 
where (restaurantname = '$restaurant' or restaurantname like '%" . $restaurant . "%')
and str_to_date(scheduledate,'%Y%m%d') >= date_add(scheduledate, interval -7 day) 
and str_to_date(scheduledate,'%Y%m%d') <= curdate());";
$result2 = $db->query($validatationquery);
 

$query3="insert into restaurantreview (restaurantid,uid,review,rating) VALUES 
			((select restaurantid from restaurant where restaurantname = '$restaurant' or restaurantname like '%" . $restaurant . "%'),
			 (select uid from user where uname = '$username'),
			 '$review','$rating');";

$query4="select restaurantname, truncate(avg(rating),2) rating 
from restaurantreview rr
inner join restaurant r on rr.restaurantid = r.restaurantid
group by restaurantname 
order by 2 desc";
$result4 = $db->query($query4);


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
	echo "Hey there ". $username . ". Let's see if we can find a restaurnat with the keyword you entered add that review for ".$restaurant.".".PHP_EOL;

              		if($result2->num_rows===0)
			{
			echo "Processing Your Request...".PHP_EOL;
			if ($db->query($query3) === TRUE) 
			    {
			    echo "\n";
			    echo "Your review and ratings have been entered. We know lunches are important for our employees and we will take this review in to consideration.".PHP_EOL;
			    echo "\n";

					$query4="select restaurantname, truncate(avg(rating),2) average_rating, group_concat(concat(empname,': ',review)) reviewer_and_review
					from restaurantreview rr
					inner join restaurant r on rr.restaurantid = r.restaurantid
					inner join user u on rr.uid = u.uid
					inner join employees e on u.empid = e.empid
					group by restaurantname 
					order by 2 desc";
					$result4 = $db->query($query4);


					echo "\n";
					echo "\n---------------------------------------------------------------------------------------------------------------------------------------".PHP_EOL;
					echo "---------------------------------------------------------------------------------------------------------------------------------------\n".PHP_EOL;
					echo "\n";


				        if ($result4->num_rows > 0) {
		       	                echo "Here are the aggregate ratings of our restaurants... " .PHP_EOL;

				        echo "\n";
				        // output data of each row
				        while($row = $result4->fetch_assoc()) {
		       		        echo "\nRestaurant:".$row["restaurantname"]."\nRatings:".$row["average_rating"]."\nReviews:".$row["reviewer_and_review"]."\n";
				        echo "\n";
				        }
				        echo "\n";
				        }


			    } 
 		            else 
                            {
			    echo "\n";
			    echo "Either there is no restuarant called '". $restaurant . "' or the search string associates with multiple restaurants. Please check if you typed the name correctly. If you want to recommend some restuarant so you can review later, there is a way you can do it.".PHP_EOL;
			    echo "Error: " . $query3 . "<br>" . $db->error;
			    echo "\n";
			    }
			}		
           		if($result2->num_rows!=0)
			{ 
			echo "Can't Process your request. May be you already entered a review for this restaurant in past few days or we haven't entered from this place in last one week.".PHP_EOL;
			}



	}

}
 while(0);
echo "\n";
$db->close();
echo "\n";
?>
