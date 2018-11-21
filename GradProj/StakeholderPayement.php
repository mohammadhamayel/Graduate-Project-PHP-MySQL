<html>
<head>
	<title>StakeholderPayments</title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="StakeholderPayement.php">

	<div class="input-c">
		<label for="Project_id">Project_id</label>
		<input id="text" type="text" name="Project_id" />
	</div>

	<div class="input-c">
		<label for="Stakeholder_id">Stakeholder_id</label>
		<input id="password" type="text" name="Stakeholder_id" />
	</div>

	<div class="input-c">
		<label for="Seq_Num">Seq_Num</label>
		<input id="confirm_password" type="text" name="Seq_Num" />
	</div>

	<div class="input-c">
		<label for="Emploee_id">Emploee_id</label>
		<input id="username" type="text" name="Emploee_id" />
	</div>

	<div class="input-c">
		<label for="Amount">Amount</label>
		<input id="username" type="text" name="Amount" />
	</div>

	<div class="input-c">
		<label for="Date">Date</label>
		<input id="username" type="text" name="Date" />
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
				'Amount' => 'Amount is required',
				'Date' => 'Date  is required',
			];
		}
		else{
			$requiredFields = [
				'Seq_Num' => 'Seq_Num is required',		
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
	$Stakeholder_id = $_POST['Stakeholder_id'];
	$Seq_Num = $_POST['Seq_Num'];
	$Emploee_id = $_POST['Emploee_id'];
	$Amount = $_POST['Amount'];
	$Date = $_POST['Date'];
	$remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])) {   
		try {
			$query="INSERT INTO stakeholder_payement (Project_id, Stakeholder_id, Seq_Num, Emploee_id, Amount, Date, Remark) 
						VALUES ( '$Project_id','$Stakeholder_id' , '$Seq_Num', '$Emploee_id', '$Amount', '$Date', '$remark')";
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
	       
	    $sql = "UPDATE stakeholder_payement SET $col='{$value}' WHERE Seq_Num='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Amount']) && !empty($_POST['Amount'])) {
			updater(Amount,$_POST['Amount'],$_POST['Seq_Num']);
		}
		if (isset($_POST['Date']) && !empty($_POST['Date'])) {
			updater(Date,$_POST['Date'],$_POST['Seq_Num']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Seq_Num']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM stakeholder_payement";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Project_id: " . $row["Project_id"]. str_repeat('&nbsp;', 5)	." 	**Stakeholder_id: " . $row["Stakeholder_id"]. str_repeat('&nbsp;', 5) ." **Seq_Num: " . $row["Seq_Num"].str_repeat('&nbsp;', 5)." **Emploee_id:" . $row["Emploee_id"] .str_repeat('&nbsp;', 5)." **Amount:" . $row["Amount"] .str_repeat('&nbsp;', 5)." **Date:" . $row["Date"] .str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}
	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM stakeholder_payement WHERE Seq_Num= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['Seq_Num']) && !empty($_POST['Seq_Num'])) {
			deleter($_POST['Seq_Num']);
		}		
	}

	$conn->close();
}

?>	