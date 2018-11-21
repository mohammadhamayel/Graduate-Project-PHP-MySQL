<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="../Css/styles.css">
	</head>
	<body>
		<form method="post" enctype="application/x-www-form-urlencoded" action="customer.php">

			<div class="input-c">
				<label for="Customer_id">Customer_id</label>
				<input id="text" type="text" name="Customer_id" />
			</div>

			<div class="input-c">
				<label for="Emploee_id">Emploee_id</label>
				<input id="password" type="text" name="Emploee_id" />
			</div>

			<div class="input-c">
				<label for="balance">balance</label>
				<input id="confirm_password" type="text" name="balance" />
			</div>

			<div class="input-c">
				<label for="Name">Name</label>
				<input id="username" type="text" name="Name" />
			</div>

			<div class="input-c">
				<label for="Address">Address</label>
				<input id="username" type="text" name="Address" />
			</div>

			<div class="input-c">
				<label for="Date">Date</label>
				<input id="username" type="text" name="Date" />
			</div>

			<div class="input-c">
				<label for="Rate">Rate</label>
				<input id="username" type="text" name="Rate" />
			</div>

			<div class="input-c">
				<label for="Organization_name">Organization_name</label>
				<input id="username" type="text" name="Organization_name" />
			</div>

			<div class="input-c">
				<label for="State">State</label>
				<input id="username" type="text" name="State" />
			</div>

			<div class="input-c">
				<label for="City">City</label>
				<input id="username" type="text" name="City" />
			</div>

			<div class="input-c">
				<label for="Phone">Phone</label>
				<input id="username" type="text" name="Phone" />
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
				'balance' => 'balance is required',
				'Name' => 'Name  is required',
				'Address' => 'Address is required',
				'Date' => 'Date  is required',
				'Rate' => 'Rate is required',
				'Organization_name' => 'Organization_name  is required',
				'State' => 'State is required',
				'City' => 'City  is required',
				'Phone' => 'Phone  is required',
				'Email' => 'Email is required',
				'Remark' => 'Remark  is required'			
			];
		}else{
			$requiredFields = [
				'Customer_id' => 'Customer_id is required',
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

	$CustomerId = $_POST['Customer_id'];
	$EmploeeId = $_POST['Emploee_id'];
	$balance = $_POST['balance'];
	$name = $_POST['Name'];
	$address = $_POST['Address'];
	$date = $_POST['Date'];
	$rate = $_POST['Rate'];
	$OrganizationName = $_POST['Organization_name'];
	$state = $_POST['State'];
	$city = $_POST['City'];
	$Phone = $_POST['Phone'];
	$balance = $_POST['Email'];
	$remark = $_POST['Remark'];

	if (isset($_POST['insert'])){
		try {
			$query="INSERT INTO customer (Customer_id, Emploee_id, balance, Name, Address, Date, Rate, Organization_name, State, City, Phone, Email, Remark) 
						VALUES ( '$CustomerId', '$EmploeeId' , '$balance', '$name', '$address', '$date', '$rate', '$OrganizationName', '$state', '$city', '$Phone', '$balance', '$remark')";
						
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
	       
	    $sql = "UPDATE customer SET $col='{$value}' WHERE Customer_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['balance'])&& !empty($_POST['balance'])) {
			updater(balance,$_POST['balance'],$_POST['Customer_id']);
		}
		if (isset($_POST['Name']) && !empty($_POST['Name'])) {
			updater(Name,$_POST['Name'],$_POST['Customer_id']);
		}
		if (isset($_POST['Address'])&& !empty($_POST['Address'])) {
			updater(Address,$_POST['Address'],$_POST['Customer_id']);
		}
		if (isset($_POST['Date'])&& !empty($_POST['Date'])) {
			updater(Date,$_POST['Date'],$_POST['Customer_id']);
		}
		if (isset($_POST['Rate']) && !empty($_POST['Rate'])) {
			updater(Rate,$_POST['Rate'],$_POST['Customer_id']);
		}
		if (isset($_POST['Organization_name'])&& !empty($_POST['Organization_name'])) {
			updater(Organization_name,$_POST['Organization_name'],$_POST['Customer_id']);
		}
		if (isset($_POST['State'])&& !empty($_POST['State'])) {
			updater(State,$_POST['State'],$_POST['Customer_id']);
		}
		if (isset($_POST['City']) && !empty($_POST['City'])) {
			updater(City,$_POST['City'],$_POST['Customer_id']);
		}
		if (isset($_POST['Phone'])&& !empty($_POST['Phone'])) {
			updater(Phone,$_POST['Phone'],$_POST['Customer_id']);
		}
		if (isset($_POST['Email']) && !empty($_POST['Email'])) {
			updater(Email,$_POST['Email'],$_POST['Customer_id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Customer_id']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM customer";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Customer_id: " . $row["Customer_id"]. str_repeat('&nbsp;', 5)	." 	**Emploee_id: " . $row["Emploee_id"]. str_repeat('&nbsp;', 5) ." **balance: " . $row["balance"]. str_repeat('&nbsp;', 5)." **Name:" . $row["Name"] .str_repeat('&nbsp;', 5) ." **Address:" . $row["Address"] . str_repeat('&nbsp;', 5) ." **Date:" . $row["Date"] . str_repeat('&nbsp;', 5) ." **Rate:" . $row["Rate"] .str_repeat('&nbsp;', 5)." **Organization_name:" . $row["Organization_name"] .str_repeat('&nbsp;', 5)." **State:" . $row["State"] .str_repeat('&nbsp;', 5)." **City:" . $row["City"].str_repeat('&nbsp;', 5)." **Phone:" . $row["Phone"].str_repeat('&nbsp;', 5)." **Email:" . $row["Email"].str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}

	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM customer WHERE Customer_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}	if (isset($_POST['delete'])) {

		if (isset($_POST['Customer_id']) && !empty($_POST['Customer_id'])) {
			deleter($_POST['Customer_id']);
		}		
	}

	$conn->close();
}

?>	