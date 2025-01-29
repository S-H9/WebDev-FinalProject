<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ticketbooth";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM movies WHERE Movie_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();

header('Content-Type: application/json');
echo json_encode($movie);

$conn->close();
?>