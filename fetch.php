<?php
// PostgreSQL connection settings from Render
$host = getenv('DB_HOST');       // internal hostname for Render service
$port = getenv('DB_PORT') ?: '5432';
$dbname = getenv('DB_NAME');     // e.g., trafficdb_lo3u
$user = getenv('DB_USER');       // Render Postgres username
$password = getenv('DB_PASSWORD'); // Render Postgres password

// Create connection string
$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);

if (!$conn) {
    die(json_encode(["error" => "Connection failed: " . pg_last_error()]));
}

// Fetch the latest row
$result = pg_query($conn, "SELECT * FROM traffic_data ORDER BY id DESC LIMIT 1");

if (!$result) {
    die(json_encode(["error" => pg_last_error($conn)]));
}

$data = pg_fetch_assoc($result);

// Return JSON
header('Content-Type: application/json');
echo json_encode($data);

// Close connection
pg_close($conn);
?>
