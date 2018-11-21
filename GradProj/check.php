<?php

	require "connectDB.php";

	$sql = "SELECT Bank_name FROM bank ";

	$result = $conn->query($sql);

	$sql2 = "SELECT Name FROM city ";
	$result2 = $conn->query($sql2);

	?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">

</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="check.php">

	<div class="input-c">
		<label for="Project_id">Project_id</label>
		<input id="text" type="text" name="Project_id" />
	</div>

	<div class="input-c">
		<label for="Stage_id">Stage_id</label>
		<input id="password" type="text" name="Stage_id" />
	</div>

	<div class="input-c">
		<label for="level_id">level_id</label>
		<input id="confirm_password" type="text" name="level_id" />
	</div>

	<div class="input-c">
		<label for="Participant_id">Participant_id</label>
		<input id="username" type="text" name="Participant_id" />
	</div>

	<div class="input-c">
		<label for="Seq_num">Seq_num</label>
		<input id="username" type="text" name="Seq_num" />
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
		<label for="Account_number">Account_number</label>
		<input id="username" type="text" name="Account_number" />
	</div>

	<div class="input-c">
		<label for="Routing_number">Routing_number</label>
		<input id="username" type="text" name="Routing_number" />
	</div>

	<div class="input-c">
		<label for="Start_Date">Start_Date</label>
		<input id="username" type="text" name="Start_Date" />
	</div>

	<div class="input-c">
		<label for="Amount">Amount</label>
		<input id="username" type="text" name="Amount" />
	</div>

	<div class="input-c">
		<label for="Actual_date">Actual_date</label>
		<input id="username" type="text" name="Actual_date" />
	</div>
	<div class="input-c">
		<label for="bankName">Bank Name</label>
		<select name="bankName">
		
			<?php if ($result->num_rows > 0) 
	    		while($row = $result->fetch_assoc()) :; ?>

				<option ><?php echo $row["Bank_name"] . "<br>"; ?></option>
			<?php endwhile ; else echo "0 results"; ?>

		</select>
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
    
	/*$requiredFields = [
		'Project_id' => 'Project_id is required',
		'Stage_id' => 'Stage_id  is required',
		'level_id' => 'level_id  is required',
		//'Seq_num' => 'Seq_num is required'

	];

	foreach($requiredFields as $key => $message) {
		if (!isset($_POST[$key]) || empty($_POST[$key])) {
			die($message);
		}
	}*/

	

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

	$ProjectId = $_POST['Project_id'];
	$StageId = $_POST['Stage_id'];
	$levelId = $_POST['level_id'];
	$ParticipantId = $_POST['Participant_id'];
	$SeqNum = $_POST['Seq_num'];
	$BankId = $_POST['Bank_id'];
	$BranchId = $_POST['Branch_id'];
	$EmploeeId = $_POST['Emploee_id'];
	$CheckNum = $_POST['Check_Num'];
	$AccountNumber = $_POST['Account_number'];
	$RoutingNumber = $_POST['Routing_number'];
	$StartDate = $_POST['Start_Date'];
	$amount = $_POST['Amount'];
	$ActualDate = $_POST['Actual_date'];
	$bankName = $_POST['bankName'];
	$remark = $_POST['Remark'];

	try {
		$query="INSERT INTO checks (Project_id, Stage_id, level_id, Participant_id, Seq_num, Bank_id, Branch_id, Emploee_id, Check_Num, Account_number, Routing_number, Start_Date, Amount, Actual_date, bankName, Remark) 
					VALUES ( '$ProjectId', '$StageId' , '$levelId', '$ParticipantId', '$SeqNum', '$BankId', '$BranchId', '$EmploeeId', '$CheckNum', '$AccountNumber', 
					'$RoutingNumber', '$StartDate', '$amount', '$ActualDate', '$bankName', '$remark')";
					
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