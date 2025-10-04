<?php
$host = getenv('DB_HOST');
$port = getenv('DB_PORT') ?: '5432';
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');

$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);

if (!$conn) {
    die(json_encode(["error" => "Connection failed: " . pg_last_error()]));
}

$result = pg_query($conn, "SELECT * FROM traffic_data ORDER BY id DESC");

if (!$result) {
    die(json_encode(["error" => pg_last_error($conn)]));
}

$data = [];
while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);

pg_close($conn);
?>
