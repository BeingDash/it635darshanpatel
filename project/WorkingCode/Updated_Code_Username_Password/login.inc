<?php

class LoginInfo
{
private $db;

public function __construct()
{
	$this->db = new mysqli("localhost","root","12345","LunchManagement");
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



public function validateUser($username,$password)
{
	$un = $this->db->real_escape_string($username);
	$pw = $this->db->real_escape_string($password);

	$query = "select * from user u inner join role r on u.roleid = r.roleid where uname = '$un';";
	$result = $this->db->query($query);
	



	$query2  = "select roletype from user u inner join role r on u.roleid = r.roleid where uname = '$un';";
	$queryresponse = $this->db -> query($query2); 

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



?>

