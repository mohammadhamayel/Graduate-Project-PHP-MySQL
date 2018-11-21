<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="contractCheck.php">

	<div class="input-c">
		<label for="Project_Id">Project_Id</label>
		<input id="text" type="text" name="Project_Id" />
	</div>

	<div class="input-c">
		<label for="Building_id">Building_id</label>
		<input id="password" type="text" name="Building_id" />
	</div>

	<div class="input-c">
		<label for="Apartment_id">Apartment_id</label>
		<input id="confirm_password" type="text" name="Apartment_id" />
	</div>

	<div class="input-c">
		<label for="Customer_Id">Customer_Id</label>
		<input id="username" type="text" name="Customer_Id" />
	</div>

	<div class="input-c">
		<label for="Contract_id">Contract_id</label>
		<input id="username" type="text" name="Contract_id" />
	</div>

	<div class="input-c">
		<label for="Seq_Num">Seq_Num</label>
		<input id="username" type="text" name="Seq_Num" />
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
		<label for="Check_num">Check_num</label>
		<input id="username" type="text" name="Check_num" />
	</div>

	<div class="input-c">
		<label for="Account_number">Account_number</label>
		<input id="username" type="text" name="Account_number" />
	</div>

	<div class="input-c">
		<label for="Routing_number">Routing_number</label>
		<input id="username" type="text" name="Routing_number" />
	</div>

	<div class="input-c">
		<label for="Bank_name">Bank_name</label>
		<input id="username" type="text" name="Bank_name" />
	</div>

	<div class="input-c">
		<label for="Amount">Amount</label>
		<input id="username" type="text" name="Amount" />
	</div>

	<div class="input-c">
		<label for="Expiry_date">Expiry_date</label>
		<input id="username" type="text" name="Expiry_date" />
	</div>

	<div class="input-c">
		<label for="Start_date">Start_date</label>
		<input id="username" type="text" name="Start_date" />
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
		'Project_Id' => 'Project_Id is required',
		'Building_id' => 'Building_id  is required',
		'Apartment_id' => 'Apartment_id  is required',
		'Customer_Id' => 'Customer_Id is required'
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

	$ProjectId = $_POST['Project_Id'];
	$BuildingId = $_POST['Building_id'];
	$ApartmentId = $_POST['Apartment_id'];
	$CustomerId = $_POST['Customer_Id'];
	$ContractId = $_POST['Contract_id'];
	$SeqNum = $_POST['Seq_Num'];
	$BankId = $_POST['Bank_id'];
	$BranchId = $_POST['Branch_id'];
	$EmploeeId = $_POST['Emploee_id'];
	$CheckNum = $_POST['Check_num'];
	$AccountNumber = $_POST['Account_number'];
	$RoutingNumber = $_POST['Routing_number'];
	$BankName = $_POST['Bank_name'];
	$amount = $_POST['Amount'];
	$ExpiryDate = $_POST['Expiry_date'];
	$StartDate = $_POST['Start_date'];
	$remark = $_POST['Remark'];

	try {
		$query="INSERT INTO contract_check (Project_Id, Building_id, Apartment_id, Customer_Id, Contract_id, Seq_Num, Bank_id, Branch_id, Emploee_id, Check_num, Account_number, Routing_number, Bank_name, Amount, Expiry_date, Start_date, Remark) 
					VALUES ( '$ProjectId', '$BuildingId' , '$ApartmentId', '$CustomerId', '$ContractId', '$SeqNum', '$BankId', '$BranchId', '$EmploeeId', '$CheckNum', '$AccountNumber', '$RoutingNumber', '$BankName', '$amount', '$ExpiryDate', '$StartDate', '$remark')";
					
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