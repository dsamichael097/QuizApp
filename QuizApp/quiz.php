<?php
	session_start();
	
	//If user has not logged in, redirect him to login page page
	/*if(!isset($_SESSION["mobNo"]))
        header("location: index.php");*/
	
	require_once('../DatabaseConnections/quizdb.php');
?>

<html>
	<head>
		<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">
	<link rel="stylesheet" href="css/index.css">	
	  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
		<link href="css/question.css" rel="stylesheet" id="css">
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Michael D'sa | PHP Quiz</a>
        </div>
        <div class="navbar-collapse collapse" class="toactive">
        </div><!--/.nav-collapse -->
      </div>
    </div>
		<center>
			<div class="time" id="navbar">Time left :<span id="timer"></span></div>
			<button class="button" id="mybut" onclick="myFunction()">START QUIZ</button>
		</center>
		<div id="myDIV" style="padding: 10px 30px;">
		<form action = "quizInsert.php" method="POST" id="form">
			<?php
				$conn = openCon();
				
				$query = "select question_id,question,op1,op2,op3,op4 from questions_and_answers";
				
				//Store the returned result in response
				$response = mysqli_query($conn,$query);
				
				//If the rows are returned
				if($response){
					//Fetch one row at a time from response array
					//Create a div dynamically and display the questions with options
					while($row = mysqli_fetch_array($response)){
						echo "<div class='privew'>
								<div class='questionsBox'>
									<div class='questions'>" . $row["question"] . "</div>
									<ul class='answerList'>
										<li>
											<label class='options'>
												<input type='radio' name='$row[question_id]' value='1'> " . $row["op1"] . "</label>
										</li>
										<li>
											<label class='options'>
												<input type='radio' name='$row[question_id]' value='2'> " . $row["op2"] . "</label>
										</li>
										<li>
											<label class='options'>
												<input type='radio' name='$row[question_id]' value='3'> " . $row["op3"] . "</label>
										</li>
										<li>
											<label class='options'>
												<input type='radio' name='$row[question_id]' value='4'> " . $row["op4"] . "</label>
										</li>
									</ul>
								</div>
							</div>";
					}
				}
				else{
					echo mysqli_error($conn);
				}
				
				closeCon($conn);
			?>
			<center><input type="submit" name="submitQuiz" value="Submit"></center>
		</form>
		</div>
		<script>
			function myFunction() {
				var x = document.getElementById("myDIV");
				var b = document.getElementById("mybut");
				var x = document.getElementById("myDIV");
				if (x.style.display === "none") { 
					b.style.visibility = 'hidden';
					x.style.display = "block";
					startTimer();
				}
			}
			window.onload = function() {
				document.getElementById('myDIV').style.display = 'none';
			};
		</script>
		
		<script type="text/javascript">
			document.getElementById('timer').innerHTML = '10:00';
			//03 + ":" + 00 ;
			
			// To submit the form if the user refreshes the page
			if(performance.navigation.type == performance.navigation.TYPE_RELOAD){
				document.getElementById("form").submit();
			}


			function startTimer() {
			  var presentTime = document.getElementById('timer').innerHTML;
			  var timeArray = presentTime.split(/[:]+/);
			  var m = timeArray[0];
			  var s = checkSecond((timeArray[1] - 1));
			  if(s==59){m=m-1}
			  if(m==0 && s==0){document.getElementById("form").submit();}
			  document.getElementById('timer').innerHTML =
				m + ":" + s;
			  setTimeout(startTimer, 1000);
			}

			function checkSecond(sec) {
			  if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
			  if (sec < 0) {sec = "59"};
			  return sec;
			  if(sec == 0 && m == 0){ alert('stop it')};
			}
		</script>

		<script>
			window.onscroll = function() {myFun()};

			var navbar = document.getElementById("navbar");
			var sticky = navbar.offsetTop -50;

			function myFun() {
			  if (window.pageYOffset >= sticky) {
				navbar.classList.add("sticky")
			  } else {
				navbar.classList.remove("sticky");
			  }
			}
		</script>
	</body>
</html>