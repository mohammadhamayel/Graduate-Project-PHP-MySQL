<?php
/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "msql";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
*/


// Check connection
require "connectDB.php";// insure connection with database 

$sql = "SELECT * FROM city";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
    while($row = $result->fetch_assoc()) 
        echo "City: " . $row["city_id"]. str_repeat('&nbsp;', 5)	." 	**Employee: " . $row["Employee_id"]. " 	**Name: " . $row["Name"]. " 	**Remark:" . $row["Remark"] . "<br>";

    	//echo $row["Name"] . "<br>";
    
 else 
    echo "0 results";

$conn->close();
?>