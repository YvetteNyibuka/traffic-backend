<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trafficdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM traffic_data ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
}

header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
