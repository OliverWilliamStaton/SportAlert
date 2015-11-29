<?php

	include 'connect.php';
	include 'GameDataMiner.php';

	# Global parameters
	date_default_timezone_set('UTC');
	$myTeam = "Warriors";
	$link = mysqli_connect("localhost", "ostaton", "Takarajima1", "DB_SportAlert");

	# Global email settings
	$to = "";
	$subject = 'Sport Alert';
	$message = "";



	makeConnection();
	// teamNameInTable($myTeam);
	// $array = getAllGamesForTeam($myTeam);
	// $array = gamesToday($array);
	// print("Today there is a ".$array[0]["TeamName"]." game in ".$array[0]["Location"]."!<br/>");
	// print("Be sure to tune in for the game at ".$array[0]["Time"].".<br/>");

	# TODO: GET USER PREFERENCES

	# For each user
	# 	Check user preference
	# 	Check team data
	# 	Respond if appropriate

	$queryUsers = "SELECT * FROM `Users`";

	# For each User:
	if($resultUsers = mysqli_query($link, $queryUsers)) {
		while($userData = mysqli_fetch_array($resultUsers)) {
			
			# Update email info
			$to = $userData["Email"];
			$message = "Hello ".$userData["UserName"].",\n";

			# For each setting ID:
			$queryUserSettings = "SELECT * FROM `UserSettings` WHERE `SettingID`='".$userData["SettingID"]."'";
			if($resultUserSettings = mysqli_query($link, $queryUserSettings)) {
				while($userSettingData = mysqli_fetch_array($resultUserSettings)) {
					
					# Get game information
					$tName = $userSettingData["TeamName"];
					if(teamNameInTable($tName)) {
						$array = getAllGamesForTeam($tName);
						if($array[0]["TeamName"] != "") {
						    $message = $message."Today there is a ".$array[0]["TeamName"]." game in ".$array[0]["Location"]."!\n";
						 	$message = $message."Be sure to tune in for the game at ".$array[0]["Time"].".\n";
						}
					}

				}
			}
			else {
				die("ERROR: unable to access user settings db<br/>");
			}

			// # Send Notification
			// TODO: ENABLE BELOW - production purposes
			// if( mail ( $to , $subject , $message)) {
			// 	print "Successfully sent email";
			// }
			// else {
			// 	die("ERROR: unable to send email");
			// }
			// TODO: DISABLE BELOW - only for test purposes
			print($to."<br/>");
			print($message."<br/>");
		}
	}
	else {
		die("ERROR: unable to access user db<br/>");
	}

?>









































