<?php
session_start();
$servername = "sql1.njit.edu";
$username = "iz26";
$password = "Brl&oJ+5r#giS$7ocrih";
$dbname = "iz26";
$con = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$id = $_SESSION["idNum"];
echo "<link rel='stylesheet' href='project4.css'>";
include "navigation.html";
$query = "SELECT Receptionists.`Receptionist First Name`,
   Receptionists.`Receptionist Last Name`, 
   Receptionists.`Receptionist Password`, 
   Receptionists.`Receptionist ID Number`,
   Receptionists.`Receptionist Phone Number`,
   Receptionists.`Receptionist Email Address`,
   Patients.`Patient First Name`, 
   Patients.`Patient Last Name`, 
   Patients.`Patient ID`, 
   Records.`Patient DOB`, 
   Records.`Patient Age`,
   Records.`Patient Address & Phone Number`, 
   Records.`Shots`, 
   Records.`Illness`, 
   Appointments.`Appointment Date`, 
   Appointments.`Appointment Type`, 
   Procedures.`Procedure Date`, 
   Procedures.`Procedure Type`, 
   Doctors.`Doctor Name`,
   Doctors.`Doctor ID`
   FROM Patients
   JOIN Receptionists ON Patients.`Receptionist ID Number` = Receptionists.`Receptionist ID Number`
   JOIN Records ON Patients.`Patient ID` = Records.`Patient ID`
   JOIN Appointments ON Patients.`Patient ID` = Appointments.`Patient ID`
   JOIN Procedures ON Procedures.`Appointment ID` = Appointments.`Appointment ID`
   JOIN Doctors ON Doctors.`Doctor ID` = Appointments.`Doctor ID`
   WHERE Receptionists.`Receptionist ID Number` = '$id'";
$queryRun = mysqli_query($con, $query);
echo '<div class="container">';
echo "<h1>House of Health</h1>";
echo '</div>';
echo '<div class="container">';
echo "<table>";
echo "<tr>";
while ($next = mysqli_fetch_field($queryRun)) {
   echo "<th>" . $next->name . "</th>";
}
echo "</tr>";
while ($row = mysqli_fetch_assoc($queryRun)) {
   echo "<tr>";
   foreach ($row as $value) {
      echo "<td>" . $value . "</td>";
   }
   echo "</tr>";
}
echo "</table>";
echo '</div>';
mysqli_close($con);
?>