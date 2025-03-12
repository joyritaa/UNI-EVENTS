<?php
include 'dbconnection.php';

$sql = "SELECT * FROM events_occ WHERE status = 'published'"; // Only show published events
$result = $conn->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

echo json_encode($events);
?>

