#!/usr/bin/php
<?php

require_once("login.inc");
$action = NULL;
for ($i = 1;$i < $argc;$i++)
{
	switch($argv[$i])
	{
		case "--auth":
			$action = "auth";
			break;
		case "-u":
			$username = $argv[$i + 1];
			$i++;
			break;
		case "-p":
			$password = $argv[$i + 1];
			$i++;
			break;
	}
}
switch ($action)
{
	case "auth":
		if (!isset($username))
		{
			echo "please provide a username with -u <username>".PHP_EOL;
			exit(1);
		}
		if (!isset($password))
		{
			echo "please provide a password with -p <password>".PHP_EOL;
			exit(1);
		}

		$lunchorderdb = new LoginInfo("LunchManagement");
		if ($lunchorderdb->validateUser($username,$password) == false)
		{
			echo "login failed!".PHP_EOL;
		}
		else
		{	if ($username == 'root'){
			echo "Login successful as admin. You can perform administrative duties with this login.".PHP_EOL;
			}
			
			else {
			echo "Login successful as a regular user. You can only place an order or check your past orders.".PHP_EOL;
			}
		
		}
		break;
	default:
		echo "No action specified, exiting".PHP_EOL;
		exit (1);

}




?>
