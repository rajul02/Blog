<?php
	session_start();
	if(isset($_SESSION['blogger_id']) && isset($_SESSION['blooger_username'])) {
	echo "<h2>Blogger Id: ".$_SESSION['blogger_id']."</h2>";
	echo "<h2>Username: ".$_SESSION['blooger_username']."</h2>";
	}else {
		echo "Please Login";
	}	

?>