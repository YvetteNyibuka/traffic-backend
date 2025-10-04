<?php
$servername = "localhost";
$username = "root";   // default for XAMPP
$password = "";       // default is empty
$dbname = "trafficdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$road = isset($_GET['road']) ? intval($_GET['road']) : 0;
$ir1  = isset($_GET['ir1']) ? intval($_GET['ir1']) : 1;
$ir2  = isset($_GET['ir2']) ? intval($_GET['ir2']) : 1;
$ir3  = isset($_GET['ir3']) ? intval($_GET['ir3']) : 1;

$sql = "INSERT INTO traffic_data (road, ir1, ir2, ir3) VALUES ($road, $ir1, $ir2, $ir3)";

if ($conn->query($sql) === TRUE) {
    echo "✅ Data saved successfully!";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>
