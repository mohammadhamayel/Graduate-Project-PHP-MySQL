<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="customorPayments.php">

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
		<label for="Customer_id">Customer_id</label>
		<input id="username" type="text" name="Customer_id" />
	</div>

	<div class="input-c">
		<label for="Contract_id">Contract_id</label>
		<input id="username" type="text" name="Contract_id" />
	</div>

	<div class="input-c">
		<label for="Seq_num">Seq_num</label>
		<input id="username" type="text" name="Seq_num" />
	</div>

	<div class="input-c">
		<label for="Emploee_id">Emploee_id</label>
		<input id="username" type="text" name="Emploee_id" />
	</div>

	<div class="input-c">
		<label for="Date">Date</label>
		<input id="username" type="text" name="Date" />
	</div>

	<div class="input-c">
		<label for="payments_amount">payments_amount</label>
		<input id="username" type="text" name="payments_amount" />
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
				'Date' => 'Date is required',
				'payments_amount' => 'payments_amount  is required',
				
			];
		}else{
			$requiredFields = [
				'Seq_num' => 'Seq_num is required',
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

	$ProjectId = $_POST['Project_Id'];
	$BuildingId = $_POST['Building_id'];
	$ApartmentId = $_POST['Apartment_id'];
	$CustomerId = $_POST['Customer_id'];
	$ContractId = $_POST['Contract_id'];
	$SeqNum = $_POST['Seq_num'];
	$EmploeeId = $_POST['Emploee_id'];
	$date = $_POST['Date'];
	$paymentsAmount = $_POST['payments_amount'];
	$remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])) {
		try {
			$query="INSERT INTO customor_payments (Project_Id, Building_id, Apartment_id, Customer_id, Contract_id, Seq_num, Emploee_id, Date, payments_amount, Remark) 
						VALUES ( '$ProjectId','$BuildingId' , '$ApartmentId', '$CustomerId', '$ContractId', '$SeqNum', '$EmploeeId', '$date', '$paymentsAmount' ,'$remark')";
						
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
			//database configration
		require "connectDB.php";
	       
	    $sql = "UPDATE customor_payments SET $col='{$value}' WHERE Seq_num='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Date'])&& !empty($_POST['Date'])) {
			updater(Date,$_POST['Date'],$_POST['Seq_num']);
		}
		if (isset($_POST['payments_amount']) && !empty($_POST['payments_amount'])) {
			updater(payments_amount,$_POST['payments_amount'],$_POST['Seq_num']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Seq_num']);
		}
	}

	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM customor_payments";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Project_Id: " . $row["Project_Id"]. str_repeat('&nbsp;', 5)	." 	**Building_id: " . $row["Building_id"]. str_repeat('&nbsp;', 5) ." **Apartment_id: " . $row["Apartment_id"]. str_repeat('&nbsp;', 5)." **Customer_id:" . $row["Customer_id"] .str_repeat('&nbsp;', 5) ." **Contract_id:" . $row["Contract_id"] . str_repeat('&nbsp;', 5) ." **Seq_num:" . $row["Seq_num"] . str_repeat('&nbsp;', 5) ." **Emploee_id:" . $row["Emploee_id"] .str_repeat('&nbsp;', 5)." **Date:" . $row["Date"] .str_repeat('&nbsp;', 5)." **payments_amount:" . $row["payments_amount"] .str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}
	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM customor_payments WHERE Seq_num= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['Seq_num']) && !empty($_POST['Seq_num'])) {
			deleter($_POST['Seq_num']);
		}		
	}

	$conn->close();
}

?>	