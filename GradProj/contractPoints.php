<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="contractPoints.php">

	<div class="input-c">
		<label for="Project_Id">Project_Id</label>
		<input id="text" type="text" name="Project_Id" />
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
		<label for="Customer_ID">Customer_ID</label>
		<input id="username" type="text" name="Customer_ID" />
	</div>

	<div class="input-c">
		<label for="Contract_id">Contract_id</label>
		<input id="username" type="text" name="Contract_id" />
	</div>

	<div class="input-c">
		<label for="Seq">Seq</label>
		<input id="username" type="text" name="Seq" />
	</div>

	<div class="input-c">
		<label for="Emploee_id">Emploee_id</label>
		<input id="username" type="text" name="Emploee_id" />
	</div>

	<div class="input-c">
		<label for="Detail">Detail</label>
		<input id="username" type="text" name="Detail" />
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
    if (isset($_POST['insert'])) {
		$requiredFields = [
			'Detail' => 'Detail is required',
		];

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
	$SectionId = $_POST['Section_id'];
	$CustomerID = $_POST['Customer_ID'];
	$ContractId = $_POST['Contract_id'];
	$seq = $_POST['Seq'];
	$EmploeeId = $_POST['Emploee_id'];
	$detail = $_POST['Detail'];
	$remark = $_POST['Remark'];

	// for update -------------------------------------------------------------------------------------
    if (isset($_POST['insert'])) {
		try {
			$query="INSERT INTO contract_points (Project_Id, Building_id, Section_id, Customer_ID, Contract_id, Seq, Emploee_id, Detail, Remark) 
						VALUES ( '$ProjectId','$BuildingId' , '$SectionId', '$CustomerID', '$ContractId', '$seq', '$EmploeeId', '$detail', '$remark')";
						
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
	       
	    $sql = "UPDATE contract_points SET $col='{$value}' WHERE Seq='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Detail'])&& !empty($_POST['Detail'])) {
			updater(Detail,$_POST['Detail'],$_POST['Seq']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Seq']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM contract_points";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Project_Id: " . $row["Project_Id"]. str_repeat('&nbsp;', 5)	." 	**Building_id: " . $row["Building_id"]. str_repeat('&nbsp;', 5) ." **Section_id: " . $row["Section_id"]. str_repeat('&nbsp;', 5)." **Customer_ID:" . $row["Customer_ID"] .str_repeat('&nbsp;', 5) ." **Contract_id:" . $row["Contract_id"] . str_repeat('&nbsp;', 5) ." **Seq:" . $row["Seq"] . str_repeat('&nbsp;', 5) ." **Emploee_id:" . $row["Emploee_id"] .str_repeat('&nbsp;', 5)." **Detail:" . $row["Detail"] .str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}

	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM contract_points WHERE Seq= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['Seq']) && !empty($_POST['Seq'])) {
			deleter($_POST['Seq']);
		}		
	}

	$conn->close();
}

?>	