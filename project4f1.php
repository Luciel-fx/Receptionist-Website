<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="view" content="width=device-width, initial-scale=1">
      <title>House of Health</title>
      <link rel="stylesheet" href="project4.css">
   </head>
   <body>
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $first = $_POST["firstName"];
   $last = $_POST["lastName"];
   $pass = $_POST["password"];
   $id = $_POST["idNum"];
   $phone = $_POST["phoNum"];
   $e = $_POST["email"];
   $eConfirm = $_POST["eConfirm"];
   $tran = $_POST["transaction"];
   $servername = "sql1.njit.edu";
   $username = "iz26";
   $password = "Brl&oJ+5r#giS$7ocrih";
   $dbname = "iz26";
   $con = mysqli_connect($servername, $username, $password, $dbname);
   if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
   $query = "SELECT `Receptionist First Name`, `Receptionist Last Name`,
      `Receptionist Password`, `Receptionist ID Number`, `Receptionist Email Address`
      FROM Receptionists
      WHERE `Receptionist First Name` = '$first' AND
         `Receptionist Last Name` = '$last' AND
         `Receptionist Password` = '$pass' AND
         `Receptionist ID Number` = '$id' AND
         `Receptionist Phone Number` = '$phone'";
   if ($eConfirm) {
      $query .= " AND `Receptionist Email Address` = '$e'";
   }
   $queryRun = mysqli_query($con, $query);
   if (mysqli_num_rows($queryRun) > 0) {
      $_SESSION["firstName"] = $first;
      $_SESSION["lastName"] = $last;
      $_SESSION["password"] = $pass;
      $_SESSION["idNum"] = $id;
      $_SESSION["phoNum"] = $phone;
      $_SESSION["email"] = $e;
      $_SESSION["eConfirm"] = $eConfirm;
      $_SESSION["transaction"] = $tran;
      header("Location: project4f2.php");
      die;
   } 
   else {
      echo '<script>alert("Receptionist data not found. Please re-enter and check inputted information is correct.")</script>';
   }
}
mysqli_close($con);
?>
      <form method="POST" action="project4f1.php" id="loginForm">
         <h1>House of Health</h1>
         <div>
            <span class="startText">Receptionist's First Name:</span>
            <input type="text" id="firstName" name="firstName" placeholder="Example: John"> 
            <span class="endText">REQUIRED</span>
         </div>
         <div>
            <span class="startText">Receptionist's Last Name: </span>
            <input type="text" id="lastName" name="lastName" placeholder="Example: Smith"> 
            <span class="endText">REQUIRED</span>
         </div>
         <div>
            <span class="startText">Receptionist's Password:   </span>
            <input type="password" id="password" name="password" placeholder="Example: $HoHDoc57"> 
            <span class="endText">REQUIRED</span>
         </div>
         <div>
            <span class="startText">Receptionist's ID #:            </span>
            <input type="number" id="idNum" name="idNum" placeholder="Example: 1234">
            <span class="endText">REQUIRED</span>
         </div>
         <div>
            <span class="startText">Receptionist's Phone #:      </span>
            <input type="text" id="phoNum" name="phoNum" placeholder="Example: 777-777-7777">
            <span class="endText">REQUIRED</span>
         </div>
         <div>
            <span class="startText">Receptionist's Email:         </span>
            <input type="text" id="email" name="email" placeholder="Example: johnsmith@hoh.com">
            <span id="eReq" class="endText">REQUIRED</span>
         </div>
         <div>
            <input type="checkbox" id="eConfirm" name="eConfirm">
            <span class="endText">Check the box to request an Email Confirmation</span>
         </div>
         <div>
            <span class="startText">Select a Transaction:</span>
            <select id="transaction" name="transaction">
               <option value="search">Search a Receptionist's Accounts</option>
               <option value="appSch">Schedule an Apointment</option>
               <option value="appCancel">Cancel an Appointment</option>
               <option value="procSch">Schedule a Procedure</option>
               <option value="procCancel">Cancel a Procedure</option>
               <option value="update">Update a Patient's Record</option>
               <option value="create">Create a New Patient Account</option>
            </select>
            <button type="submit" id="submitBtn" name="submitBtn">Submit</button>
            <button type="reset" id="resetBtn" name="resetBtn">Reset</button>
         </div>
      </form>
      <script src="project4.js"></script>
   </body>
</html>