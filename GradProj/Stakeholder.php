<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../Css/styles.css">
</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded" action="Stakeholder.php">

	<div class="input-c">
		<label for="Stakeholders_Id">Stakeholders_Id</label>
		<input id="text" type="text" name="Stakeholders_Id" />
	</div>

	<div class="input-c">
		<label for="Emploee_id">Emploee_id</label>
		<input id="password" type="text" name="Emploee_id" />
	</div>

	<div class="input-c">
		<label for="Name">Name</label>
		<input id="confirm_password" type="text" name="Name" />
	</div>

	<div class="input-c">
		<label for="Phone_number">Phone_number</label>
		<input id="username" type="text" name="Phone_number" />
	</div>

	<div class="input-c">
		<label for="City">City</label>
		<input id="username" type="text" name="City" />
	</div>

	<div class="input-c">
		<label for="address">address</label>
		<input id="username" type="text" name="address" />
	</div>

	<div class="input-c">
		<label for="Email">Email</label>
		<input id="username" type="text" name="Email" />
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
				'Email' => 'Email is required',
				'address' => 'address  is required',
				'Name' => 'Name  is required',
				'Phone_number' => 'Phone_number is required',
				'City' => 'City is required'
			];
		}else{
			$requiredFields = [
				'Stakeholders_Id' => 'Stakeholders_Id is required',
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

	$Stakeholders_Id = $_POST['Stakeholders_Id'];
	$Emploee_id = $_POST['Emploee_id'];
	$Name = $_POST['Name'];
	$Phone_number = $_POST['Phone_number'];
	$City = $_POST['City'];
	$address = $_POST['address'];
	$Email = $_POST['Email'];
	$remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])){
		try {
			$query="INSERT INTO stakeholder (Stakeholders_Id, Emploee_id, Name, Phone_number,City, address, Email, Remark) 
						VALUES ( '$Stakeholders_Id','$Emploee_id' , '$Name', '$Phone_number','$City', '$address', '$Email', '$remark')";
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
	       
	    $sql = "UPDATE stakeholder SET $col='{$value}' WHERE Stakeholders_Id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Name']) && !empty($_POST['Name'])) {
			updater(Name,$_POST['Name'],$_POST['Stakeholders_Id']);
		}
		if (isset($_POST['Phone_number']) && !empty($_POST['Phone_number'])) {
			updater(Phone_number,$_POST['Phone_number'],$_POST['Stakeholders_Id']);
		}
		if (isset($_POST['City']) && !empty($_POST['City'])) {
			updater(City,$_POST['City'],$_POST['Stakeholders_Id']);
		}
		if (isset($_POST['address'])&& !empty($_POST['address'])) {
			updater(address,$_POST['address'],$_POST['Stakeholders_Id']);
		}
		if (isset($_POST['Email']) && !empty($_POST['Email'])) {
			updater(Email,$_POST['Email'],$_POST['Stakeholders_Id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Stakeholders_Id']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM stakeholder";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Stakeholders_Id: " . $row["Stakeholders_Id"]. str_repeat('&nbsp;', 5)	." 	**Emploee_id: " . $row["Emploee_id"]. str_repeat('&nbsp;', 5) ." **Name: " . $row["Name"].str_repeat('&nbsp;', 5)." **Phone_number:" . $row["Phone_number"].str_repeat('&nbsp;', 5)." **City:" . $row["City"] .str_repeat('&nbsp;', 5)." **address:" . $row["address"] .str_repeat('&nbsp;', 5)." **Email:" . $row["Email"] .str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}
	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM stakeholder WHERE Stakeholders_Id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['Stakeholders_Id']) && !empty($_POST['Stakeholders_Id'])) {
			deleter($_POST['Stakeholders_Id']);
		}		
	}

	$conn->close();
}

?>	