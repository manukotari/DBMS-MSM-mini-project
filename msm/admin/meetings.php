<?php
session_start();

@$connection = new mysqli('localhost:3307', 'root', '', 'meeting');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en" title="Coding design">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Meetings</title>
    <link rel="stylesheet" href="meeting.css">
</head>

<body>
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Employee Meetings</h1>

            <div class="input-group">
                <input type="search" placeholder="Search Data...">
                <img src="../Images/search.png" alt="">
            </div>
            
            <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File"></label>
                <input type="checkbox" id="export-file">
                <div class="export__file-options">
                    <label>Export As &nbsp; &#10140;</label>
                    <label for="export-file" id="toPDF">PDF <img src="../Images/pdf.png" alt=""></label>
                    <label for="export-file" id="toJSON">JSON <img src="../Images/json.png" alt=""></label>
                    <label for="export-file" id="toCSV">CSV <img src="../Images/csv.png" alt=""></label>
                    <label for="export-file" id="toEXCEL">EXCEL <img src="../Images/excel.png" alt=""></label>
                </div>
            </div>
           
        </section>
        <section class="table__body">
            
            <table>
                <thead>
                    <tr>
                        <th> E_ID <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Name <span class="icon-arrow">&UpArrow;</span></th>
                        <th> ADDRESS<span class="icon-arrow">&UpArrow;</span></th>
                        <th> GENDER <span class="icon-arrow">&UpArrow;</span></th>
                        <th> MEETING TITLE<span class="icon-arrow">&UpArrow;</span></th>
                        <th> STATUS <span class="icon-arrow">&UpArrow;</span></th>
                        <th> REASON <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Join the tables using INNER JOIN
                $query = "SELECT employee.empid, employee.name, employee.gender, employee.address, 
                                 meetings.title, meetings.status, meetings.rejection_reason 
                          FROM employee 
                          JOIN meetings ON employee.empid = meetings.empid";
                $result = mysqli_query($connection, $query);

                // Fetch and display the rows
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>
                            <td>" . $row['empid'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['address'] . "</td>
                            <td>" . $row['gender'] . "</td>
                            <td>" . $row['title'] . "</td>
                            <td>" . (!empty($row['status']) ? $row['status'] : 'Pending') . "</td>
                            <td>" . (!empty($row['rejection_reason']) ? $row['rejection_reason'] : '-----') . "</td>
                          </tr>";
                }
                ?>
                </tbody>
            </table>
            
        </section>
    </main>
</body>
<script src="meeting.js"></script>
</html>
