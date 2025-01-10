<?php

$servername = "localhost"; 
$username = "your_username"; 
$password = "your_password"; 
$dbname = "rating_system"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $_POST['name'];
$rating = $_POST['rating'];


if ($rating < 1 || $rating > 5) {
    die("Invalid rating value.");
}


$sql = "INSERT INTO ratings (name, rating) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $name, $rating);

if ($stmt->execute()) {
    echo "Értékelés sikeresen mentve!";
} else {
    echo "Hiba történt: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>