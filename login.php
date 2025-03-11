<?php
session_start();
include 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password_hash=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result === false) {
        echo "Error: " . $stmt->error;
        exit();
    }
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: organizers.html");
        exit();
    } else {
        echo "Invalid username or password.";
    }
    $stmt->close();
}
?>
