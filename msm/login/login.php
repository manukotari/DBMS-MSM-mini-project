<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Meetings Tracker</title>
    <link rel="stylesheet" href="login.css">
    <style>
        body {
            background: linear-gradient(to bottom right, #abb3ff, #ffb3ab);
        }
        #loginBtn{
            background:linear-gradient(to left,#a437fe,#40adfc);
            border-radius: 12px;
        }
        .login-container {
            border-radius: 12px;
            background: linear-gradient(to bottom right, #abb3fe, #ffb3ae);
        }
        
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form id="loginForm" method="post" action="login.php">
            <input type="text" name="username1" placeholder="Username" autofocus required>
            <input type="password"  name="password1" placeholder="Password" required>
            <button type="submit" id="loginBtn">Login</button>
        </form>
        <p class="footer-text">Don't have an account? <a href="#">Sign up</a></p>
    </div>

    <!-- <script src="login.js"></script> -->
</body>
</html>

<?php
session_start();

$conn=new mysqli("localhost:3307","root","",database: "meeting");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $_POST['username1'];
    $pass = $_POST['password1'];

    $sql = "SELECT * FROM login WHERE user = '$user' AND pass = '$pass'";
    $sql1 = "SELECT * FROM employee WHERE empid = '$user' AND emppass = '$pass'";

    
    $result = $conn->query($sql);
    $res=$conn->query($sql1);

    
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $user;
        echo "Login successful! Welcome, " . $user;
        header("Location: ../admin/index.php");
    } else if($res->num_rows>0) {
        $_SESSION['username'] = $user;
        echo "Login successful! Welcome, " . $user;
        header("Location: ../emp/employee.php");
    }else{
        
        echo "<script>alert('Invalid username or password.');</script>";
    }
}

$conn->close();
?>
