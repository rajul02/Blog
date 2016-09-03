<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blogdb";

//connection class
	
	class dbConnect 
	{
		
		function __construct()
		{
			$conn = mysql_connect($servername, $username,$password);
			mysql_select_db($dbnmae);
			if(!$conn)//testing connection
			{
				die("Cannot connect to the database");
			}
			return $conn;
		}
		public functionClose()
		{
			mysql_close();
		}
	}

?>