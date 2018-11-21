<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="../Css/styles.css">
	</head>
	<body>
		<form method="post" enctype="application/x-www-form-urlencoded" >

			<div class="input-c">
				<label for="Project_ID">Project_ID</label>
				<input id="text" type="text" name="Project_ID" />
			</div>

			<div class="input-c">
				<label for="Building_id">Building_id</label>
				<input id="password" type="text" name="Building_id" />
			</div>

			<div class="input-c">
				<label for="Section_id">Section_id</label>
				<input id="confirm_password" type="text" name="Section_id" />
			</div>

			<div class="input-c">
				<label for="Contract_id">Contract_id</label>
				<input id="username" type="text" name="Contract_id" />
			</div>

			<div class="input-c">
				<label for="Seq">Seq</label>
				<input id="username" type="text" name="Seq" />
			</div>

			<div class="input-c">
				<label for="emploee_id">emploee_id</label>
				<input id="username" type="text" name="emploee_id" />
			</div>

			<div class="input-c">
				<label for="price">price</label>
				<input id="username" type="text" name="price" />
			</div>

			<div class="input-c">
				<label for="Unit">Unit</label>
				<input id="username" type="text" name="Unit" />
			</div>

			<div class="input-c">
				<label for="Area">Area</label>
				<input id="username" type="text" name="Area" />
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
				'price' => 'price is required',
				'Unit' => 'Unit  is required',
				'Area' => 'Area is required',
	 			];
		}else{
			$requiredFields = [
				'Seq' => 'Seq is required',
			];
		}
		foreach($requiredFields as $key => $message) {
			if (!isset($_POST[$key]) || empty($_POST[$key])) {
				die($message);
			}
		}
	}

	require "connectDB.php";

	$Project_ID = $_POST['Project_ID'];
	$Building_id = $_POST['Building_id'];
	$Section_id = $_POST['Section_id'];
	$Contract_id = $_POST['Contract_id'];
	$Seq = $_POST['Seq'];
	$emploee_id = $_POST['emploee_id'];
	$price = $_POST['price'];
	$Unit = $_POST['Unit'];
	$Area = $_POST['Area'];
	$Remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])) {
		try {
			$query="INSERT INTO contract_finishing (Project_ID, Building_id, Section_id, Contract_id, Seq, emploee_id, price, Unit, Area, Remark) 
						VALUES ( '$Project_ID','$Building_id' , '$Section_id', '$Contract_id', '$Seq', '$emploee_id', '$price', '$Unit', '$Area' ,'$Remark')";
						
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
	       
	    $sql = "UPDATE contract_finishing SET $col='{$value}' WHERE Seq='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['price'])&& !empty($_POST['price'])) {
			updater(price,$_POST['price'],$_POST['Seq']);
		}
		if (isset($_POST['Unit']) && !empty($_POST['Unit'])) {
			updater(Unit,$_POST['Unit'],$_POST['Seq']);
		}
		if (isset($_POST['Area'])&& !empty($_POST['Area'])) {
			updater(Area,$_POST['Area'],$_POST['Seq']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Seq']);
		}		
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM contract_finishing";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Project_ID: " . $row["Project_ID"]. str_repeat('&nbsp;', 5)	." 	**Building_id: " . $row["Building_id"]. str_repeat('&nbsp;', 5) ." **Section_id: " . $row["Section_id"]. str_repeat('&nbsp;', 5)." **Contract_id:" . $row["Contract_id"] .str_repeat('&nbsp;', 5) ." **Seq:" . $row["Seq"] . str_repeat('&nbsp;', 5) ." **emploee_id:" . $row["emploee_id"] . str_repeat('&nbsp;', 5) ." **price:" . $row["price"] .str_repeat('&nbsp;', 5)." **Unit:" . $row["Unit"] .str_repeat('&nbsp;', 5)." **Area:" . $row["Area"] .str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}
	// for Delete -------------------------------------------------------------------------------------
	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM contract_finishing WHERE Seq= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}	if (isset($_POST['delete'])) {

		if (isset($_POST['Seq']) && !empty($_POST['Seq'])) {
			deleter($_POST['Seq']);
		}		
	}

	$conn->close();
}

?>