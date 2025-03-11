<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$db = "episode_events";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error()."</br>");
}
echo "Connection successfully created</br>";
?>