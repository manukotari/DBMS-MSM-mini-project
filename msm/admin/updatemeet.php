<?php
$conn = new mysqli('localhost:3307', 'root', '', 'meeting');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture POST data
$id = $_POST['id'];
$title = $_POST['meetingBook'];
$description = $_POST['meetingdesc'];
$date = $_POST['meetingDate'];
$time = $_POST['meetingTime'];

// Print captured data for verification
echo "ID: " . htmlspecialchars($id) . "<br>";
echo "Title: " . htmlspecialchars($title) . "<br>";
echo "Description: " . htmlspecialchars($description) . "<br>";
echo "Date: " . htmlspecialchars($date) . "<br>";
echo "Time: " . htmlspecialchars($time) . "<br>";


// Perform the update query
$sql = "UPDATE meetings SET title='$title', description='$description', meetingdate='$date', meetingtime='$time' WHERE empid='$id'";
$rslt = $conn->query($sql);

if ($rslt === TRUE) {
    echo "<script>alert('Meeting updated successfully');</script>";
    echo "<script>window.location.href = 'index.php';</script>"; 
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
