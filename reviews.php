<?php
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event_id'];
    $user_id = $_POST['user_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Check if user already submitted a review for this event
    $checkSql = "SELECT * FROM reviews WHERE event_id = '$event_id' AND user_id = '$user_id'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        echo "You have already submitted a review for this event.";
    } else {
        $sql = "INSERT INTO reviews (event_id, user_id, rating, comment) 
                VALUES ('$event_id', '$user_id', '$rating', '$comment')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Review submitted successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Fetch reviews for a specific event
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $sql = "SELECT r.*, u.username FROM reviews r JOIN users u ON r.user_id = u.user_id WHERE r.event_id = '$event_id' ORDER BY r.created_at DESC";
    
    $result = $conn->query($sql);
    $reviews = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
    }
    echo json_encode($reviews);
}
?>
