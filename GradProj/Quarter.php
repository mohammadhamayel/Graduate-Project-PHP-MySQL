<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="Quarter.php">

	<div class="input-c">
		<label for="City_id">City_id</label>
		<input id="text" type="text" name="City_id" />
	</div>

	<div class="input-c">
		<label for="Quarter_id">Quarter_id</label>
		<input id="password" type="text" name="Quarter_id" />
	</div>

	<div class="input-c">
		<label for="Emploee_id">Emploee_id</label>
		<input id="confirm_password" type="text" name="Emploee_id" />
	</div>

	<div class="input-c">
		<label for="Name">Name</label>
		<input id="username" type="text" name="Name" />
	</div>

	<div class="input-c">
		<label for="Remark">Remark</label>
		<input id="username" type="text" name="Remark" />
	</div>


	<button type="submit" name="insert">Insert</button>
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
			/*'City_id' => 'City_id is required',
			'Quarter_id' => 'Quarter_id  is required',
			'Emploee_id' => 'Emploee_id  is required',*/
			'Name' => 'Name is required'
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

	$City_id = $_POST['City_id'];
	$Quarter_id = $_POST['Quarter_id'];
	$Emploee_id = $_POST['Emploee_id'];
	$Name = $_POST['Name'];
	$Remark = $_POST['Remark'];

	// for Insert -------------------------------------------------------------------------------------

	if (isset($_POST['insert'])) {
		try {
			$query= "INSERT INTO quarter (City_id, Quarter_id, Emploee_id, Name,  Remark) 
						VALUES ( '$City_id', '$Quarter_id' , '$Emploee_id', '$Name', '$Remark')";
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
	       
	    $sql = "UPDATE quarter SET $col='{$value}' WHERE Quarter_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}


	if (isset($_POST['edit'])) {

		if (isset($_POST['Name']) && !empty($_POST['Name'])&& !empty($_POST['Quarter_id'])) {
			updater(Name,$_POST['Name'],$_POST['Quarter_id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])&& !empty($_POST['Quarter_id'])) {
			updater(Remark,$_POST['Remark'],$_POST['Quarter_id']);
		}
	}

	// for Search -------------------------------------------------------------------------------------

	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM quarter";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "City: " . $row["City_id"]. str_repeat('&nbsp;', 5)." **Quarter_id: " . $row["Quarter_id"]	. str_repeat('&nbsp;', 5)." 	**Employee: " . $row["Emploee_id"]. str_repeat('&nbsp;', 5) ." **Name: " . $row["Name"]. str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}

	// for Delete -------------------------------------------------------------------------------------

	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM quarter WHERE Quarter_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['Quarter_id']) && !empty($_POST['Quarter_id'])) {
			deleter($_POST['Quarter_id']);
		}
		
	}

	$conn->close();
}

?>	