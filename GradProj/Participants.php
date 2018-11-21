<html>
	<head>
		<title>Participants</title>
		<link rel="stylesheet" href="../Css/styles.css">
	</head>
	<body>
		<form method="post" enctype="application/x-www-form-urlencoded" action="Participants.php">

			<div class="input-c">
				<label for="Project_id">Project_id</label>
				<input id="text" type="text" name="Project_id" />
			</div>

			<div class="input-c">
				<label for="Stages_id">Stages_id</label>
				<input id="password" type="text" name="Stages_id" />
			</div>

			<div class="input-c">
				<label for="levels_id">levels_id</label>
				<input id="confirm_password" type="text" name="levels_id" />
			</div>

			<div class="input-c">
				<label for="Participants_id">Participants_id</label>
				<input id="username" type="text" name="Participants_id" />
			</div>

			<div class="input-c">
				<label for="Emploee_id">Emploee_id</label>
				<input id="username" type="text" name="Emploee_id" />
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
				<label for="Price">Price</label>
				<input id="username" type="text" name="Price" />
			</div>

			<div class="input-c">
				<label for="Paid">Paid</label>
				<input id="username" type="text" name="Paid" />
			</div>

			<div class="input-c">
				<label for="Un_paid">Un_paid</label>
				<input id="username" type="text" name="Un_paid" />
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
				'Start_date' => 'Start_date is required',
				'End_date' => 'End_date  is required',
				'Price' => 'Price  is required',
				'Paid' => 'Paid is required',
				'Un_paid' => 'Un_paid is required'
			];
		}else{
			$requiredFields = [
				'Participants_id' => 'Participants_id is required',
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

	$Project_id = $_POST['Project_id'];
	$Stages_id = $_POST['Stages_id'];
	$levels_id = $_POST['levels_id'];
	$Participants_id = $_POST['Participants_id'];
	$Emploee_id = $_POST['Emploee_id'];
	$Start_date = $_POST['Start_date'];
	$End_date = $_POST['End_date'];
	$Price = $_POST['Price'];
	$Paid = $_POST['Paid'];
	$Un_paid = $_POST['Un_paid'];
	$Remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])){
		try {
			$query="INSERT INTO participants (Project_id, Stages_id, levels_id, Participants_id, Emploee_id, Start_date, End_date, Price, Paid, Un_paid, Remark) 
						VALUES ( '$Project_id','$Stages_id' , '$levels_id', '$Participants_id', '$Emploee_id', '$Start_date', '$End_date', '$Price', '$Paid' ,'$Un_paid', '$Remark')";
						
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
	       
	    $sql = "UPDATE participants SET $col='{$value}' WHERE Participants_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['Start_date'])&& !empty($_POST['Start_date'])) {
			updater(Start_date,$_POST['Start_date'],$_POST['Participants_id']);
		}
		if (isset($_POST['End_date']) && !empty($_POST['End_date'])) {
			updater(End_date,$_POST['End_date'],$_POST['Participants_id']);
		}
		if (isset($_POST['Price'])&& !empty($_POST['Price'])) {
			updater(Price,$_POST['Price'],$_POST['Participants_id']);
		}
		if (isset($_POST['Paid'])&& !empty($_POST['Paid'])) {
			updater(Paid,$_POST['Paid'],$_POST['Participants_id']);
		}
		if (isset($_POST['Un_paid']) && !empty($_POST['Un_paid'])) {
			updater(Un_paid,$_POST['Un_paid'],$_POST['Participants_id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Participants_id']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM participants";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Project_id: " . $row["Project_id"]. str_repeat('&nbsp;', 5)	." 	**Stages_id: " . $row["Stages_id"]. str_repeat('&nbsp;', 5) ." **levels_id: " . $row["levels_id"]. str_repeat('&nbsp;', 5)." **Participants_id:" . $row["Participants_id"] .str_repeat('&nbsp;', 5) ." **Emploee_id:" . $row["Emploee_id"] . str_repeat('&nbsp;', 5) ." **Start_date:" . $row["Start_date"] . str_repeat('&nbsp;', 5) ." **End_date:" . $row["End_date"] .str_repeat('&nbsp;', 5)." **Price:" . $row["Price"] .str_repeat('&nbsp;', 5)." **Paid:" . $row["Paid"] .str_repeat('&nbsp;', 5)." **Un_paid:" . $row["Un_paid"].str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}
	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM participants WHERE Participants_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}	if (isset($_POST['delete'])) {

		if (isset($_POST['Participants_id']) && !empty($_POST['Participants_id'])) {
			deleter($_POST['Participants_id']);
		}		
	}

	$conn->close();
}

?>	