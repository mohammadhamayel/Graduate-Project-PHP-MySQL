<?php

	require "connectDB.php";

	$sql = "SELECT Name FROM building ";

	$result = $conn->query($sql);

	$sql2 = "SELECT Name FROM city ";
	$result2 = $conn->query($sql2);

	?>

<!DOCTYPE html>
<html>
<head>
	<title>select dynamic data from tables</title>
	<meta charset="utf-8">
</head>
<body>

	<br>
	this from building
	<select name="buildingName">
		
		<?php if ($result->num_rows > 0) 
    		while($row = $result->fetch_assoc()) :; ?>



			<option><?php echo $row["Name"] . "<br>"; ?></option>
		<?php endwhile ; else echo "0 results"; ?>

	</select>

	this from city

	<select name="cityName">
		
		<?php if ($result2->num_rows > 0) 
    		while($row = $result2->fetch_assoc()) :; ?>



			<option><?php echo $row["Name"] . "<br>"; ?></option>
		<?php endwhile ; else echo "0 results"; ?>

	</select>

</body>
</html>