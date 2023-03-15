<?php 
session_start();
$con = mysqli_connect('localhost','root','','queuing_system');
mysqli_select_db($con,"queuing_system");
if (isset($_POST["admin_login"])) {
    require('../../fpdf184_3/fpdf.php');
    
    
    if (isset($_POST["admin_login"])) {
        $sql="SELECT * FROM admin WHERE username = '".$_POST["username"]."' AND password = '".$_POST["password"]."';";
        $result = mysqli_query($con,$sql);  
        if(mysqli_num_rows( $result ) >= 1){
          $_SESSION["admin_id"] = $row["ID"];
          $_SESSION["admin_id"] = $row["ID"];
        header("Location: ../admin_home.php");
        }
        else{
          header("Location: ../login.php");
        }
    } 
   
  }
?>