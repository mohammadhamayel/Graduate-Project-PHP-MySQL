<?php
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

$sql = "SELECT city_id, Employee_id, Name, Remark FROM city";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "City: " . $row["city_id"]. str_repeat('&nbsp;', 5)	." 	**Employee: " . $row["Employee_id"]. " 	**Name: " . $row["Name"]. " 	**Remark:" . $row["Remark"] . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>