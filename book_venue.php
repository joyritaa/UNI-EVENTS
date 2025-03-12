<?php
include 'dbconnection.php'; // Connect to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $venue_id = $_POST['venue_id'];
    $event_id = $_POST['event_id'] ?? 'NULL'; // Event ID is optional
    $start_datetime = $_POST['start_datetime'];
    $end_datetime = $_POST['end_datetime'];

    // Insert booking into the database
    $sql = "INSERT INTO venue_bookings (venue_id, event_id, start_datetime, end_datetime, status) 
            VALUES ('$venue_id', $event_id, '$start_datetime', '$end_datetime', 'pending')";

    if ($conn->query($sql) === TRUE) {
        echo "Venue booked successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
