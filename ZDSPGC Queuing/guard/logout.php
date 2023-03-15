<?php session_abort();
$_SESSION["name"]=null;
header("location:../index.php");
?>