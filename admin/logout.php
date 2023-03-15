<?php session_abort();
$_SESSION["admin_id"]=null;
$_SESSION["admin_name"]=null;
header("location:./login.php");
?>