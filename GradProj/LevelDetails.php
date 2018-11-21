<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="LevelDetails.php">

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
		<label for="Emploee_id">Emploee_id</label>
		<input id="username" type="text" name="Emploee_id" />
	</div>

	<div class="input-c">
		<label for="Start_date">Start_date</label>
		<input id="username" type="text" name="Start_date" />
	</div>

	<div class="input-c">
		<label for="End_date">End_date</label>
		<input id="username" type="text" name="End_date" />
	</div>

	<div class="input-c">
		<label for="Status">Status</label>
		<input id="username" type="text" name="Status" />
	</div>

	<div class="input-c">
		<label for="Details">Details</label>
		<input id="username" type="text" name="Details" />
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
				'Start_date' => 'Start_date is required',
				'End_date' => 'End_date  is required',
				'Status' => 'Status  is required',
				'Details' => 'Details is required'
			];
		}else{
			$requiredFields = [
				'level_id' => 'level_id is required',
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
	$Stage_id = $_POST['Stage_id'];
	$level_id = $_POST['level_id'];
	$Emploee_id = $_POST['Emploee_id'];
	$Start_date = $_POST['Start_date'];
	$End_date = $_POST['End_date'];
	$Status = $_POST['Status'];
	$Details = $_POST['Details'];
	$remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])){
		try {
			$query="INSERT INTO level_details (Project_id, Stage_id, level_id, Emploee_id, Start_date, End_date, Status, Details, Remark) 
						VALUES ( '$Project_id','$Stage_id' , '$level_id', '$Emploee_id', '$Start_date', '$End_date', '$Status', '$Details', '$remark')";
						
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
	       
	    $sql = "UPDATE level_details SET $col='{$value}' WHERE level_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Start_date']) && !empty($_POST['Start_date'])) {
			updater(Start_date,$_POST['Start_date'],$_POST['level_id']);
		}
		if (isset($_POST['End_date']) && !empty($_POST['End_date'])) {
			updater(End_date,$_POST['End_date'],$_POST['level_id']);
		}
		if (isset($_POST['Status']) && !empty($_POST['Status'])) {
			updater(Status,$_POST['Status'],$_POST['level_id']);
		}
		if (isset($_POST['Details']) && !empty($_POST['Details'])) {
			updater(Details,$_POST['Details'],$_POST['level_id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['level_id']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM level_details";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Project_id: " . $row["Project_id"]. str_repeat('&nbsp;', 5)	." 	**Stage_id: " . $row["Stage_id"]. str_repeat('&nbsp;', 5) ." **level_id: " . $row["level_id"].str_repeat('&nbsp;', 5)." **Emploee_id:" . $row["Emploee_id"].str_repeat('&nbsp;', 5)." **Start_date:" . $row["Start_date"] .str_repeat('&nbsp;', 5)." **End_date:" . $row["End_date"] .str_repeat('&nbsp;', 5)." **Status:" . $row["Status"] .str_repeat('&nbsp;', 5)." **Details:" . $row["Details"] .str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";		    
		 else 
		    echo "0 results";
	}
	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM level_details WHERE level_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['level_id']) && !empty($_POST['level_id'])) {
			deleter($_POST['level_id']);
		}		
	}
	$conn->close();
}

?>	