<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
//require_once 'infosurvey_util_functions.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="..\_jqMobile\jquery.mobile-1.4.5.min.css">
  <script src="..\_jqMobile\jquery-2.1.3.min.js"></script>
  <script src="..\_jqMobile\jquery.mobile-1.4.5.min.js"></script>
  <script src="phonegap.js"></script>
  <link rel="stylesheet" href="_css/sagesurvey.css">
  <link rel="stylesheet" href="_css/sagesurvey.jqmt.min.css">
  <link rel="stylesheet" href="_css/jquery.mobile.icons.min.css">
  <title>Sage Customer Survey Response</title>
</head>
<body>
<!-- Art Brown
     bistrosurvey_insert.php
     MCC Sage Customer Survey Respnse Page
     10.01.15
-->
<div data-role="page" id="homePage">
    <div data-role="header" data-position="fixed" data-fullscreen="true">
        <a href="http://student.mccinfo.net/~cccayloriii/info2439/default.html" data-ajax="false" class="ui-btn ui-btn-inline ui-corner-all">Home</a>
		<h2>Clay Caylor</h2>
    </div><!-- closing header div -->

    <div data-role="content">

	<?php
		$mealRate = substr($_POST['meal_rate'],0,1);
		$serviceRate = substr($_POST['service_rate'],0,1);
		$overallExp  = substr($_POST['overall_exp'],0,1);
		$recommendRest = $_POST['recommend_rest'];
		$bname = $_POST['bname'];
		$email = $_POST['email'];




		//echo 'Meal Rating:    ' . $mealRate . '<br>';
		//echo 'Service Rating:    ' . $serviceRate . '<br>';
		//echo 'Overall Experience:    ' . $overallExp . '<br>';
		//echo 'Recommend Restaurant :    ' . $recommendRest . '<br>';
		//echo 'Name:    ' . $bname . '<br>';
		//echo 'Email:    ' . $email . '<br>';

		$settings = array(
			'database' => 'info_survey',
			'host'     => 'infolnx7.mccinfo.net',
			'password' => 'St@rW@r$Epis0deF0ur',
			'username' => 'info_survey_user');

		$dsn = 'mysql:host=' . $settings['host'] . ';dbname=' . $settings['database'];

		try {
			$pdo = new PDO(
			$dsn,
			$settings['username'],
			$settings['password']
			);
		}
		catch(PDOException $e)
		{
			echo "<h2>We apologize.  A technical problem has occurred on the connect.  Please try again later.</h2>";
			//echo $e;
			exit;
		}

		$query = "INSERT INTO BISTRO_SURVEY(meal_rate, service_rate, overall_exp, recommend_rest, bname, email)" .
					"VALUES(:meal_rate, :service_rate, :overall_exp, :recommend_rest, :bname, :email)";

		try {
			$statement = $pdo->prepare($query);
			$statement->bindParam(':meal_rate', $mealRate, PDO::PARAM_STR);
			$statement->bindParam(':service_rate', $serviceRate, PDO::PARAM_STR);
			$statement->bindParam(':overall_exp', $overallExp, PDO::PARAM_STR);
			$statement->bindParam(':recommend_rest', $recommendRest, PDO::PARAM_STR);
			$statement->bindParam(':bname', $bname, PDO::PARAM_STR);
			$statement->bindParam(':email', $email, PDO::PARAM_STR);

			$statement->execute();
		}
		catch(PDOException $e)
		{
			echo "<h2>We apologize.  A technical problem has occurred on the insert.  Please try again later.</h2>";
			//echo $e;
			exit;
		}

			$message_admin = $bname . ", thank you for taking the Bistro survey.\n\n" .
			    "Below is the Bistro feedback you provided on the survey.\n\n" .
				"Meal Rating: " . $_POST['meal_rate'] . "\n" .
				"Service Rating: " . $_POST['service_rate'] . "\n" .
				"Overall Experience: " . $_POST['overall_exp'] . "\n" .
				"Recommend Restaurant: " . $recommendRest;

			$fromEmail = 'CCC@MCC.net';
			$subject_admin = 'MCC Bistro Survey Results: ' . $email;
			$email_admin = "repaschall@mccneb.edu";

			//mail($email_admin, $subject_admin, $message_admin, $fromEmail);
			mail($email, $subject_admin, $message_admin, $fromEmail);
			//mail($email_admin, $subject_admin, $message_admin, $email);

	?>

	     <h2>Sage Bistro Customer Survey Response</h2>
		 <br>
		<p class="response">Thank you for your patronage and sharing your feedback about your experience. We look forward to seeing you again on future visits.</p>
		<p class="response"><a href="http://mccneb.edu/SageStudentBistro">Sage Web Site</a></p>
		<p class="response"><a href="http://student.mccinfo.net/~cccayloriii/info2439/module04/assignment4.html" data-ajax="false">Take the Survey Again</a></p>
	</div> <!-- closing content div -->

	<div data-role="footer" data-position="fixed">
		<img src="_images/mcc-logo-bistro.png" width="155" height="42" alt="MCC Logo"/>
	</div><!-- closing footer div -->

</div><!-- closing page div -->

</body>
</html>
