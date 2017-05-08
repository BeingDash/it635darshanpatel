<?php
include("LMS_Login_Validation.php");



?>
 
<!doctype html>

<html>

<head>
	<title>LMS_Review</title>
		
	
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
	min-height: 800px;
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
				<li><a>Post Review</a><li>
				<li><a href="LMS_View_Review.php">View Review</a><li>
				<li><a href="LMS_Restaurant.php">Restaurant</a><li>	
				<li><a href="index.html" title="Log-Out" onclick="return confirm('Are you sure you want to log out?')" class="links">Log Out</a><li>
			</ul>
			</div>	
			
			
			
			<div id="main">
				<br>
				<H2>Review & Ratings</H2>
				<H3>Please submit your reviews and ratings for all the restaurants we order from.</H3>
				<br>
				<form method="post" action="LMS_Post_Review.php">
				<table cellspacing="2" border="1">
				<tr>
				<th>Restaurant</th>
				<th>Review</th>
				<th>Rating</th>
				</tr>
				<tr>
				<td id="tacobell">Taco bell</td>
				<td align="left"><input type="text" id="p_review_tacobell" name="p_review_tacobell"/></td>
				<td align="left"><input type="text" id="p_rating_tacobell" name="p_rating_tacobell"/></td>
				</td>
				</tr>
				<tr>
				<td id="subway">Subway</td>
				<td align="left"><input type="text" id="p_review_subway" name="p_review_subway"/></td>
				<td align="left"><input type="text" id="p_rating_subway" name="p_rating_subway"/></td>
				</td>
				</tr>
				<tr>
				<td id="Mausam">Mausam</td>
				<td align="left"><input type="text" id="p_review_mausam" name="p_review_mausam"/></td>
				<td align="left"><input type="text" id="p_rating_mausam" name="p_rating_mausam"/></td>
				</td>
				</tr>
				<tr>
				<td id="Panera">Panera Bread</td>
				<td align="left"><input type="text" id="p_review_panera" name="p_review_panera"/></td>
				<td align="left"><input type="text" id="p_rating_panera" name="p_rating_panera"/></td>
				</td>
				</tr>
				<tr>
				<td id="Romeos">Romeos Pizza</td>
				<td align="left"><input type="text" id="p_review_romeos" name="p_review_romeos"/></td>
				<td align="left"><input type="text" id="p_rating_romeos" name="p_rating_romeos"/></td>
				</td>
				</tr>

				<tr>
				<td id="TickTock">Tick Tock Diner</td>
				<td align="left"><input type="text" id="p_review_ticktock" name="p_review_ticktock"/></td>
				<td align="left"><input type="text" id="p_rating_ticktock" name="p_rating_ticktock"/></td>
				</td>
				</tr>

				<tr>
				<td id="GoldenTulip">15 Golden Tulip</td>
				<td align="left"><input type="text" id="p_review_gold" name="p_review_gold"/></td>
				<td align="left"><input type="text" id="p_rating_gold" name="p_rating_gold"/></td>
				</td>
				</tr>

				<tr>
				<td id="BollywoodGrill">Bollywood Grill</td>
				<td align="left"><input type="text" id="p_review_bg" name="p_review_bg"/></td>
				<td align="left"><input type="text" id="p_rating_bg" name="p_rating_bg"/></td>
				</td>
				</tr>

				<tr>
				<td id="Chipotle">Chipotle</td>
				<td align="left"><input type="text" id="p_review_chipotle" name="p_review_chipotle"/></td>
				<td align="left"><input type="text" id="p_rating_chipotle" name="p_rating_chipotle"/></td>
				</td>
				</tr>

				<tr>
				<td id="Kosher">Kosher Experience</td>
				<td align="left"><input type="text" id="p_review_ke" name="p_review_ke"/></td>
				<td align="left"><input type="text" id="p_rating_ke" name="p_rating_ke"/></td>
				</td>
				</tr>

				<tr></tr><tr></tr><tr></tr><tr></tr>
				<td align="left"><input type="hidden" id="p_user" name="p_user" value="root"/></td>	
				<tr></tr><tr></tr><tr></tr><tr></tr>
				<td align="left"><input type="hidden" id="p_password" name="p_password" value="rootpassword"/></td>	
				<tr></tr><tr></tr><tr></tr><tr></tr>
				<tr>
				<td><input type="submit" name="p_submit_review" value="Submit Review and Ratings"/></td>
				</tr>

				</table>
				</form>
				
				
			</div>
			
			
</body>
	
</html>
