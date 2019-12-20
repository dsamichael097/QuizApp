<?php

	//start the session
	session_start();
	//Include the database connection file
	require_once('../DatabaseConnections/quizdb.php');
	
?>

<html>
	<head>
		<title> My Quiz </title>
		<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" href="css/bootstrap-theme.css">
    <!-- Custom styles for this template -->
		<link href="css/reg.css" rel="stylesheet">
	</head>
	
	<body>
		<div class="main">
			<div class="container">
				<center>
					<div class="middle">
						<div id="login">
							<form action="index.php" method="post">
								<fieldset class="clearfix">
									<p ><span class="fa fa-user"></span><input type="text" name="studName" Placeholder="Participant1 Name" required></p>
									<p><span class="fa fa-lock"></span><input type="text" name="mobNo" Placeholder="Participant1 Mobile No." required></p>
									<p ><span class="fa fa-user"></span><input type="text" name="studName2" Placeholder="Participant2 Name"></p>
									<p><span class="fa fa-lock"></span><input type="text" name="mobNo2" Placeholder="Participant2 Mobile No."></p>
								</fieldset>
								<div>
									<input type="submit" name="Register" value="Register">
								</div>
								<div class="clearfix"></div>
							</form>
							<div class="clearfix"></div>
						</div> <!-- end login --> 
						<div class="logo">ULTIMATE CODER
							<div class="clearfix"></div>
						</div>
					</div>
				</center>
			</div>
		</div>
	</body>
	
	<?php
		if(isSet($_POST["Register"])){
			$name = $_POST["studName"];
			$mobNo = $_POST["mobNo"];
			
			//create connection to the database
			$conn = openCon();
			
			//Insert values in the database
			$query = "insert into participants(p_mob_no,p_name) values(?,?)";
			
			//Create the prepared statement using mysqli_prepare(conn,query) function
			$p_stmt = mysqli_prepare($conn,$query);
			
			//Bind the parameters to the question marks in the query
			// The question marks are binded to the parameters using the appropriate data type
			// i stands for integer
			// d for double
			// b for blob
			// s for everything else
			mysqli_stmt_bind_param($p_stmt,"ss",$mobNo,$name);
			
			// Execute the query
			mysqli_stmt_execute($p_stmt);
			
			// Store the no. of rows affected
			$affected_rows = mysqli_stmt_affected_rows($p_stmt);
			
			// For an insert query, the no. of rows affected should always be 1
			if($affected_rows == 1){
				//Store the mobile no. in session to identify the user on different pages
				$_SESSION["mobNo"] = $mobNo;
				header('location: quiz.php');
			}
			else
				echo mysqli_error($conn);
			
			//Close the statement and connection
			mysqli_stmt_close($p_stmt);
			closeCon($conn);
		}
	?>
</html>