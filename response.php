<?php

	require_once "db.php";

	if(isset($_GET['ui']) && (isset($_GET['d']))){
		$user_id = mysqli_real_escape_string($conn, $_GET['ui']);
		$data = mysqli_real_escape_string($conn, $_GET['d']);

		date_default_timezone_set("Asia/Kolkata");
		$date_time = date('d-m-y H:i:s',time());

		// Link clicked
		if($data == "lc"){
			mysqli_query($conn, "UPDATE reports SET clicked='$date_time' WHERE id='$user_id' LIMIT 1");
		}
		// Data Submitted
		if($data == "ds"){
			mysqli_query($conn, "UPDATE reports SET submitted='$date_time' WHERE id='$user_id' LIMIT 1");
		}
		// Trained
		if($data == "t"){
			mysqli_query($conn, "UPDATE reports SET trained='$date_time' WHERE id='$user_id' LIMIT 1");
		}
	}
