<?php

	# Global parameters
	date_default_timezone_set('UTC');
	$myTeam = "Warriors";
	$link = mysqli_connect("localhost", "ostaton", "Takarajima1", "DB_SportAlert");

	/*
		Connect to the data base
	*/
	function makeConnection() {	

		if(mysqli_connect_error()) {
			die("ERROR: Could not connect to database<br/>");
		}
		print("Connection Successful - DB_SportAlert<br/><br/>");
	}
	
	/*
		Given a team, search DB to see if valid
	*/
	function teamNameInTable($tName) {
		global $link;
		$query = "SELECT * FROM `Teams`";

		if($result = mysqli_query($link, $query)) {
			while($row = mysqli_fetch_array($result)) {
				// print($row["TeamName"]);
				if($row["TeamName"] == $tName) {
					// print("Found My Team: ".$tName."<br/>");
					return true;
				}
			}
		}
		else {
			die("ERROR: teamNameInTable() query did not work<br/>");
		}
		return false;
	}

	/*
		Given a team, get all games played by said team
	*/
	// TODO: explore alternative method of using 'join'
	// $query ="SELECT * FROM `Games` inner join Teams on Games.TeamName = Teams.TeamName";
	function getAllGamesForTeam($tName) {
		global $link;
		$query = "SELECT * FROM `Games` WHERE `TeamName`='".$tName."'";

		if($result = mysqli_query($link, $query)) {
			while($row = mysqli_fetch_array($result)) {
				$array[] = $row;
			}
			// print_r($array);
		}
		else {
			die("ERROR: getAllGamesForTeam() query did not work<br/>");
		}
		return $array;
	}

	/*
		Given an array of games, find games for today
	*/
	function gamesToday($array) {
		$date = date('Y-m-d');
		for($count = 0; $count < sizeof($array); $count++) {
			if($array[$count]["Date"] == $date) {
				$array[] = $array[$count];
			}
		}
		return $array;
	}

	/*
		Given an array of games, find games that are upcomming
	*/
	function gamesAfterToday($array) {
		$date = date('Y-m-d');
		for($count = 0; $count < sizeof($array); $count++) {
			if($array[$count]["Date"] > $date) {
				$array[] = $array[$count];
			}
		}
		return $array;
	}

	/*
		Main
	*/
	makeConnection();
	teamNameInTable($myTeam);
	$array = getAllGamesForTeam($myTeam);
	$array = gamesToday($array);
	print("Today there is a ".$array[0]["TeamName"]." game in ".$array[0]["Location"]."!<br/>");
	print("Be sure to tune in for the game at ".$array[0]["Time"].".<br/>");

	# TODO: GET USER PREFERENCES
	# TODO: MINE DATA
	# TODO: IF GAME NOTIFICATION IS NEEDED
	# TODO: SEND EMAIL

?>