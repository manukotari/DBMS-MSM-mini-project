<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meetings Tracker</title>
    <link rel="stylesheet" href="./index.css">
    <style>
        .top-cont{
            margin-top: 10vh;
            border: 1px solid red;
        }   


        .left-container {
            width: 40%;
            height:65vh;
        }
        /* Modal Styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            padding-top: 100px; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .logo img{
            height: 7vh;
            width: 10vw;
        }

        /*  */
        #ubtn{
            background-color: aquamarine;
            color: white;
            font-size: 1.3rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href=""><img src="../img/logoo.png" alt="Logo" id="logo"></a> 
            </div>
            <ul class="nav-items">
                <li><a href="#">Home</a></li>
                <li><a href="./employees.php">Employees</a></li>
                <li><a href="./meetings.php">Meetings</a></li>
                <li><a href="#">Service</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="../login/login.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="main-container">
        <div class="left-container">
            <h1>Meeting Management</h1>
            <form id="meetingForm" action="savemeet.php" method="POST">
                <input type="text" name="mid" id="editId" autofocus placeholder="Meeting ID Start with 1101 series!" >
                <input type="text" name="eid" id="editId1"  placeholder="Employee ID!! before entering employee id make sure that employee should be there" >
                <input type="text" name="meetingBook" placeholder="Meeting Title" required>
                <input type="text" name="meetingdesc" placeholder="Meeting Description" required>
                <input type="date" name="meetingDate" required>
                <input type="text" name="meetingTime" placeholder="Time (e.g., 6:00 PM)" required>
                <button type="submit" id="subbtn">Add Meeting</button>
            </form>
        </div>

        <div class="right-container">
            <h2>Meetings Overview</h2>

            <table id="meetingsTable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="meetingsBody">
                    <?php
                    $conn = new mysqli('localhost:3307', 'root', '', 'meeting');

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM meetings ORDER BY meetingdate";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['title']}</td>
                                    <td>{$row['description']}</td>
                                    <td>{$row['meetingdate']}</td>
                                    <td>{$row['meetingtime']}</td>
                                    <td>
                                        <button class='editBtn' data-id='{$row['meetingid']}' data-title='{$row['title']}' data-description='{$row['description']}' data-date='{$row['meetingdate']}' data-time='{$row['meetingtime']}'>Edit</button>
                                       
                                         <form action='deletemeet.php' method='POST' style='display:inline;'>
            <input type='hidden' name='id' value='{$row['meetingid']}'>
            <button type='button' class='deleteBtn'>Delete</button>
        </form>


                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No meetings found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Editing Meeting -->
    <div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Meeting</h2>
        <form id="editMeetingForm" action="updatemeet.php" method="POST">
            <input type="text" name="id" id="editId" placeholder="Employee ID for reference!">
            <input type="text" name="meetingBook" id="editTitle" placeholder="Meeting Title" required>
            <input type="text" name="meetingdesc" id="editDescription" placeholder="Meeting Description" required>
            <input type="date" name="meetingDate" id="editDate" required>
            <input type="text" name="meetingTime" id="editTime" placeholder="Time (e.g., 6:00 PM)" required>
            <button type="submit" id="ubtn">Update Meeting</button>
        </form>
    </div>
</div>


    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Meetings Tracker. All Rights Reserved.</p>
            <ul class="footer-links">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Help</a></li>
            </ul>
            <p class="designer-credit">Designed by Manu Kotari</p>
        </div>
    </footer>

    <script>
        // Get the modal
var modal = document.getElementById("editModal");

// Get the close button
var closeModal = document.getElementsByClassName("close")[0];

// Get all the edit buttons
var editButtons = document.querySelectorAll('.editBtn');

// Loop through the edit buttons to add click event
editButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        // Open the modal
        modal.style.display = "block";

        // Get data from the button
        var id = this.getAttribute("data-id");
        var title = this.getAttribute("data-title");
        var description = this.getAttribute("data-description");
        var date = this.getAttribute("data-date");
        var time = this.getAttribute("data-time");

        // Pre-fill the form with the meeting data
        document.getElementById('editId').value = id;
        document.getElementById('editTitle').value = title;
        document.getElementById('editDescription').value = description;
        document.getElementById('editDate').value = date;
        document.getElementById('editTime').value = time;
    });
});

// Close the modal when clicking the close button
closeModal.onclick = function() {
    modal.style.display = "none";
}

// Close the modal when clicking outside it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


                // make sure before u delete
                var deleteButtons = document.querySelectorAll('.deleteBtn');

// Add click event listener to each delete button
deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        // Ask for confirmation
        var confirmed = confirm("Are you sure you want to delete this record?");
        
        // If user confirms, submit the form
        if (confirmed) {
            this.closest('form').submit(); // Submitting the form to delete the meeting
        }
    });
});
    </script>
</body>
</html>
