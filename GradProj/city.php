<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">

</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="city.php">

		<div class="input-c">
			<label for="city_id">City Id</label>
			<input id="text" type="text" name="city_id" />
		</div>

		<div class="input-c">
			<label for="employee_id">Employee Id</label>
			<input id="password" type="text" name="employee_id" />
		</div>

		<div class="input-c">
			<label for="Name">City Name</label>
			<input id="confirm_password" type="text" name="Name" />
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
		'city_id' => 'City Id is required',
		'employee_id' => 'Employee Id is required',
		'Name' => 'City Name is required',
		'Remark' => 'Remark is required'
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

	$email = $_POST['city_id'];
	$confirmationCode = $_POST['employee_id'];
	$insertPassword = $_POST['Name'];
	$insertUsername = $_POST['Remark'];

// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])) {

		try {
			$query="INSERT INTO city (Employee_id, Name, Remark) VALUES ( '$confirmationCode', '$insertPassword' , '$insertUsername')";
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
	       
	    $sql = "UPDATE city SET $col='{$value}' WHERE city_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Name']) && !empty($_POST['Name'])) {
			updater(Name,$_POST['Name'],$_POST['city_id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['city_id']);
		}
	}

// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM city";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "City: " . $row["city_id"]. str_repeat('&nbsp;', 5)	." 	**Employee: " . $row["Employee_id"]. str_repeat('&nbsp;', 5) ." **Name: " . $row["Name"]. str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}

	// for Delete -------------------------------------------------------------------------------------

	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM city WHERE city_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['city_id']) && !empty($_POST['city_id'])) {
			deleter($_POST['city_id']);
		}
		
	}


	$conn->close();
}

?>	