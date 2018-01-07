<?php 

	//error_reporting(0);
	try 
	{
		$db=new PDO("mysql:host=localhost;dbname=WebChat; charset=utf8","root","root");

	} 
	catch (PDOException $e) 
	{
		print $e->getMessage();		
	}

	

 ?>