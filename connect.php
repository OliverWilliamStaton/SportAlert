<?php

	/*
		Connect to the data base
	*/
	function makeConnection() {	

		if(mysqli_connect_error()) {
			die("ERROR: Could not connect to database<br/>");
		}
		print("Connection Successful - DB_SportAlert<br/><br/>");
	}

?>