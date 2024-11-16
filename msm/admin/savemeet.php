<?php

$conn = new mysqli('localhost:3307', 'root', '', 'meeting');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$mid=$_POST['mid'];
$eid=$_POST['eid'];
$title = $_POST['meetingBook'];
$description = $_POST['meetingdesc'];
$date = $_POST['meetingDate'];
$time = $_POST['meetingTime'];

$qry="select * from meetings where meetingid=".$mid;
$rslt=$conn->query($qry);
if($rslt->num_rows!=0)
{
    echo "<script>alert(' Record already exists!!!');</script>";
    echo "<script>window.location.href = 'index.php';</script>"; 

}
else{
$sql = "INSERT INTO meetings(meetingid,empid,title, description, meetingdate, meetingtime) VALUES ('$mid','$eid','$title', '$description', '$date', '$time')";
$rslt = $conn->query($sql);

    echo "<script>alert('Record inserted!');</script>";
    echo "<script>window.location.href = 'index.php';</script>";

}
$conn->close();
?>
