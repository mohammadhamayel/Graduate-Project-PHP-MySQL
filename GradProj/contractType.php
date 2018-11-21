<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="contractType.php">

	<div class="input-c">
		<label for="type_id">type_id</label>
		<input id="text" type="text" name="type_id" />
	</div>

	<div class="input-c">
		<label for="Emploee_id">Emploee_id</label>
		<input id="password" type="text" name="Emploee_id" />
	</div>

	<div class="input-c">
		<label for="TypeDetail">TypeDetail</label>
		<input id="confirm_password" type="text" name="TypeDetail" />
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
			'TypeDetail' => 'TypeDetail is required',
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

	$typeId = $_POST['type_id'];
	$EmploeeId = $_POST['Emploee_id'];
	$typeDetail = $_POST['TypeDetail'];
	$remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])) {
		try {
			$query="INSERT INTO contract_type (type_id, Emploee_id, TypeDetail, Remark) VALUES ( '$typeId', '$EmploeeId', '$typeDetail' , '$remark')";
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
	       
	    $sql = "UPDATE contract_type SET $col='{$value}' WHERE type_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['TypeDetail']) && !empty($_POST['TypeDetail'])) {
			updater(TypeDetail,$_POST['TypeDetail'],$_POST['type_id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['type_id']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM contract_type";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "type_id: " . $row["type_id"]. str_repeat('&nbsp;', 5)	." 	**Emploee_id: " . $row["Emploee_id"]. str_repeat('&nbsp;', 5) ." **TypeDetail: " . $row["TypeDetail"].str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}

	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM contract_type WHERE type_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['type_id']) && !empty($_POST['type_id'])) {
			deleter($_POST['type_id']);
		}		
	}

	$conn->close();
}

?>	