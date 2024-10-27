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
echo "<link rel='stylesheet' href='project4.css'>";
include "navigation.html";
echo '<form method="POST" action="verifyPatient.php" id="verifyPatientForm">';
echo "<h1>House of Health: Verify Patient Form</h1>";
echo "<div>";
   echo '<span class="startText">Patient\'s First Name:  </span>';
   echo '<input type="text" id="vpFirst" name="vpFirst" placeholder="Example: John">';
   echo '<span class="endText">REQUIRED</span>';
echo "</div>";
echo "<div>";
   echo '<span class="startText">Patient\'s Last Name:   </span>';
   echo '<input type="text" id="vpLast" name="vpLast" placeholder="Example: Smith">';
   echo '<span class="endText">REQUIRED</span>';
echo "</div>";
echo "<div>";
   echo '<span class="startText">Patient\'s ID Number:  </span>';
   echo '<input type="text" id="vpID" name="vpID" placeholder="Example: 7">';
   echo '<span class="endText">REQUIRED</span>';
echo "</div>";
echo "<div>";
   echo '<button type="button" id="vp" name="vp" onclick="validatePatientConfirm()">Submit</button>';
echo "</div>";
echo '</form>';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $vpFirst = $_POST["vpFirst"];
   $vpLast = $_POST["vpLast"];
   $vpID = $_POST["vpID"];
   $query = "SELECT * FROM Patients WHERE `Patient First Name` = '$vpFirst' AND `Patient Last Name` = '$vpLast' AND `Patient ID` = '$vpID'";
   $queryRun = mysqli_query($con, $query);
   if (mysqli_num_rows($queryRun) > 0) {
      $_SESSION["vpFirst"] = $vpFirst;
      $_SESSION["vpLast"] = $vpLast;
      $_SESSION["vpID"] = $vpID;
      header("Location: appointment.php");
      die;
   } 
   else {
      $_SESSION["transaction"] = "create";
      echo '<script>alert("Patient cannot be found. You will be redirected. Create an account for the patient so a secondary check can occur.");
         window.location.href = "project4f2.php";</script>';
      die;
   }
}
mysqli_close($con);
?>
<script>
function validatePatient() {
   let patientFirst = document.getElementById("vpFirst");
   let patientLast = document.getElementById("vpLast");
   let patientID = document.getElementById("vpID");
   let patientFirstValid = /^[A-Za-z]+$/.test(patientFirst.value);
   let patientLastValid = /^[A-Za-z]+$/.test(patientLast.value);
   let patientIDValid = /^\d{1,4}$/.test(patientID.value);
   if (!patientFirst.value) {
      alert("Patient First Name is missing. Please enter.");
      patientFirst.focus();
   } 
   else if (patientFirst.value && !patientFirstValid) {
      alert("Invalid Patient First Name. Only alphabetic characters allowed.");
      patientFirst.focus();
   }
   else if (!patientLast.value) {
      alert("Patient Last Name is missing. Please enter.");
      patientLast.focus();
   } 
   else if (patientLast.value && !patientLastValid) {
      alert("Invalid Patient Last Name. Only alphabetic characters allowed.");
      patientLast.focus();
   }
   else if (!patientID.value) {
      alert("Missing Patient ID. Please enter.");
      patientID.focus();
   }
   else if (patientID.value && !patientIDValid) {
      alert("Invalid Patient ID. Please enter a number between the length of 1-4 digits.");
      patientID.focus();
   }
   else if (patientFirstValid && patientLastValid && patientIDValid) {
      document.getElementById("verifyPatientForm").submit();
   }
}
function validatePatientConfirm() {
   validatePatient();
}
</script>