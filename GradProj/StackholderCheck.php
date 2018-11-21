<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="StackholderCheck.php">

	<div class="input-c">
		<label for="Project_ID">Project_ID</label>
		<input id="text" type="text" name="Project_ID" />
	</div>

	<div class="input-c">
		<label for="Stakeholders_Id">Stakeholders_Id</label>
		<input id="password" type="text" name="Stakeholders_Id" />
	</div>

	<div class="input-c">
		<label for="Seq_Num">Seq_Num</label>
		<input id="confirm_password" type="text" name="Seq_Num" />
	</div>

	<div class="input-c">
		<label for="Bank_id">Bank_id</label>
		<input id="username" type="text" name="Bank_id" />
	</div>

	<div class="input-c">
		<label for="Branch_id">Branch_id</label>
		<input id="username" type="text" name="Branch_id" />
	</div>

	<div class="input-c">
		<label for="Emploee_id">Emploee_id</label>
		<input id="username" type="text" name="Emploee_id" />
	</div>

	<div class="input-c">
		<label for="Check_Num">Check_Num</label>
		<input id="username" type="text" name="Check_Num" />
	</div>

	<div class="input-c">
		<label for="account_Number">account_Number</label>
		<input id="username" type="text" name="account_Number" />
	</div>

	<div class="input-c">
		<label for="routing_number">routing_number</label>
		<input id="username" type="text" name="routing_number" />
	</div>

	<div class="input-c">
		<label for="Bank_name">Bank_name</label>
		<input id="username" type="text" name="Bank_name" />
	</div>

	<div class="input-c">
		<label for="Start_date">Start_date</label>
		<input id="username" type="text" name="Start_date" />
	</div>

	<div class="input-c">
		<label for="Amount">Amount</label>
		<input id="username" type="text" name="Amount" />
	</div>

	<div class="input-c">
		<label for="Expiry_Date">Expiry_Date</label>
		<input id="username" type="text" name="Expiry_Date" />
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
		'Project_ID' => 'Project_ID is required',
		'Stakeholders_Id' => 'Stakeholders_Id  is required',
		'Seq_Num' => 'Seq_Num  is required',
		'Bank_id' => 'Bank_id is required'
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

	$Project_ID = $_POST['Project_ID'];
	$Stakeholders_Id = $_POST['Stakeholders_Id'];
	$Seq_Num = $_POST['Seq_Num'];
	$Bank_id = $_POST['Bank_id'];
	$Branch_id = $_POST['Branch_id'];
	$Emploee_id = $_POST['Emploee_id'];
	$Check_Num = $_POST['Check_Num'];
	$account_Number = $_POST['account_Number'];
	$routing_number = $_POST['routing_number'];
	$Bank_name = $_POST['Bank_name'];
	$Start_date = $_POST['Start_date'];
	$Amount = $_POST['Amount'];
	$Expiry_Date = $_POST['Expiry_Date'];
	$remark = $_POST['Remark'];

	try {
		$query="INSERT INTO stackholder_check (Project_ID, Stakeholders_Id, Seq_Num, Bank_id, Branch_id, Emploee_id,Check_Num , account_Number, routing_number, Bank_name, Start_date, Amount, Expiry_Date, Remark) 
					VALUES ( '$Project_ID', '$Stakeholders_Id' , '$Seq_Num', '$Bank_id', '$Branch_id', '$Emploee_id', '$Check_Num', '$account_Number', '$routing_number', '$Bank_name', 
					'$Start_date', '$Amount', '$Expiry_Date', '$remark')";
					
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