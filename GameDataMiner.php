<?php

	$link = mysqli_connect("localhost", "ostaton", "Takarajima1", "DB_SportAlert");

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

?>