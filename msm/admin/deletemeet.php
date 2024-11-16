<?php

$conn = new mysqli('localhost:3307', 'root', '', 'meeting');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id = $_POST['id'];


$sql = "DELETE FROM meetings WHERE meetingid='$id'";


if ($conn->query($sql) === TRUE) {
    
    header('Location: index.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
