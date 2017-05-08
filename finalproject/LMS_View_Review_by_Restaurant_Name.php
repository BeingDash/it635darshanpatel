<?php
include("LMS_Login_Validation.php"); // Include loginserv for checking username and password
?>
 
<!doctype html>

<html>

<head>
	<title>LMS_Review_Restaurant</title>
		
	
<style>
body {
	font-family: TIMES NEW ROMAN;
	font-size:90%
	margin: 0;
	padding: 0;
	background-color: #CD4547;
}

h1 {
	font-size: 250%;
	color: #CD4547;
}

h2 {
	font-size: 150%;
	color: #CD4547;
	margin-bottom: 0;
}

h3 {
	font-size: 125%;
	color: #CD4547;
	margin-bottom: 0;
}

h4 {
	font-size: 75%;
	color: green;
	margin-bottom: 0;
}

img {padding-right: .25em; }
a:link {
	color:#FF0000;
	text-decoration: none;
	}
a:visited {color:#00FF00:}
a:hover {color:#FF00DD;}
a:Active{color:#0000FF:}
li { margin-top: .5em;}

#page {
	width: 1000px;
	min-height: 700px;
	margin: 0 auto;
	padding: 10px;
	border: 2.5px solid black;
	background-color: white;
	-moz-border-radius: 2em 6em 1em 5em;
	border-radius: 2em 6em 1em 5em;
	}

#header {
	margin-top: 0;
}

#header h3 {
	font-style: italic;
	padding-bottom: 1em;
	border-bottom:2.5px solid black;
}

#main { 
	margin-right: 400px;
		}

#main p {
	color: Black;
	margin-top: 2.5em;
	margin-left: 1em;
	margin-bottom: 0;
	}
	
#menu {
	width: 900px;
	margin: 2;
	}
	
#menu ul {
	margin: 0;
	padding: 0;
	list-style: none;
	}
	
#menu li {
	margin: 2px 0 0;
	display: inline;
	float: left;
	}

#menu a {
	display:block;
	width: 110px;
	padding: 2px 2px 2px 10px;
	border: 1px solid #000000;
	background: #CD4547;
	color: #ffffff;
	text-decoration: none;
	font-family: IMPACT;
	font-style: oblique;
	-moz-border-radius: 2em 6em 1em 5em;
	border-radius: 2em 6em 1em 5em;
	}
	
#menu a:hover {
border: 1.5px solid #000000;
background :green;
color: #ffffff;
}
	
	
#sidebar {
	width: 300px;
	padding: 10px;
	float: right;
	list-style: none;
}
	
#sidebar h2 {
	padding-bottom: .5em;
	border-bottom: 2.5px solid black;
	}

#sidebar h3 {
	padding-bottom: .5em;
	border-bottom: 2.5px solid black;
	}
	
.sidebar_item {
	font-size: 100%;
	line-height:1.5;
	margin-top: 1em;
	color: black;
	}
	
	
		
</style>	
</head>

	<body>

				
		<div id="page">
			<div id="header">
				<img src="https://pbs.twimg.com/profile_images/674751506269265920/_jrN4zj4.jpg" alt="Picture of Lunch" style="float: left" width="100px" height="100px" />
				<h1>Lunch Management System</h1>
				<h3>By the People, For the People</h3>
		
			</div>
				

			
			<div id="menu">
			<ul>
				<li><a href="index.html" title="Log-Out" onclick="return confirm('Are you sure you want to leave this page? You will have to log in again')" class="links">Home</a><li>
				<li><a href="LMS_Review.php">Post Review</a><li>
				<li><a href="LMS_View_Review.php"  onclick="return confirm('Are you sure you want to leave this page? You will be able to search reviews by other paramters.')" 					class="links">View Review</a><li>
				<li><a href="LMS_Restaurant.php">Restaurant</a><li>	
				<li><a href="index.html" title="Log-Out" onclick="return confirm('Are you sure you want to log out?')" class="links">Log Out</a><li>
			</ul>
			</div>	
			
			
			
			<div id="main">
			<br>
			<H2>Reviews based on Restaurant Keyword Search</H2>
			<br>
			<table cellspacing="1" border="1">
			<tr><th>Restaurant</th><th>Review</th><th>Rating</th><th>Date</th></tr>


<?php
$restaurant=$_POST['p_restaurant'];

$db_connection = new mysqli("localhost", "root", "rootpassword", "LunchManagement");
  
	if ($db_connection->connect_error) 
	{
      		die("Connection failed: " . $db_connection->connect_error);
	}

   
$query1="select restaurantname, review, rating, date(review_timestamp) dates From restaurantreview rr
inner join restaurant r on rr.restaurantid = r.restaurantid
where  
rr.restaurantid in (select restaurantid from restaurant where restaurantname = '$restaurant' or restaurantname like '%" . $restaurant . "%')
order by restaurantname, dates desc, rating desc ";
	
$result1 = $db_connection->query($query1); 




				        if ($result1->num_rows > 0) {
				        echo "\n";
				        // output data of each row
				        while($row = $result1->fetch_assoc()) {

?>
					<tr>
					<td>					
				  <?php echo $row["restaurantname"];?>
					</td>
					<td>
				  <?php echo $row["review"];?>
					</td>
					<td>
				  <?php echo $row["rating"];?>
					</td>
					<td>
				  <?php echo $row["dates"];?>				
<?php				        echo "\n";
				        }
				        echo "\n";
				        }
       


$db->close();
echo "\n";
?>
					</td>
					</tr>
					</table>
					</div>


</div>
</body>
</html>



