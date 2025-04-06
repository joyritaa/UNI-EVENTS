<?php
include 'dbconnection.php';

$events = [];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM events_occ WHERE status = 'published'"; // Only show published events
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }
} else {
    die("Query failed: " . $conn->error);
}

echo json_encode($events);
?>

