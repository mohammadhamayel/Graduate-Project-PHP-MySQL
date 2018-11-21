<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="Services.php">

	<div class="input-c">
		<label for="project_id">project_id</label>
		<input id="text" type="text" name="project_id" />
	</div>

	<div class="input-c">
		<label for="Building_id">Building_id</label>
		<input id="password" type="text" name="Building_id" />
	</div>

	<div class="input-c">
		<label for="Emploee_id">Emploee_id</label>
		<input id="confirm_password" type="text" name="Emploee_id" />
	</div>

	<div class="input-c">
		<label for="Has_elevator">Has_elevator</label>
		<input id="username" type="text" name="Has_elevator" />
	</div>

	<div class="input-c">
		<label for="Has_garden">Has_garden</label>
		<input id="username" type="text" name="Has_garden" />
	</div>

	<div class="input-c">
		<label for="Has_meating_room">Has_meating_room</label>
		<input id="username" type="text" name="Has_meating_room" />
	</div>

	<div class="input-c">
		<label for="Supervisor_name">Supervisor_name</label>
		<input id="username" type="text" name="Supervisor_name" />
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
				'Has_elevator' => 'Has_elevator is required',
				'Has_garden' => 'Has_garden  is required',
				'Has_meating_room' => 'Has_meating_room  is required',
				'Supervisor_name' => 'Supervisor_name is required'
			];
		}else{
			$requiredFields = [
				'Building_id' => 'Building_id is required',				
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

	$project_id = $_POST['project_id'];
	$Building_id = $_POST['Building_id'];
	$Emploee_id = $_POST['Emploee_id'];
	$Has_elevator = $_POST['Has_elevator'];
	$Has_garden = $_POST['Has_garden'];
	$Has_meating_room = $_POST['Has_meating_room'];
	$Supervisor_name = $_POST['Supervisor_name'];
	$remark = $_POST['Remark'];

	if (isset($_POST['insert'])){
		try {
			$query="INSERT INTO services (project_id, Building_id, Emploee_id, Has_elevator, Has_garden, Has_meating_room, Supervisor_name, Remark) 
						VALUES ( '$project_id','$Building_id' , '$Emploee_id', '$Has_elevator', '$Has_garden', '$Has_meating_room', '$Supervisor_name', '$remark')";
						
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
	       
	    $sql = "UPDATE services SET $col='{$value}' WHERE Building_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Has_elevator']) && !empty($_POST['Has_elevator'])) {
			updater(Has_elevator,$_POST['Has_elevator'],$_POST['Building_id']);
		}
		if (isset($_POST['Has_garden']) && !empty($_POST['Has_garden'])) {
			updater(Has_garden,$_POST['Has_garden'],$_POST['Building_id']);
		}
		if (isset($_POST['Has_meating_room'])&& !empty($_POST['Has_meating_room'])) {
			updater(Has_meating_room,$_POST['Has_meating_room'],$_POST['Building_id']);
		}
		if (isset($_POST['Supervisor_name']) && !empty($_POST['Supervisor_name'])) {
			updater(Supervisor_name,$_POST['Supervisor_name'],$_POST['Building_id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Building_id']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM services";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "project_id: " . $row["project_id"]. str_repeat('&nbsp;', 5)	." 	**Building_id: " . $row["Building_id"]. str_repeat('&nbsp;', 5) ." **Emploee_id: " . $row["Emploee_id"].str_repeat('&nbsp;', 5)." **Has_elevator:" . $row["Has_elevator"].str_repeat('&nbsp;', 5)." **Has_garden:" . $row["Has_garden"] .str_repeat('&nbsp;', 5)." **Has_meating_room:" . $row["Has_meating_room"] .str_repeat('&nbsp;', 5)." **Supervisor_name:" . $row["Supervisor_name"] .str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";		    
		 else 
		    echo "0 results";
	}
	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM services WHERE Building_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['Building_id']) && !empty($_POST['Building_id'])) {
			deleter($_POST['Building_id']);
		}		
	}
	$conn->close();
}

?>	