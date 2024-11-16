<?php

$id=$_POST['eid'];
$nm=$_POST['nam'];
$adres=$_POST['adrs'];
$gn=$_POST['gender'];
$slry=$_POST['sal'];
$pas=$_POST['pas'];
$conn = new mysqli('localhost:3307', 'root', '', 'meeting');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$qry="select * from employee where empid=".$id;
$rslt=$conn->query($qry);
if($rslt->num_rows!=0)
{
    echo "<script>alert(' Record already exists!!!');</script>";
    echo "<script>window.location.href = 'employees.php';</script>"; 

}
else{
    $qry1="insert into employee(empid,name,gender,address,salary,emppass) values(".$id.",'".$nm."','".$gn."','".$adres."',".$slry.",'".$pas."')";
    $rslt=$conn->query($qry1);
    echo"<script>alert('Record inserted!');</script>";
    echo "<script>window.location.href = 'employees.php';</script>"; 
}
?>