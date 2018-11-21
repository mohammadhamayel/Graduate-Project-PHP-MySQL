<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="ProjectStakeholder.php">

	<div class="input-c">
		<label for="Project_id">Project_id</label>
		<input id="text" type="text" name="Project_id" />
	</div>

	<div class="input-c">
		<label for="Stackholder_id">Stackholder_id</label>
		<input id="password" type="text" name="Stackholder_id" />
	</div>

	<div class="input-c">
		<label for="Emploee_id">Emploee_id</label>
		<input id="confirm_password" type="text" name="Emploee_id" />
	</div>

	<div class="input-c">
		<label for="Percentage">Percentage</label>
		<input id="username" type="text" name="Percentage" />
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
    if (isset($_POST['insert'])|| isset($_POST['edit'])) {
    	if (isset($_POST['insert'])){
			$requiredFields = [
				'Balance' => 'Balance  is required',
				'Percentage' => 'Percentage is required'
			];
		}
		if (isset($_POST['edit'])){
			$requiredFields = [
				'Stackholder_id' => 'Stackholder_id  is required',
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
	$Stackholder_id = $_POST['Stackholder_id'];
	$Emploee_id = $_POST['Emploee_id'];
	$Percentage = $_POST['Percentage'];
	$Balance = $_POST['Balance'];
	$Remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])) {   
		try {
			$query="INSERT INTO project_stakeholder (Project_id, Stackholder_id, Emploee_id, Percentage, Balance, Remark) 
						VALUES ( '$Project_id','$Stackholder_id' , '$Emploee_id', '$Percentage', '$Balance', '$Remark')";
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
	       
	    $sql = "UPDATE project_stakeholder SET $col='{$value}' WHERE Stackholder_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Percentage']) && !empty($_POST['Percentage'])) {
			updater(Percentage,$_POST['Percentage'],$_POST['Stackholder_id']);
		}
		if (isset($_POST['Balance']) && !empty($_POST['Balance'])) {
			updater(Balance,$_POST['Balance'],$_POST['Stackholder_id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Stackholder_id']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM project_stakeholder";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Project_id: " . $row["Project_id"]. str_repeat('&nbsp;', 5)	." 	**Stackholder_id: " . $row["Stackholder_id"]. str_repeat('&nbsp;', 5) ." **Emploee_id: " . $row["Emploee_id"].str_repeat('&nbsp;', 5)." **Percentage:" . $row["Percentage"] .str_repeat('&nbsp;', 5)." **Balance:" . $row["Balance"] .str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}
	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM project_stakeholder WHERE Stackholder_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['Stackholder_id']) && !empty($_POST['Stackholder_id'])) {
			deleter($_POST['Stackholder_id']);
		}		
	}

	$conn->close();
}

?>	