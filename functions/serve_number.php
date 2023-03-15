<?php  
include("../utils/db.php");
if (isset($_GET['office_id']) && isset($_GET['number']) && isset($_GET["served"])) {
    if ($_GET["served"] == "true") {
      $current_number = $_GET['number'];
 $sql = "UPDATE queue SET status = 'Served' WHERE office = ".$_GET['office_id']." AND number = ".$_GET['number'].";";
 
 if ($con->query($sql) === TRUE) {
   echo "<script>alert('Number served successfully!');history.back();</script>";
   } 
    }else{
      $current_number = $_GET['number'];
      if($current_number == "None"){

      }
      else{

        $sql = "UPDATE queue SET status = 'Served' WHERE office = ".$_GET['office_id']." AND number = ".$_GET['number'].";";
        
        if ($con->query($sql) === TRUE) {
          header("location: ../staff_home.php");
        } 
      }
    }
    
}
?>