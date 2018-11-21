<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "msql";

	$conn = new mysqli($servername, $username , $password, $dbname) or die("connection failed");



	echo("Connected successfully");

	//$conn->close();

