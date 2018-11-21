<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="levels.php">

		<div class="input-c">
			<label for="stage_id">stage_id</label>
			<input id="text" type="text" name="stage_id" />
		</div>

		<div class="input-c">
			<label for="Levels_id">Levels_id</label>
			<input id="password" type="text" name="Levels_id" />
		</div>

		<div class="input-c">
			<label for="Emploee_id">Emploee_id</label>
			<input id="confirm_password" type="text" name="Emploee_id" />
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
    	if (isset($_POST['insert'])) {
			$requiredFields = [
				'Remark' => 'Remark Id is required',				
			];
		}else{
				$requiredFields = [
				'stage_id' => 'stage_id Id is required',
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

	$stage_id = $_POST['stage_id'];
	$Levels_id = $_POST['Levels_id'];
	$Emploee_id = $_POST['Emploee_id'];
	$Remark = $_POST['Remark'];

	if (isset($_POST['insert'])) {
		try {
			$query="INSERT INTO levels (stage_id, Levels_id, Emploee_id, Remark) VALUES ( '$stage_id', '$Levels_id', '$Emploee_id' , '$Remark'  )";
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
	       
	    $sql = "UPDATE levels SET $col='{$value}' WHERE stage_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['stage_id']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM levels";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "stage_id: " . $row["stage_id"]. str_repeat('&nbsp;', 5)	." 	**Levels_id: " . $row["Levels_id"]. str_repeat('&nbsp;', 5) ." **Emploee_id: " . $row["Emploee_id"]. str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";		    
		 else 
		    echo "0 results";
	}

	// for Delete -------------------------------------------------------------------------------------

	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM levels WHERE stage_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['stage_id']) && !empty($_POST['stage_id'])) {
			deleter($_POST['stage_id']);
		}
		
	}

	$conn->close();
}

?>	