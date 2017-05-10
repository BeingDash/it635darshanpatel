<?php
session_start();

include("LMS_Login_Validation.php"); // Include loginserv for checking username and password
?>
 
<!doctype html>

<html>

<head>
	<title>LMS_Review_Restaurant_By_Review</title>
		
	
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
				<li><a href="LMS_View_Review.php">View Review</a><li>
				<li><a href="LMS_Restaurant.php">Restaurant</a><li>
				<li><a href="LMS_Add_User.php">Add User</a><li>					
				<li><a href="index.html" title="Log-Out" onclick="return confirm('Are you sure you want to log out?')" class="links">Log Out</a><li>
			</ul>
			</div>	
			
			
			
			<div id="main">
			<br>
			<H2>Restaurant List</H2>
			<H3>This is communicating with Mongo DB.</H3>
			<br>
			<table cellspacing="1" border="1">
			<tr>
			<th>Restaurant</th>
			<th>Address</th>
			<th>City</th>
			<th>State</th>
			<th>Phone</th>
			<th>Contact Person</th>
			<th>Food Type</th>
			</tr>



<?php

try
{

$connection = new MongoDB\Driver\Manager( "mongodb://test:test@ds159220.mlab.com:59220/lunchmanagementsystem"); // connect to a remote host at a given port
$command = new MongoDB\Driver\Command(['ping' => 1]);
$connection->executeCommand('db', $command);
$servers = $connection->getServers();
/*print_r($servers);*/
$filter = array('rtype'=>'mexican');
$query = new MongoDB\Driver\Query($filter);
$results = $connection->executeQuery("lunchmanagementsystem.restaurant",$query);


foreach ($results as $output) 
{
$rname = $output->rname;
$raddress = $output->raddress;
$rcity = $output->rcity;
$rstate = $output->rstate;
$rphone = $output->rphone;
$rcontact = $output->rcontact;
$rtype = $output->rtype;

?>
					<tr>
					<td>					
				  <?php echo $rname;?>
					</td>
					<td>
				  <?php echo $raddress;?>
					</td>
					<td>
				  <?php echo $rcity;?>
					</td>
					<td>					
				  <?php echo $rstate;?>
					</td>
					<td>
				  <?php echo $rphone;?>
					</td>
					<td>
				  <?php echo $rcontact;?>
					</td>
					<td>
				  <?php echo $rtype;?>
					</td>
					</tr>

<!-- echo $rname.".".$raddress." ".$rcity.": ".$rstate.",".$rphone.",".$rcontact.",".$rtype;
echo "\r\n";
echo "\r\n"; -->

<?php
}
}
catch(exception $e)
{
	print_r($e);
}

?>


					</table>
					</div>


</div>
</body>
</html>



