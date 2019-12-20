<?php

	session_start();
	
	//If user has not logged in, redirect him to login page page
	if(!isset($_SESSION["mobNo"]))
        header("location: index.php");
	
	require_once('../DatabaseConnections/quizdb.php');
	
	if(isSet($_POST["submitQuiz"])){
		$conn = openCon();
		// For every answer submitted by the user
		// Fetch the question answer pair from POST
		// And insert it into the submissions table with the participant's mobile no.
		foreach($_POST as $q_id => $ans){
			if($q_id !== 'submitQuiz'){
				//echo $key . " => " . $value . "</br>";
				$query = "insert into submissions(p_mob_no,question_id,p_answer) values(?,?,?)";
				
				$p_stmt = mysqli_prepare($conn,$query);
				
				mysqli_stmt_bind_param($p_stmt,"sii",$_SESSION["mobNo"],$q_id,$ans);
				
				mysqli_stmt_execute($p_stmt);
				
				$affected_rows = mysqli_stmt_affected_rows($p_stmt);
				
				if($affected_rows != 1)
					echo mysqli_error($conn);
				
				mysqli_stmt_close($p_stmt);
			}	
		}
		closeCon($conn);
		//Remove all session variables
		session_unset();
		//Destroy the session
		session_destroy();
	}
?>

<body>
	<center><h1> </br></br></br>Your Response has been Submitted!</br></br></br></br> The results will be announced today at 1pm sharp </h1></center>
</body>