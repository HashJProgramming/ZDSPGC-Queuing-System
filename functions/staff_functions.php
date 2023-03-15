<?php 
function getCurrentNumber(){
    if (isset($_SESSION["staff_office_id"])) {
        include("./utils/db.php");
    $sql="SELECT *,MIN(queue.number) AS 'waiting_number' FROM `queue` INNER JOIN offices ON offices.ID = queue.office WHERE status IN ('Serving','Waiting') AND offices.ID = '".$_SESSION["staff_office_id"]."' AND queue.date_of_transaction  = '".date("Y-m-d")."' ORDER BY number ASC    ;";       
    $result = mysqli_query($con,$sql);  
    if(mysqli_num_rows( $result ) >= 1){
        while($row = $result->fetch_assoc()){
            $_SESSION["office_id"] = $row["office"];
            $_SESSION["office_name"] = $row["name"];
            $_SESSION["office_image"]=$row["image"];
            if($row["waiting_number"] == ""){
                return "None";
            }
            else{
                return $row["waiting_number"];
            }
        }
        
    }
else{
    // $sql="SELECT * FROM offices WHERE offices.name = '".$_SESSION["staff_office_name"]."'";       
    // $result = mysqli_query($con,$sql);  
    // if(mysqli_num_rows( $result ) >= 1){
    //     while ($row = $result->fetch_assoc()) {
    //         $_SESSION["office_id"] = $row["ID"];
    //         $_SESSION["office_image"]=$row["image"];
    // }
    //     $sql = "INSERT INTO queue (date_of_transaction, number, office,status)
    //     VALUES ('".date('Y-m-d')."',1, '".$_SESSION["office_id"]."', 'Waiting')";
        
    //     if ($con->query($sql) === TRUE) {
    //       } 
    //     }
    return "0";
    }
}
else{
    header("location: staff_home.php");
}}

?>