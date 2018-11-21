<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="../Css/styles.css">
	</head>
	<body>
		<form method="post" enctype="application/x-www-form-urlencoded" >

			<div class="input-c">
				<label for="Emploee_id">Emploee_id</label>
				<input id="text" type="text" name="Emploee_id" />
			</div>

			<div class="input-c">
				<label for="Name">Name</label>
				<input id="password" type="text" name="Name" />
			</div>

			<div class="input-c">
				<label for="Email">Email</label>
				<input id="confirm_password" type="text" name="Email" />
			</div>

			<div class="input-c">
				<label for="City">City</label>
				<input id="username" type="text" name="City" />
			</div>

			<div class="input-c">
				<label for="Phone_Number">Phone_Number</label>
				<input id="username" type="text" name="Phone_Number" />
			</div>

			<div class="input-c">
				<label for="Salary">Salary</label>
				<input id="username" type="text" name="Salary" />
			</div>

			<div class="input-c">
				<label for="Marital_status">Marital_status</label>
				<input id="username" type="text" name="Marital_status" />
			</div>

			<div class="input-c">
				<label for="Address">Address</label>
				<input id="username" type="text" name="Address" />
			</div>

			<div class="input-c">
				<label for="DOB">DOB</label>
				<input id="username" type="text" name="DOB" />
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
				'Email' => 'Email  is required',
				'City' => 'City is required',
				'Phone_Number' => 'Phone_Number  is required',
				'Salary' => 'Salary is required',
				'Marital_status' => 'Marital_status  is required',
				'Address' => 'Address is required',
				'DOB' => 'DOB  is required'								
			];
		}else{
			$requiredFields = [
				'Emploee_id' => 'Emploee_id is required',
			];
		}
		foreach($requiredFields as $key => $message) {
			if (!isset($_POST[$key]) || empty($_POST[$key])) {
				die($message);
			}
		}
	}

	require "connectDB.php";

	$Emploee_id = $_POST['Emploee_id'];
	$Name = $_POST['Name'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$Phone_Number = $_POST['Phone_Number'];
	$Salary = $_POST['Salary'];
	$Marital_status = $_POST['Marital_status'];
	$Address = $_POST['Address'];
	$DOB = $_POST['DOB'];
	$Remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])) {
		try {
			$query="INSERT INTO employee (Emploee_id, Name, Email, City, Phone_Number, Salary, Marital_status, Address, DOB, Remark) 
						VALUES ( '$Emploee_id','$Name' , '$Email', '$City', '$Phone_Number', '$Salary', '$Marital_status', '$Address', '$DOB' ,'$Remark')";
						
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
	       
	    $sql = "UPDATE employee SET $col='{$value}' WHERE Emploee_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Name'])&& !empty($_POST['Name'])) {
			updater(Name,$_POST['Name'],$_POST['Emploee_id']);
		}
		if (isset($_POST['Email']) && !empty($_POST['Email'])) {
			updater(Email,$_POST['Email'],$_POST['Emploee_id']);
		}
		if (isset($_POST['City'])&& !empty($_POST['City'])) {
			updater(City,$_POST['City'],$_POST['Emploee_id']);
		}
		if (isset($_POST['Phone_Number'])&& !empty($_POST['Phone_Number'])) {
			updater(Phone_Number,$_POST['Phone_Number'],$_POST['Emploee_id']);
		}
		if (isset($_POST['Salary']) && !empty($_POST['Salary'])) {
			updater(Salary,$_POST['Salary'],$_POST['Emploee_id']);
		}
		if (isset($_POST['Marital_status'])&& !empty($_POST['Marital_status'])) {
			updater(Marital_status,$_POST['Marital_status'],$_POST['Emploee_id']);
		}
		if (isset($_POST['Address'])&& !empty($_POST['Address'])) {
			updater(Address,$_POST['Address'],$_POST['Emploee_id']);
		}
		if (isset($_POST['DOB']) && !empty($_POST['DOB'])) {
			updater(DOB,$_POST['DOB'],$_POST['Emploee_id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Emploee_id']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM employee";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Emploee_id: " . $row["Emploee_id"]. str_repeat('&nbsp;', 5)	." 	**Name: " . $row["Name"]. str_repeat('&nbsp;', 5) ." **Email: " . $row["Email"]. str_repeat('&nbsp;', 5)." **City:" . $row["City"] .str_repeat('&nbsp;', 5) ." **Phone_Number:" . $row["Phone_Number"] . str_repeat('&nbsp;', 5) ." **Salary:" . $row["Salary"] . str_repeat('&nbsp;', 5) ." **Marital_status:" . $row["Marital_status"] .str_repeat('&nbsp;', 5)." **Address:" . $row["Address"] .str_repeat('&nbsp;', 5)." **DOB:" . $row["DOB"] .str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}

	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM employee WHERE Emploee_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}	if (isset($_POST['delete'])) {

		if (isset($_POST['Emploee_id']) && !empty($_POST['Emploee_id'])) {
			deleter($_POST['Emploee_id']);
		}		
	}

	$conn->close();
}

?>