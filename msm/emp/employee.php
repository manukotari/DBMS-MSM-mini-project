<?php
$conn = new mysqli('localhost:3307', 'root', '', 'meeting');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM meetings ORDER BY meetingdate";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Meeting Approval</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../admin/index.css">
</head>
<body>
<header>
        <nav>
            <div class="logo">
                <a href=""><img src="../img/logoo.png" alt="Logo" id="logo"></a> 
            </div>
            <ul class="nav-items">
                <li><a href="#">Home</a></li>
                <li><a href="#">Service</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="../login/login.php">Logout</a></li>
            </ul>
        </nav>
    </header>
<h1>Employee Meeting Approval</h1>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $status = $row['status'];
                echo "<tr>
                        <td>{$row['title']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['meetingdate']}</td>
                        <td>{$row['meetingtime']}</td>
                        <td>{$status}</td>
                        <td>";
                
                // Dissapear buttons based on status
                if ($status === 'accepted' || $status === 'rejected') {
                    echo "<button disabled>Accept</button>";
                    echo "<button disabled>Reject</button>";
                } else {
                    echo "<form action='empaction.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='id' value='{$row['meetingid']}'>
                            <input type='hidden' name='action' value='accept'>
                            <button type='submit'>Accept</button>
                          </form>
                          <form action='empaction.php' method='POST' style='display:inline;' onsubmit='return getReason(this);'>
                            <input type='hidden' name='id' value='{$row['meetingid']}'>
                            <input type='hidden' name='action' value='reject'>
                            <button type='submit'>Reject</button>
                          </form>";
                }

                echo "</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No meetings found</td></tr>";
        }
        $conn->close();
        ?>
    </tbody>
</table>

<script>
function getReason(form) {
    let reason = prompt('Please provide a reason for rejection:');
    if (!reason) {
        alert('Rejection reason is required.');
        return false;
    }
    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'reason';
    input.value = reason;
    form.appendChild(input);
    return true;
}
</script>

</body>
</html>
