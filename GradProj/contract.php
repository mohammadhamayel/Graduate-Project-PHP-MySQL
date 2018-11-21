<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="../Css/styles.css">
	</head>
	<body>
		<form method="post" enctype="application/x-www-form-urlencoded" action="contract.php">

			<div class="input-c">
				<label for="Project_id">Project_id</label>
				<input id="text" type="text" name="Project_id" />
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
				<label for="contract_type">contract_type</label>
				<input id="username" type="text" name="contract_type" />
			</div>

			<div class="input-c">
				<label for="Emploee_id">Emploee_id</label>
				<input id="username" type="text" name="Emploee_id" />
			</div>

			<div class="input-c">
				<label for="Description">Description</label>
				<input id="username" type="text" name="Description" />
			</div>

			<div class="input-c">
				<label for="Date">Date</label>
				<input id="username" type="text" name="Date" />
			</div>

			<div class="input-c">
				<label for="Value">Value</label>
				<input id="username" type="text" name="Value" />
			</div>

			<div class="input-c">
				<label for="Per_year">Per_year</label>
				<input id="username" type="text" name="Per_year" />
			</div>

			<div class="input-c">
				<label for="Balance">Balance</label>
				<input id="username" type="text" name="Balance" />
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
				'contract_type' => 'contract_type is required',
				'Description' => 'Description is required',
				'Date' => 'Date  is required',
				'Value' => 'Value  is required',
				'Per_year' => 'Per_year is required',
				'Balance' => 'Balance is required'
			];
		}else{
			$requiredFields = [
				'Contract_id' => 'Contract_id is required',
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

	$ProjectId = $_POST['Project_id'];
	$BuildingId = $_POST['Building_id'];
	$ApartmentId = $_POST['Apartment_id'];
	$CustomerId = $_POST['Customer_id'];
	$Contract_id = $_POST['Contract_id'];
	$contractType = $_POST['contract_type'];
	$EmploeeId = $_POST['Emploee_id'];
	$description = $_POST['Description'];
	$date = $_POST['Date'];
	$value = $_POST['Value'];
	$PerYear = $_POST['Per_year'];
	$balance = $_POST['Balance'];
	$remark = $_POST['Remark'];

// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])){
		try {
			$query="INSERT INTO contract (Project_id, Building_id, Apartment_id, Customer_id, Contract_id, contract_type, Emploee_id, Description, Date, Value, Per_year, Balance, Remark) 
						VALUES ( '$ProjectId', '$BuildingId' , '$ApartmentId', '$CustomerId', '$Contract_id', '$contractType', '$EmploeeId', '$description', '$date', 
						'$value', '$PerYear', '$balance', '$remark')";
						
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
	       
	    $sql = "UPDATE contract SET $col='{$value}' WHERE Contract_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {
		if (isset($_POST['contract_type'])&& !empty($_POST['contract_type'])) {
			updater(contract_type,$_POST['contract_type'],$_POST['Contract_id']);
		}
		if (isset($_POST['Description'])&& !empty($_POST['Description'])) {
			updater(Description,$_POST['Description'],$_POST['Contract_id']);
		}
		if (isset($_POST['Date']) && !empty($_POST['Date'])) {
			updater(Date,$_POST['Date'],$_POST['Contract_id']);
		}
		if (isset($_POST['Value'])&& !empty($_POST['Value'])) {
			updater(Value,$_POST['Value'],$_POST['Contract_id']);
		}
		if (isset($_POST['Per_year'])&& !empty($_POST['Per_year'])) {
			updater(Per_year,$_POST['Per_year'],$_POST['Contract_id']);
		}
		if (isset($_POST['Balance']) && !empty($_POST['Balance'])) {
			updater(Balance,$_POST['Balance'],$_POST['Contract_id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Contract_id']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM contract";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Project_id: " . $row["Project_id"]. str_repeat('&nbsp;', 5)	." 	**Building_id: " . $row["Building_id"]. str_repeat('&nbsp;', 5) ." **Apartment_id: " . $row["Apartment_id"]. str_repeat('&nbsp;', 5)." **Customer_id:" . $row["Customer_id"] .str_repeat('&nbsp;', 5) ." **Contract_id:" . $row["Contract_id"] . str_repeat('&nbsp;', 5) ." **contract_type:" . $row["contract_type"] . str_repeat('&nbsp;', 5) ." **Emploee_id:" . $row["Emploee_id"] .str_repeat('&nbsp;', 5)." **Description:" . $row["Description"] .str_repeat('&nbsp;', 5)." **Date:" . $row["Date"] .str_repeat('&nbsp;', 5)." **Value:" . $row["Value"].str_repeat('&nbsp;', 5)." **Per_year:" . $row["Per_year"]. str_repeat('&nbsp;', 5)." **Balance:" . $row["Balance"] .str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}
	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM contract WHERE Contract_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}	if (isset($_POST['delete'])) {

		if (isset($_POST['Contract_id']) && !empty($_POST['Contract_id'])) {
			deleter($_POST['Contract_id']);
		}		
	}

	$conn->close();
}

?>	