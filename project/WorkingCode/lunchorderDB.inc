<?php

class OrderAccess
{
private $db;

public function __construct()
{
	$this->db = new mysqli("localhost","root","rootpassword","LunchManagement");
	if ($this->db->connect_errno != 0)
	{
		echo "error connecting to databse: ".$this->db->connect_error.PHP_EOL;
		exit();
	}
}

public function __destruct()
{
	if (isset($this->db))
	{
		$this->db->close();
	}
}

public function getlunchorderrecords()
{
	$query  = "select l.*,r.*,e.empname from lunchorder l 
		   inner join user u on l.uid = u.uid 
		   inner join employees e on u.uid = e.empid
		   inner join restaurant r on l.restaurantid = r.restaurantid	
		   where e.empname like '%John%'  ;";

	$queryresponse = $this->db -> query($query);
	$response =  array();

	/*var_dump ($queryresponse); */   #this was to display the column information. We probably do not need this. 

	while($row = $queryresponse -> fetch_assoc())
	{
		$response[] = $row;
	}
	return $response;

}


public function validateUser($username,$password)
{
	$un = $this->db->real_escape_string($username);
	$pw = $this->db->real_escape_string($password);

	$query = "select * from user where uname = '$un';";
	$result = $this->db->query($query);

	while ($row = $result->fetch_assoc())
	{
		if ($row["password"] == $pw)
		{
			// I have a match
			return true;
		}
	}
	return false;
}

}

$lunchorderdb = new OrderAccess();

$lunchorder = $lunchorderdb->getlunchorderrecords();
echo "lunch order records in db are:".PHP_EOL; 
print_r($lunchorder);
echo "program closed".PHP_EOL;


?>

