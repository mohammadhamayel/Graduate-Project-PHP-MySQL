<html>
<head>
	<title>section_type</title>
	<link rel="stylesheet" href="../Css/styles.css">

</head>
<body>
	<form method="post" enctype="application/x-www-form-urlencoded">

		<div class="input-c">
			<label for="Type_id">Type_id </label>
			<input id="text" type="text" name="Type_id" />
		</div>

		<div class="input-c">
			<label for="Emploee_id">Emploee_id</label>
			<input id="password" type="text" name="Emploee_id" />
		</div>

		<div class="input-c">
			<label for="TypeDetail"> TypeDetail</label>
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
    if (isset($_POST['insert']) || isset($_POST['edit'])) {
    	 if (isset($_POST['insert'])){
	    	$requiredFields = [
			'TypeDetail' => 'TypeDetail is required',
			];
		}else{
			$requiredFields = [
			'Type_id' => 'Type_id is required',
			];
		}

		foreach($requiredFields as $key => $message) {
			if (!isset($_POST[$key]) || empty($_POST[$key])) {
				die($message);
			}
		}
    }

    require "connectDB.php";

    $Type_id = $_POST['Type_id'];
	$Emploee_id = $_POST['Emploee_id'];
	$TypeDetail = $_POST['TypeDetail'];
	$Remark = $_POST['Remark'];

	// for insert -------------------------------------------------------------------------------------
	if (isset($_POST['insert'])) {

		try {
			$query="INSERT INTO section_type (Emploee_id, TypeDetail, Remark) VALUES ( '$Emploee_id', '$TypeDetail' , '$Remark')";
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
	       
	    $sql = "UPDATE section_type SET $col='{$value}' WHERE Type_id='{$id}'";
	    if ($conn->query($sql) === TRUE) {
	        echo "Record updated successfully";
	    } else {
	        echo "Error updating record: " . $conn->error;
	    }
	}

	if (isset($_POST['edit'])) {

		if (isset($_POST['TypeDetail']) && !empty($_POST['TypeDetail'])) {
			updater(TypeDetail,$_POST['TypeDetail'],$_POST['Type_id']);
		}
		if (isset($_POST['Remark'])&& !empty($_POST['Remark'])) {
			updater(Remark,$_POST['Remark'],$_POST['Type_id']);
		}
	}
	// for Search =----------------------------------------------------------------------------------------
	if (isset($_POST['search'])) {
		require "connectDB.php";// insure connection with database 

		$sql = "SELECT * FROM section_type";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		    while($row = $result->fetch_assoc()) 
		        echo "Type_id: " . $row["Type_id"]. str_repeat('&nbsp;', 5)	." 	**Emploee_id: " . $row["Emploee_id"]. str_repeat('&nbsp;', 5) ." **TypeDetail: " . $row["TypeDetail"]. str_repeat('&nbsp;', 5)." **Remark:" . $row["Remark"] . "<br>";

		    	//echo $row["Name"] . "<br>";
		    
		 else 
		    echo "0 results";
	}
	// for Delete -------------------------------------------------------------------------------------

	function deleter($id){
			//database configration
		require "connectDB.php";
	       
	    $sql = "DELETE FROM section_type WHERE Type_id= $id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $conn->error;
		}
	}

	if (isset($_POST['delete'])) {

		if (isset($_POST['Type_id']) && !empty($_POST['Type_id'])) {
			deleter($_POST['Type_id']);
		}
		
	}


	$conn->close();
}

?>	