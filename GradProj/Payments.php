<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="Payments.php">

	<div class="input-c">
		<label for="Project_id">Project_id</label>
		<input id="text" type="text" name="Project_id" />
	</div>

	<div class="input-c">
		<label for="Stages_id">Stages_id</label>
		<input id="password" type="text" name="Stages_id" />
	</div>

	<div class="input-c">
		<label for="levels_id">levels_id</label>
		<input id="confirm_password" type="text" name="levels_id" />
	</div>

	<div class="input-c">
		<label for="Participant_id">Participant_id</label>
		<input id="username" type="text" name="Participant_id" />
	</div>

	<div class="input-c">
		<label for="Emploee_id">Emploee_id</label>
		<input id="username" type="text" name="Emploee_id" />
	</div>

	<div class="input-c">
		<label for="Seq_number">Seq_number</label>
		<input id="username" type="text" name="Seq_number" />
	</div>

	<div class="input-c">
		<label for="Payment_date">Payment_date</label>
		<input id="username" type="text" name="Payment_date" />
	</div>

	<div class="input-c">
		<label for="Amount">Amount</label>
		<input id="username" type="text" name="Amount" />
	</div>

	<div class="input-c">
		<label for="Remark">Remark</label>
		<input id="username" type="text" name="Remark" />
	</div>

	<button type="submit"  name="insert">Insert</button>
	<button type="submit" name="edit">Edit</button>
	<button type="submit" name="search">Search</button>
	<button type="submit" name="delete">Delete</button>	
	
</form>
</body>
</html>

<?php

/* Insert only when we have a post request */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    /* Some Validation */
    if (isset($_POST['insert'])||isset($_POST['edit'])) {
    	if (isset($_POST['insert'])){
			$requiredFields = [
				'Payment_date' => 'Payment_date is required',
				'Amount' => 'Amount  is required',
			];
		}else {
			$requiredFields = [
				'Seq_number' => 'Seq_number  is required',
			];
		}

		foreach($requiredFields as $key => $message) {
			if (!isset($_POST[$key]) || empty($_POST[$key])) {
				die($message);
			}
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
	$Stages_id = $_POST['Stages_id'];
	$levels_id = $_POST['levels_id'];
	$Participant_id = $_POST['Participant_id'];
	$Emploee_id = $_POST['Emploee_id'];
	$Seq_number = $_POST['Seq_number'];
	$Payment_date = $_POST['Payment_date'];
	$Amount = $_POST['Amount'];
	$remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])){
		try {
			$query="INSERT INTO payment (Project_id, Stages_id, levels_id, Participant_id, Emploee_id, Seq_number, Payment_date, Amount, Remark) 
						VALUES ( '$Project_id','$Stages_id' , '$levels_id', '$Participant_id', '$Emploee_id', '$Seq_number', '$Payment_date', '$Amount', '$remark')";
						
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
	}
	// for update -------------------------------------------------------------------------------------
	function updater($col, $value,$id){
	   
		require "connectDB.php";
	       
	    $sql = "UPDATE payment SET $col='{$value}' WHERE Seq_number='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Payment_date']) && !empty($_POST['Payment_date'])) {
			updater(Payment_date,$_POST['Payment_date'],$_POST['Seq_number']);
		}
		if (isset($_POST['Amount']) && !empty($_POST['Amount'])) {
			updater(Amount,$_POST['Amount'],$_POST['Seq_number']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Seq_number']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM payment";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Project_id: " . $row["Project_id"]. str_repeat('&nbsp;', 5)	." 	**Stages_id: " . $row["Stages_id"]. str_repeat('&nbsp;', 5) ." **levels_id: " . $row["levels_id"].str_repeat('&nbsp;', 5)." **Participant_id:" . $row["Participant_id"].str_repeat('&nbsp;', 5)." **Emploee_id:" . $row["Emploee_id"] .str_repeat('&nbsp;', 5)." **Seq_number:" . $row["Seq_number"] .str_repeat('&nbsp;', 5)." **Payment_date:" . $row["Payment_date"] .str_repeat('&nbsp;', 5)." **Amount:" . $row["Amount"] .str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";		    
		 else 
		    echo "0 results";
	}
	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM payment WHERE Seq_number= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['Seq_number']) && !empty($_POST['Seq_number'])) {
			deleter($_POST['Seq_number']);
		}		
	}
	$conn->close();
}

?>	