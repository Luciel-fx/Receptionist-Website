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
$tran = $_SESSION["transaction"];
echo "<link rel='stylesheet' href='project4.css'>";
switch ($tran) {
   case "search":
      header("Location: search.php");
      break;
   case "appSch":
      header("Location: verifyPatient.php");
      break;
   case "appCancel":
      header("Location: appCancel.php");
      break;
   case "procSch":
      header("Location: procedure.php");
      break;
   case "procCancel":
      header("Location: procCancel.php");
      break;
   case "update":
      header("Location: update.php");
      break;
   case "create":
      header("Location: create.php");
      break;
}
mysqli_close($con);
?>