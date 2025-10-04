<?php
// PostgreSQL connection settings from Render
$host = getenv('DB_HOST');       // e.g., your-db-host.render.com
$port = getenv('DB_PORT') ?: '5432';
$dbname = getenv('DB_NAME') ?: 'trafficdb';
$user = getenv('DB_USER');       // Render username
$password = getenv('DB_PASSWORD'); // Render password

// Create connection string
$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);

// Check connection
if (!$conn) {
    die("❌ Connection failed: " . pg_last_error());
}

// Get input parameters safely
$road = isset($_GET['road']) ? intval($_GET['road']) : 0;
$ir1  = isset($_GET['ir1']) ? intval($_GET['ir1']) : 1;
$ir2  = isset($_GET['ir2']) ? intval($_GET['ir2']) : 1;
$ir3  = isset($_GET['ir3']) ? intval($_GET['ir3']) : 1;

// Use prepared statement to prevent SQL injection
$result = pg_query_params(
    $conn,
    "INSERT INTO traffic_data (road, ir1, ir2, ir3) VALUES ($1, $2, $3, $4)",
    array($road, $ir1, $ir2, $ir3)
);

if ($result) {
    echo "✅ Data saved successfully!";
} else {
    echo "❌ Error: " . pg_last_error($conn);
}

// Close connection
pg_close($conn);
?>
