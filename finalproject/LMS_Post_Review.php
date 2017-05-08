<?php
$reviewtaco=$_POST['p_review_tacobell'];
$ratingtaco=$_POST['p_rating_tacobell'];

$reviewsub=$_POST['p_review_subway'];
$ratingsub=$_POST['p_rating_subway'];

$reviewmausam=$_POST['p_review_mausam'];
$ratingmausam=$_POST['p_rating_mausam'];

$reviewpanera=$_POST['p_review_panera'];
$ratingpanera=$_POST['p_rating_panera'];

$reviewromeos=$_POST['p_review_romeos'];
$ratingromeos=$_POST['p_rating_romeos'];

$reviewticktock=$_POST['p_review_ticktock'];
$ratingticktock=$_POST['p_rating_ticktock'];

$reviewgold=$_POST['p_review_gold'];
$ratinggold=$_POST['p_rating_gold'];

$reviewbg=$_POST['p_review_bg'];
$ratingbg=$_POST['p_rating_bg'];

$reviewchipotle=$_POST['p_review_chipotle'];
$ratingchipotle=$_POST['p_rating_chipotle'];

$reviewke=$_POST['p_review_ke'];
$ratingke=$_POST['p_rating_ke'];

$user=$_POST['p_user'];
$pass=$_POST['p_password'];
$db_connection = new mysqli("localhost", "root", "rootpassword", "LunchManagement");
  
	if ($db_connection->connect_error) 
	{
      		die("Connection failed: " . $db_connection->connect_error);
	}

   
$query1="insert into restaurantreview (restaurantid,uid,review,rating) VALUES 
			((select restaurantid from restaurant where restaurantname = 'taco bell'),
			 (select uid from user where uname = '$user'),
			 '$reviewtaco','$ratingtaco');";
	
	$result1 = $db_connection->query($query1); 


$query2="insert into restaurantreview (restaurantid,uid,review,rating) VALUES 
			((select restaurantid from restaurant where restaurantname = 'Subway'),
			 (select uid from user where uname = '$user'),
			 '$reviewsub','$ratingsub');";
	
	$result2 = $db_connection->query($query2);

$query3="insert into restaurantreview (restaurantid,uid,review,rating) VALUES 
			((select restaurantid from restaurant where restaurantname = 'Mausam'),
			 (select uid from user where uname = '$user'),
			 '$reviewmausam','$ratingmausam');";
	
	$result3 = $db_connection->query($query3);

$query4="insert into restaurantreview (restaurantid,uid,review,rating) VALUES 
			((select restaurantid from restaurant where restaurantname = 'Panera Bread' or restaurantname like '%panera%'),
			 (select uid from user where uname = '$user'),
			 '$reviewpanera','$ratingpanera');";
	
	$result4 = $db_connection->query($query4);

$query5="insert into restaurantreview (restaurantid,uid,review,rating) VALUES 
			((select restaurantid from restaurant where restaurantname = 'Romeos Pizza' or restaurantname like '%romeos%'),
			 (select uid from user where uname = '$user'),
			 '$reviewromeos','$ratingromeos');";
	
	$result5 = $db_connection->query($query5);

$query6="insert into restaurantreview (restaurantid,uid,review,rating) VALUES 
			((select restaurantid from restaurant where restaurantname = 'tick tock' or restaurantname like '%tick%tock%'),
			 (select uid from user where uname = '$user'),
			 '$reviewticktock','$ratingticktock');";
	
	$result6 = $db_connection->query($query6);

$query7="insert into restaurantreview (restaurantid,uid,review,rating) VALUES 
			((select restaurantid from restaurant where restaurantname = '15 golden tulip' or restaurantname like '%golden%'),
			 (select uid from user where uname = '$user'),
			 '$reviewgold','$ratinggold');";
	
	$result7 = $db_connection->query($query7);

$query8="insert into restaurantreview (restaurantid,uid,review,rating) VALUES 
			((select restaurantid from restaurant where restaurantname = 'bollywood grill' or restaurantname like '%bollywood%'),
			 (select uid from user where uname = '$user'),
			 '$reviewbg','$ratingbg');";
	
	$result8 = $db_connection->query($query8);

$query9="insert into restaurantreview (restaurantid,uid,review,rating) VALUES 
			((select restaurantid from restaurant where restaurantname = 'chipotle' or restaurantname like '%chipotle%'),
			 (select uid from user where uname = '$user'),
			 '$reviewchipotle','$ratingchipotle');";
	
	$result9 = $db_connection->query($query9);

$query10="insert into restaurantreview (restaurantid,uid,review,rating) VALUES 
			((select restaurantid from restaurant where restaurantname = 'kosher experience' or restaurantname like '%kosher%'),
			 (select uid from user where uname = '$user'),
			 '$reviewke','$ratingke');";
	
	$result10 = $db_connection->query($query10);


header("Location: LMS_View_Review.php");

	echo "Rating Information added <br> <br>";
	echo $reviewtaco;
echo $user;

	echo '<form action="http://localhost/LMS_Review.php" method="post">';
	echo '<input type="submit" value="Add Another Client" name="Submit" /> </form>';
	echo '<form action="http://localhost/index.html" method="post">';
	echo '<input type="submit" value="Go Home" name="home" /> </form>';
?>

<?php


