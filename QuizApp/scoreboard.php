<?php

	require_once('../DatabaseConnections/quizdb.php');
	
	// Calculate scores only for required users
	// By using set difference between the participants table and the scoreboard table
	// If the resultset returned is empty, then scores for all participants are calculated
	// If the resultset has some values, then calculate the scores for those participants 
	// and store their scores in scoreboard table
	
	// Since mysql does not support set difference directly via some functions
	// We'll perform a left join on the participants and scoreboard table, and return the result
	
	$conn = openCon();
	
	$query_setdiff = "select p_mob_no from participants p left join scoreboard s using(p_mob_no) where s.p_mob_no IS NULL";
	
	$response = mysqli_query($conn,$query_setdiff);
	
	if(count($response) > 0){
		//Query to find total submissions of participant
		$query_totSub = "select count(p_mob_no) from submissions where p_mob_no = ?";
		
		//Query to calculate score
		$query_res = "select count(p_mob_no),sum(score) from submissions s inner join questions_and_answers q using (question_id) where s.p_mob_no = ? and s.question_id = q.question_id and s.p_answer = q.answer";
		
		//Query to insert calculated score in scoreboard table
		$query_score = "insert into scoreboard(p_mob_no,p_score) values(?,?)";
		
		while($row = mysqli_fetch_array($response)){
			//Find the total no. of submissions of the participant
			$pstmt = mysqli_prepare($conn,$query_totSub);
			mysqli_stmt_bind_param($pstmt,"s",$row["p_mob_no"]);
			mysqli_stmt_execute($pstmt);
			mysqli_stmt_bind_result($pstmt,$subCnt); //Bind the result obtained to the statement
			mysqli_stmt_fetch($pstmt);
			mysqli_stmt_close($pstmt);
			
			//Calculate score for every participant whose score is not yet calculated
			$p_stmt = mysqli_prepare($conn,$query_res);
			mysqli_stmt_bind_param($p_stmt,"s",$row["p_mob_no"]);
			mysqli_stmt_execute($p_stmt);
			mysqli_stmt_bind_result($p_stmt,$cnt,$sumScore); //Bind the result obtained to the statement
			mysqli_stmt_fetch($p_stmt);
			mysqli_stmt_close($p_stmt);
			
			//Manipulate and insert the calculated score in Scoreboard Table
			$wa = $subCnt - $cnt;
			$sumScore = $sumScore - $wa;
			//Insert the calculated Score
			$stmt = mysqli_prepare($conn,$query_score);
			mysqli_stmt_bind_param($stmt,"si",$row["p_mob_no"],$sumScore);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
	}
	
	//Display the Scoreboard
	
	$query = "select s.p_mob_no, p.p_name, s.p_score from scoreboard s inner join participants p using(p_mob_no) ORDER BY s.p_score DESC";
	$response = mysqli_query($conn,$query);
	
	if($response){
		echo "<center><h1> Scoreboard </h1></center></br>
			<div class='container'>
				<div class='row'>
					<div class='span12'>
						<table class='table table-striped table-condensed'>
							<thead>
								<tr>
									<th>Mobile No.</th>
									<th>Name</th>
									<th>Score</th>
								</tr>
							</thead><tbody>";
				
		$mid = floor(count($response)/2); // Used for coloring half the rows with diff color
		$itr = 1;
		while($row = mysqli_fetch_array($response)){
			echo "<tr>
                    <td>" . $row["p_mob_no"] . "</td>
                    <td>" . $row["p_name"] . "</td>";
					if($itr <= 5)
						echo "<td><span class='label label-success'>" . $row["p_score"] . "</span></td>";
					else
						echo "<td><span class='label label-important'>" . $row["p_score"] . "</span></td>";
				echo "</tr>";
			$itr = $itr + 1;
		}
		echo "</tbody></table></div></div></div>";
	}
	closeCon($conn);
?>

<head>
	<!--<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
	<link href="css/bootstrap.css" rel="stylesheet">
</head>