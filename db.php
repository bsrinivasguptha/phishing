<?php

	$mysql_servername = "----";
	$mysql_username = "-----";
	$mysql_password = "-----";
	$mysql_dbname = "phishing";

	// Create connection
	$conn = mysqli_connect($mysql_servername, $mysql_username, $mysql_password, $mysql_dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

