<?php
 include("../../utils/db.php");
 
if(isset($_GET["office_id"])){
    $sql = "DELETE FROM offices WHERE ID = '".$_GET["office_id"]."'";
    if ($con->query($sql) === TRUE) {

   } 
      
   
   
   echo "<script>alert('Record deleted successfully!');history.back();</script>";
}

?>