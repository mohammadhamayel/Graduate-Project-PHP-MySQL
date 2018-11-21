<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">

</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="building.php">

	<div class="input-c">
		<label for="Project_id">Project_id</label>
		<input id="text" type="text" name="Project_id" />
	</div>

	<div class="input-c">
		<label for="Building_Id">Building_Id</label>
		<input id="password" type="text" name="Building_Id" />
	</div>

	<div class="input-c">
		<label for="Employee_Id">Employee_Id</label>
		<input id="confirm_password" type="text" name="Employee_Id" />
	</div>

	<div class="input-c">
		<label for="Name">Name</label>
		<input id="username" type="text" name="Name" />
	</div>

	<div class="input-c">
		<label for="Number_of_floors">Number_of_floors</label>
		<input id="username" type="text" name="Number_of_floors" />
	</div>

	<div class="input-c">
		<label for="Number_of_apartments">Number_of_apartments</label>
		<input id="username" type="text" name="Number_of_apartments" />
	</div>

	<div class="input-c">
		<label for="7od_id">7od_id</label>
		<input id="username" type="text" name="7od_id" />
	</div>

	<div class="input-c">
		<label for="Plot_id">Plot_id</label>
		<input id="username" type="text" name="Plot_id" />
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
				'Name' => 'Name is required',
				'Number_of_floors' => 'Number_of_floors  is required',
				'Number_of_apartments' => 'Number_of_apartments  is required',
				'7od_id' => '7od_id is required',
				'Plot_id' => 'Plot_id is required',
			];
		}else{
			$requiredFields = [
				'Building_Id' => 'Building_Id is required',				
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
	$BuildingId = $_POST['Building_Id'];
	$employeeId = $_POST['Employee_Id'];
	$name = $_POST['Name'];
	$NumberOfFloors = $_POST['Number_of_floors'];
	$NumberOfApartments = $_POST['Number_of_apartments'];
	$hodId = $_POST['7od_id'];
	$PlotId = $_POST['Plot_id'];
	$remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])){
		try {
			$query="INSERT INTO building (Project_id, Building_Id, Employee_Id, Name, Number_of_floors, Number_of_apartments, 7od_id, Plot_id, Remark) 
						VALUES ( '$ProjectId','$BuildingId' , '$employeeId', '$name', '$NumberOfFloors', '$NumberOfApartments', '$hodId', '$PlotId', '$remark')";
						
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
	       
	    $sql = "UPDATE building SET $col='{$value}' WHERE Building_Id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Name']) && !empty($_POST['Name'])) {
			updater(Name,$_POST['Name'],$_POST['Building_Id']);
		}
		if (isset($_POST['Number_of_floors']) && !empty($_POST['Number_of_floors'])) {
			updater(Number_of_floors,$_POST['Number_of_floors'],$_POST['Building_Id']);
		}
		if (isset($_POST['Number_of_apartments'])&& !empty($_POST['Number_of_apartments'])) {
			updater(Number_of_apartments,$_POST['Number_of_apartments'],$_POST['Building_Id']);
		}
		if (isset($_POST['7od_id']) && !empty($_POST['7od_id'])) {
			updater("7od_id",$_POST['7od_id'],$_POST['Building_Id']);
		}
		if (isset($_POST['Plot_id']) && !empty($_POST['Plot_id'])) {
			updater(Plot_id,$_POST['Plot_id'],$_POST['Building_Id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Building_Id']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM building";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Project_id: " . $row["Project_id"]. str_repeat('&nbsp;', 5)	." 	**Building_Id: " . $row["Building_Id"]. str_repeat('&nbsp;', 5) ." **Employee_Id: " . $row["Employee_Id"].str_repeat('&nbsp;', 5)." **Name:" . $row["Name"].str_repeat('&nbsp;', 5)." **Number_of_floors:" . $row["Number_of_floors"] .str_repeat('&nbsp;', 5)." **Number_of_apartments:" . $row["Number_of_apartments"] .str_repeat('&nbsp;', 5)." **7od_id:" . $row["7od_id"] .str_repeat('&nbsp;', 5)." **Plot_id:" . $row["Plot_id"] .str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";		    
		 else 
		    echo "0 results";
	}
	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM building WHERE Building_Id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['Building_Id']) && !empty($_POST['Building_Id'])) {
			deleter($_POST['Building_Id']);
		}		
	}

	$conn->close();
}

?>	