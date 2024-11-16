<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>Employee Registration Form</title>

    <!--- CSS File--->
    <link rel="stylesheet" href="./emloyees.css" />
  </head>
  
  <body>
    <!--  -->
    <section class="container">
      <header>Employee Registration Form
      <a href="./index.php" style="margin-left: 150px;">
          <img src="../Images/close.png" alt="" style="width:20px;">
      </a>
      </header>
      <form action="./employeesave.php" class="form" method="post">
<!--  -->
<?php
@$cn=new mysqli('localhost:3307','root','','meeting');
$role="staff";
if($cn->connect_error)
{
echo "Could not connect";
exit;
}

?>   
<!--  -->
        <div class="input-box">
          <label>Employee ID</label>
          <input type="text" placeholder="Enter Employee ID"  name="eid" required autofocus />
        </div>

        <div class="input-box">
          <label>Name</label>
          <input type="text" placeholder="Enter full name" id="nameInput" required name="nam" />
        </div>


        <div class="input-box">
          <label>Address</label>
          <input type="text" placeholder="Enter Employee address" id="email" required name="adrs"/>
        </div>
        <!--  -->
       
        <!--  -->
        <div class="column">
          <div class="input-box">
            <label>Gender</label>
            <input type="text" placeholder="Enter Employee Gender" required name="gender"/>
          </div>
          <div class="input-box">
            <label>Salary</label>
            <input type="number" placeholder="Enter Employee Salary" id="dobInput" required name="sal"/>
          </div>
        </div>
        <di class="column">
        <div class="input-box">
          <label>Employee Password</label>
          <input type="text" placeholder="Enter Employee password" id="pass" required name="pas"/>
        </div>
        </di>
        <button>Add Employee</button>
      </form>
    </section>
 

  </body>
</html>