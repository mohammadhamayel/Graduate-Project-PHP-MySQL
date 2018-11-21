<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="Project.php">

	<div class="input-c">
		<label for="Project_id">Project_id</label>
		<input id="text" type="text" name="Project_id" />
	</div>

	<div class="input-c">
		<label for="Employee_id">Employee_id</label>
		<input id="password" type="text" name="Employee_id" />
	</div>

	<div class="input-c">
		<label for="Project_name">Project_name</label>
		<input id="confirm_password" type="text" name="Project_name" />
	</div>

	<div class="input-c">
		<label for="Start_date">Start_date</label>
		<input id="username" type="text" name="Start_date" />
	</div>

	<div class="input-c">
		<label for="Expected_finish">Expected_finish</label>
		<input id="username" type="text" name="Expected_finish" />
	</div>

	<div class="input-c">
		<label for="Actual_finish">Actual_finish</label>
		<input id="username" type="text" name="Actual_finish" />
	</div>

	<div class="input-c">
		<label for="City_id">City_id</label>
		<input id="username" type="text" name="City_id" />
	</div>

	<div class="input-c">
		<label for="quarter_id">quarter_id</label>
		<input id="username" type="text" name="quarter_id" />
	</div>

	<div class="input-c">
		<label for="coordination_x">coordination_x</label>
		<input id="username" type="text" name="coordination_x" />
	</div>

	<div class="input-c">
		<label for="coordination_y">coordination_y</label>
		<input id="username" type="text" name="coordination_y" />
	</div>

	<div class="input-c">
		<label for="Address">Address</label>
		<input id="username" type="text" name="Address" />
	</div>

	<div class="input-c">
		<label for="7od_id">7od_id</label>
		<input id="username" type="text" name="7od_id" />
	</div>

	<div class="input-c">
		<label for="PLot_id">PLot_id</label>
		<input id="username" type="text" name="PLot_id" />
	</div>

	<div class="input-c">
		<label for="Land_area">Land_area</label>
		<input id="username" type="text" name="Land_area" />
	</div>

	<div class="input-c">
		<label for="Building_area">Building_area</label>
		<input id="username" type="text" name="Building_area" />
	</div>

	<div class="input-c">
		<label for="Number_of_building">Number_of_building</label>
		<input id="username" type="text" name="Number_of_building" />
	</div>

	<div class="input-c">
		<label for="Contract_expected_value">Contract_expected_value</label>
		<input id="username" type="text" name="Contract_expected_value" />
	</div>

	<div class="input-c">
		<label for="Total_balance">Total_balance</label>
		<input id="username" type="text" name="Total_balance" />
	</div>

	<div class="input-c">
		<label for="income">income</label>
		<input id="username" type="text" name="income" />
	</div>

	<div class="input-c">
		<label for="Expenses">Expenses</label>
		<input id="username" type="text" name="Expenses" />
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
		'Employee_id' => 'Employee_id  is required',
		'Project_name' => 'Project_name  is required',
		'Start_date' => 'Start_date is required'
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
	$Employee_id = $_POST['Employee_id'];
	$Project_name = $_POST['Project_name'];
	$Start_date = $_POST['Start_date'];
	$Expected_finish = $_POST['Expected_finish'];
	$Actual_finish = $_POST['Actual_finish'];
	$City_id = $_POST['City_id'];
	$quarter_id = $_POST['quarter_id'];
	$coordination_x = $_POST['coordination_x'];
	$coordination_y = $_POST['coordination_y'];
	$Address = $_POST['Address'];
	$hod_id = $_POST['7od_id'];
	$PLot_id = $_POST['PLot_id'];
	$Land_area = $_POST['Land_area'];
	$Building_area = $_POST['Building_area'];
	$Number_of_building = $_POST['Number_of_building'];
	$Contract_expected_value = $_POST['Contract_expected_value'];
	$Total_balance = $_POST['Total_balance'];
	$income = $_POST['income'];
	$Expenses = $_POST['Expenses'];
	$Remark = $_POST['Remark'];

	try {
		$query="INSERT INTO project (Project_id, Employee_id, Project_name, Start_date, Expected_finish, Actual_finish, City_id, quarter_id, coordination_x, coordination_y, Address, 7od_id, PLot_id, Land_area, Building_area, Number_of_building, Contract_expected_value, Total_balance, income, Expenses, Remark) 
					VALUES ( '$Project_id', '$Employee_id' , '$Project_name', '$Start_date', '$Expected_finish', '$Actual_finish', '$City_id', '$quarter_id', '$coordination_x', '$coordination_y', '$Address', '$hod_id', '$PLot_id', '$Land_area', '$Building_area', '$Number_of_building', '$Contract_expected_value', '$Total_balance', '$income', '$Expenses', '$Remark')";
					
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