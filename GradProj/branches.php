<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">

</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="branches.php">

	<div class="input-c">
		<label for="Bank_id">Bank id</label>
		<input id="text" type="text" name="Bank_id" />
	</div>

	<div class="input-c">
		<label for="Branch_id">Branch id</label>
		<input id="password" type="text" name="Branch_id" />
	</div>

	<div class="input-c">
		<label for="Employee_Id">Employee_Id</label>
		<input id="confirm_password" type="text" name="Employee_Id" />
	</div>

	<div class="input-c">
		<label for="Branch_name">Branch_name</label>
		<input id="username" type="text" name="Branch_name" />
	</div>

	<div class="input-c">
		<label for="Address">Address</label>
		<input id="username" type="text" name="Address" />
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
			'Bank_id' => 'Bank_id is required',
			'Branch_id' => 'Branch_id  is required',
			'Employee_Id' => 'Employee_Id  is required',
			'Branch_name' => 'Branch_name is required'
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

	$bankId = $_POST['Bank_id'];
	$branchId = $_POST['Branch_id'];
	$employeeId = $_POST['Employee_Id'];
	$BranchName = $_POST['Branch_name'];
	$address = $_POST['Address'];
	$remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])) {    
		try {
			$query="INSERT INTO branches (Bank_id, Branch_id, Employee_Id, Branch_name, Address, Remark) 
						VALUES ( '$bankId','$branchId' , '$employeeId', '$BranchName', '$address', '$remark')";
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
	       
	    $sql = "UPDATE branches SET $col='{$value}' WHERE Branch_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Branch_name']) && !empty($_POST['Branch_name'])) {
			updater(Branch_name,$_POST['Branch_name'],$_POST['Branch_id']);
		}
		if (isset($_POST['Address'])&& !empty($_POST['Address'])) {
			updater(Address,$_POST['Address'],$_POST['Branch_id']);
		}		
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Branch_id']);
		}
	}

	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM branches";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Bank_id: " . $row["Bank_id"]. str_repeat('&nbsp;', 5)	." 	**Branch_id: " . $row["Branch_id"]. str_repeat('&nbsp;', 5) ." **Employee_Id: " . $row["Employee_Id"]. str_repeat('&nbsp;', 5)." **Branch_name:" . $row["Branch_name"] .str_repeat('&nbsp;', 5) ." **Address:" . $row["Address"]  . str_repeat('&nbsp;', 5) ." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}
	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM branches WHERE Branch_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['Branch_id']) && !empty($_POST['Branch_id'])) {
			deleter($_POST['Branch_id']);
		}		
	}

	$conn->close();
}

?>	