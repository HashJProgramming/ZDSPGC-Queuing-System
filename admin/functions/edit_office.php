<?php
 include("../../utils/db.php");
 
if (isset($_POST["save_offices"])) {
     $sql = "UPDATE offices SET availability = 'unavailable'";
     if ($con->query($sql) === TRUE) {
    } 
    foreach($_POST as $stuff){
        if ($stuff == "Save") {
            
        }
        else{
            $sql = "UPDATE offices SET availability = 'available' WHERE ID = ".$stuff."";
            if ($con->query($sql) === TRUE) {
            } 
        }
    }
    
    echo "<script>alert('Record updated successfully!');history.back();</script>";

}
else if (isset($_POST["add_office"])) {
    # code...
    echo "<script>window.open('../add_office.php');</script>";
}
else if(isset($_POST["edit_office"])){
    echo "<script>window.open('../manage_offices.php');</script>";

}

?>