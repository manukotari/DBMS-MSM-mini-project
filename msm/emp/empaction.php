<?php
$conn = new mysqli('localhost:3307', 'root', '', 'meeting');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture data from the form
$id = $_POST['id'];
$action = $_POST['action'];
$reason = isset($_POST['reason']) ? $_POST['reason'] : null;

// Prepare SQL query based on the action
if ($action === 'accept') {
    $sql = "UPDATE meetings SET status='accepted', rejection_reason=NULL WHERE meetingid='$id'";
} elseif ($action === 'reject') {
    $sql = "UPDATE meetings SET status='rejected', rejection_reason='$reason' WHERE meetingid='$id'";
}

// Execute the query and check for success
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Meeting status updated successfully');</script>";
    echo "<script>window.location.href = 'employee.php';</script>"; 


} else {
    echo "Error updating record: " . $conn->error;
}

// Redirect back to the employee page
echo "<script>window.location.href";
?>