<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="projectCustomer.php">

	<div class="input-c">
		<label for="Project_id">Project_id</label>
		<input id="text" type="text" name="Project_id" />
	</div>

	<div class="input-c">
		<label for="Contract_id">Contract_id</label>
		<input id="password" type="text" name="Contract_id" />
	</div>

	<div class="input-c">
		<label for="Customer_id">Customer_id</label>
		<input id="confirm_password" type="text" name="Customer_id" />
	</div>

	<div class="input-c">
		<label for="Emploee_id">Emploee_id</label>
		<input id="username" type="text" name="Emploee_id" />
	</div>

	<div class="input-c">
		<label for="Percantage">Percantage</label>
		<input id="username" type="text" name="Percantage" />
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
				'Percantage' => 'Percantage is required',
				
			];
		}else{
			$requiredFields = [
				'Percantage' => 'Percantage is required',
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
	$Contract_id = $_POST['Contract_id'];
	$Customer_id = $_POST['Customer_id'];
	$Emploee_id = $_POST['Emploee_id'];
	$Percantage = $_POST['Percantage'];
	$Remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
    if (isset($_POST['insert'])) {
		try {
			$query="INSERT INTO project_customer (Project_id, Contract_id, Customer_id, Emploee_id, Percantage, Remark) 
						VALUES ( '$Project_id','$Contract_id' , '$Customer_id', '$Emploee_id', '$Percantage', '$Remark')";
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
	       
	    $sql = "UPDATE project_customer SET $col='{$value}' WHERE Customer_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Percantage']) && !empty($_POST['Percantage'])) {
			updater(Percantage,$_POST['Percantage'],$_POST['Customer_id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Customer_id']);
		}
	}

	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM project_customer";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Project_id: " . $row["Project_id"]. str_repeat('&nbsp;', 5)	." 	**Contract_id: " . $row["Contract_id"]. str_repeat('&nbsp;', 5) ." **Customer_id: " . $row["Customer_id"].str_repeat('&nbsp;', 5)." **Emploee_id:" . $row["Emploee_id"] .str_repeat('&nbsp;', 5)." **Percantage:" . $row["Percantage"] .str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}

	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM project_customer WHERE Customer_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['Customer_id']) && !empty($_POST['Customer_id'])) {
			deleter($_POST['Customer_id']);
		}		
	}
	$conn->close();
}

?>	