<?php

	//Function to open a connection to database
	function openCon(){
		//Database connection Parameters
		$dbhost = "localhost";
		$dbuser = "michael";
		$dbpass = "mic123";
		$db = "quizphp";
		
		//Connect to the database
		$conn = new mysqli($dbhost,$dbuser,$dbpass,$db);
		
		//If connection fails
		if($conn === false)
			die("ERROR: Could not connect. " . $conn -> connect_error);
		
		return $conn;
	}
	
	//Function to close a connection to database
	function closeCon($conn){
		$conn -> close();
	}
?>