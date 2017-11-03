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
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
  <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
  <script src="phonegap.js"></script>
  <link rel="stylesheet" href="themes/sageTheme1.min.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arvo%7CSource+Sans+Pro">
  <link rel="stylesheet" href="_css/master.css">
  <title>Sage Customer Survey Response</title>
</head>
<body>
<!-- Art Brown
     bistrosurvey_insert.php
     MCC Sage Customer Survey Respnse Page
     10.01.15
-->
<div data-role="page" id="homePage">
    <div data-role="header" data-position="fixed">
      <a href="#panelhome" data-icon="bars" data-iconpos="notext" data-iconshadow="false" class="ui-nodisc-icon"></a>
      <img src="_images/mccLogo.png" alt="footer logo" height="28px" width="102px">
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

      <img src="_images/sageLogo.png" alt="sage logo" class="logo">

      <div class="placemat">
    	  <h2>Sage Bistro Customer Survey Response</h2>
    		<br>
    		<p class="response">Thank you for your patronage and sharing your feedback about your experience. We look forward to seeing you again on future visits.</p>
    		<p class="response"><a href="http://student.mccinfo.net/~cccayloriii/info2439/ac1/default.html#home">Sage Web Site</a></p>
    		<p class="response"><a href="http://student.mccinfo.net/~cccayloriii/info2439/ac1/default.html#survey">Take the Survey Again</a></p>
      </div>
  	</div> <!-- closing content div -->

    <div data-role="footer">
      <h4><a href="mailto:cccayloriii@mail.mccneb.edu">Clay Caylor</a></h4>
    </div><!-- closing footer div -->

</div><!-- closing page div -->

</body>
</html>
