<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="Sections.php">

	<div class="input-c">
		<label for="Project_id">Project_id</label>
		<input id="text" type="text" name="Project_id" />
	</div>

	<div class="input-c">
		<label for="Building_id">Building_id</label>
		<input id="password" type="text" name="Building_id" />
	</div>

	<div class="input-c">
		<label for="Section_id">Section_id</label>
		<input id="confirm_password" type="text" name="Section_id" />
	</div>

	<div class="input-c">
		<label for="Type_id">Type_id</label>
		<input id="username" type="text" name="Type_id" />
	</div>

	<div class="input-c">
		<label for="Emploee_id">Emploee_id</label>
		<input id="username" type="text" name="Emploee_id" />
	</div>

	<div class="input-c">
		<label for="Directions">Directions</label>
		<input id="username" type="text" name="Directions" />
	</div>

	<div class="input-c">
		<label for="Floor_number">Floor_number</label>
		<input id="username" type="text" name="Floor_number" />
	</div>

	<div class="input-c">
		<label for="Apartment_area">Apartment_area</label>
		<input id="username" type="text" name="Apartment_area" />
	</div>

	<div class="input-c">
		<label for="Number_of_rooms">Number_of_rooms</label>
		<input id="username" type="text" name="Number_of_rooms" />
	</div>

	<div class="input-c">
		<label for="Number_of_balcon">Number_of_balcon</label>
		<input id="username" type="text" name="Number_of_balcon" />
	</div>

	<div class="input-c">
		<label for="Has_stairs">Has_stairs</label>
		<input id="username" type="text" name="Has_stairs" />
	</div>

	<div class="input-c">
		<label for="Has_barking">Has_barking</label>
		<input id="username" type="text" name="Has_barking" />
	</div>

	<div class="input-c">
		<label for="Barking_number">Barking_number</label>
		<input id="username" type="text" name="Barking_number" />
	</div>

	<div class="input-c">
		<label for="Has_store">Has_store</label>
		<input id="username" type="text" name="Has_store" />
	</div>

	<div class="input-c">
		<label for="Type">Type</label>
		<input id="username" type="text" name="Type" />
	</div>

	<div class="input-c">
		<label for="State">State</label>
		<input id="username" type="text" name="State" />
	</div>

	<div class="input-c">
		<label for="Remark">Remark</label>
		<input id="username" type="text" name="Remark" />
	</div>

	<button type="submit">Insert</button>
	
</form>
</body>
</html>

<?php

/* Insert only when we have a post request */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    /* Some Validation */
    
	$requiredFields = [
		'Project_id' => 'Project_id is required',
		'Building_id' => 'Building_id  is required',
		'Section_id' => 'Section_id  is required',
		'Type_id' => 'Type_id is required'
	];

	foreach($requiredFields as $key => $message) {
		if (!isset($_POST[$key]) || empty($_POST[$key])) {
			die($message);
		}
	}

	

	//database configration
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "msql";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}	

	$Project_id = $_POST['Project_id'];
	$Building_id = $_POST['Building_id'];
	$Section_id = $_POST['Section_id'];
	$Type_id = $_POST['Type_id'];
	$Emploee_id = $_POST['Emploee_id'];
	$Directions = $_POST['Directions'];
	$Floor_number = $_POST['Floor_number'];
	$Apartment_area = $_POST['Apartment_area'];
	$Number_of_rooms = $_POST['Number_of_rooms'];
	$Number_of_balcon = $_POST['Number_of_balcon'];
	$Has_stairs = $_POST['Has_stairs'];
	$Has_barking = $_POST['Has_barking'];
	$Barking_number = $_POST['Barking_number'];
	$Has_store = $_POST['Has_store'];
	$Type = $_POST['Type'];
	$State = $_POST['State'];
	$remark = $_POST['Remark'];

	try {
		$query="INSERT INTO sections (Project_id, Building_id, Section_id, Type_id, Emploee_id, Directions, Floor_number, Apartment_area, Number_of_rooms, Number_of_balcon, Has_stairs, Has_barking, Barking_number, Has_store, Type, State, Remark) 
					VALUES ( '$Project_id', '$Building_id' , '$Section_id', '$Type_id', '$Emploee_id', '$Directions', '$Floor_number', '$Apartment_area', '$Number_of_rooms', '$Number_of_balcon', '$Has_stairs', '$Has_barking', '$Barking_number', '$Has_store', '$Type', '$State', '$remark')";
					
		echo $query;
		$stmt = $conn->prepare($query);
		//$stmt->bind_param("sss", $confirmationCode, $insertPassword,$insertUsername);

		/* execute prepared statement */

		$stmt->execute();

		printf("%d Row inserted.\n", $stmt->affected_rows);

		/* close statement and connection */
		$stmt->close();

	}catch(PDOException $e) {
		echo $e->getMessage();
	}	

	$conn->close();
}

?>	