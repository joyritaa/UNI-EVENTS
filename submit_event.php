<?php
include 'dbconnection.php'; // Connect to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $event_desc = $_POST['event_desc'];
    $event_type = $_POST['event_type'];
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $venue_id = $_POST['venue_id'];
    $organizer_id = $_POST['organizer_id']; // This should come from the logged-in user
    $price = $_POST['price'];
    $capacity = $_POST['capacity'];

    // Insert the event into the database
    $sql = "INSERT INTO events_occ (title, event_desc, event_type, event_date, start_time, end_time, venue_id, organizer_id, price, capacity, status) 
            VALUES ('$title', '$event_desc', '$event_type', '$event_date', '$start_time', '$end_time', '$venue_id', '$organizer_id', '$price', '$capacity', 'draft')";

    if ($conn->query($sql) === TRUE) {
        echo "Event submitted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

