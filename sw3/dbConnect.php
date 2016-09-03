<?php

//connection class
	
	// class dbConnect 
	// {
		

	// 	public function __construct()
	// 	{
	// 		$conn = mysql_connect("localhost:90", "root","");
	// 		mysql_select_db("blogdb");
	// 		if(!$conn)//testing connection
	// 		{
	// 			die("Cannot connect to the database");
	// 		}
	// 		return $conn;
	// 	}
		
	// }
$conn = new mysqli("localhost","root","","blogdb");
if(!$conn)//testing connection
	 		{
	 			die("Cannot connect to the database");
			}
	else{
		echo "connected";
	}
?>
