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
echo '<form method="POST" action="update.php" id="updForm">';
echo "<h1>House of Health: Update Patient Record Form</h1>";
echo "<div>";
   echo '<span class="startText">Shots:                     </span>';
   echo '<input type="text" id="shots" name="shots" placeholder="Example: Covid">';
   echo '<span class="endText">REQUIRED</span>';
echo "</div>";
echo "<div>";
   echo '<span class="startText">Illness:                   </span>';
   echo '<input type="text" id="ill" name="ill" placeholder="Example: Stomachache">';
   echo '<span class="endText">REQUIRED</span>';
echo "</div>";
echo "<div>";
   echo '<span class="startText">Patient ID:            </span>';
   echo '<input type="text" id="pID" name="pID" placeholder="Example: 11">';
   echo '<span class="endText">REQUIRED</span>';
echo "</div>";
echo "<div>";
   echo '<button type="button" id="upd" name="upd">Submit</button>';
echo "</div>";
echo "</form>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $shots = $_POST["shots"];
   $ill = $_POST["ill"];
   $pID = $_POST["pID"];
   $query = "SELECT * FROM Records WHERE `Patient ID` = '$pID'";
   $queryRun = mysqli_query($con, $query);
   if (mysqli_num_rows($queryRun) > 0) {
      if (!empty($shots).trim() && !empty($ill).trim()) {
         $query = "UPDATE Records SET `Shots` = '$shots', `Illness` = '$ill' WHERE `Patient ID` = '$pID'";
         $queryRun = mysqli_query($con, $query);
         echo '<script>alert("Shots and Illness updated.")</script>';
      }
      else if (!empty($shots).trim() && empty($ill).trim()) {
         $query = "UPDATE Records SET `Shots` = '$shots' WHERE `Patient ID` = '$pID'";
         $queryRun = mysqli_query($con, $query);
         echo '<script>alert("Shots updated.")</script>';
      }
      else if (empty($shots).trim() && !empty($ill).trim()) {
         $query = "UPDATE Records SET `Illness` = '$ill' WHERE `Patient ID` = '$pID'";
         $queryRun = mysqli_query($con, $query);
         echo '<script>alert("Illness updated.")</script>';
      }
   }
   else {
      echo '<script>alert("The data entered for Patient ID is incorrect. Please check your data.")</script>';
   }
}
mysqli_close($con);
?>
<script>
document.getElementById("upd").addEventListener("click", updConfirm);
function validateUpdate() {
   let shots = document.getElementById("shots");
   let ill = document.getElementById("ill");
   let pID = document.getElementById("pID");
   let shotsValid = /^[A-Za-z]+(?: [A-Za-z]+)*$/.test(shots.value);
   let illnessValid = /^[A-Za-z]+(?: [A-Za-z]+)*$/.test(ill.value); 
   let patientIDValid = /^\d{1,4}$/.test(pID.value);
   if (!shots.value && !ill.value) {
      alert("No Shots or Illness information. Please enter at least one of them.");
      return false;
   }
   else if (shots.value && !shotsValid) {
      alert("Invalid Shots information. Only alphabetic characters and spaces allowed.");
      shots.focus();
      return false;
   } 
   else if (ill.value && !illnessValid) {
      alert("Invalid Illness information. Only alphabetic characters and spaces allowed.");
      ill.focus();
      return false;
   } 
   else if (!pID.value) {
      alert("Patient ID is missing. Please enter");
      pID.focus();
      return false;
   } 
   else if (pID.value && !patientIDValid) {
      alert("Invalid Patient ID. Please enter a number between the length of 1-4 digits.");
      pID.focus();
      return false;
   }
   return true;
}
function updConfirm(event) {
   if (!validateUpdate()) {
      event.preventDefault();
      return;
   }
   let confirmed = confirm("You are about to UPDATE the shots and illness for the patient. Are you sure you want to do so?");
   if (confirmed) {
      document.getElementById("updForm").submit();
   }
}
</script>