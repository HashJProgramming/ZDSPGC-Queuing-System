<?php session_abort();
$_SESSION["name"]=null;
include '../utils/db.php';
$officeID = $_GET["officeID"];
$sql = "UPDATE offices SET availability = 'unavailable' WHERE ID = '".$officeID."';";
      if ($con->query($sql) === TRUE) {
        } 
header("location:../index.php");
?>