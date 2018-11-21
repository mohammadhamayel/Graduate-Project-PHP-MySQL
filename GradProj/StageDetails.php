<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="StageDetails.php">

	<div class="input-c">
		<label for="Porject_id">Porject_id</label>
		<input id="text" type="text" name="Porject_id" />
	</div>

	<div class="input-c">
		<label for="Stage_id">Stage_id</label>
		<input id="password" type="text" name="Stage_id" />
	</div>

	<div class="input-c">
		<label for="Employee_id">Employee_id</label>
		<input id="confirm_password" type="text" name="Employee_id" />
	</div>

	<div class="input-c">
		<label for="State">State</label>
		<input id="username" type="text" name="State" />
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
    if (isset($_POST['insert']) || isset($_POST['edit']) ) {
    	if (isset($_POST['insert'])){
			$requiredFields = [
				'State' => 'State is required',
				'Start_date' => 'Start_date is required',
				'End_date' => 'End_date  is required'
				
			];
		}else{
			$requiredFields = [
				'Stage_id' => 'Stage_id is required',
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

	$Porject_id = $_POST['Porject_id'];
	$Stage_id = $_POST['Stage_id'];
	$Employee_id = $_POST['Employee_id'];
	$State = $_POST['State'];
	$Start_date = $_POST['Start_date'];
	$End_date = $_POST['End_date'];
	$remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])) {
		try {
			$query="INSERT INTO stage_details (Porject_id, Stage_id, Employee_id, State, Start_date, End_date, Remark) 
						VALUES ( '$Porject_id','$Stage_id' , '$Employee_id', '$State', '$Start_date', '$End_date', '$remark')";
						
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
	       
	    $sql = "UPDATE stage_details SET $col='{$value}' WHERE Stage_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['State']) && !empty($_POST['State'])) {
			updater(State,$_POST['State'],$_POST['Stage_id']);
		}
		if (isset($_POST['Start_date'])&& !empty($_POST['Start_date'])) {
			updater(Start_date,$_POST['Start_date'],$_POST['Stage_id']);
		}
		if (isset($_POST['End_date']) && !empty($_POST['End_date'])) {
			updater(End_date,$_POST['End_date'],$_POST['Stage_id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Stage_id']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM stage_details";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Porject_id: " . $row["Porject_id"]. str_repeat('&nbsp;', 5)	." 	**Stage_id: " . $row["Stage_id"]. str_repeat('&nbsp;', 5) ." **Employee_id: " . $row["Employee_id"]. str_repeat('&nbsp;', 5)." **State:" . $row["State"] .str_repeat('&nbsp;', 5) ." **Start_date:" . $row["Start_date"] . str_repeat('&nbsp;', 5) ." **End_date:" . $row["End_date"] . str_repeat('&nbsp;', 5) ." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}
	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM stage_details WHERE Stage_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['Stage_id']) && !empty($_POST['Stage_id'])) {
			deleter($_POST['Stage_id']);
		}		
	}

	$conn->close();
}

?>	