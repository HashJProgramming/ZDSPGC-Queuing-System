<?php 
function getLastNumber(){
    if (isset($_GET["office"])) {
        include("./utils/db.php");
    $sql="SELECT * FROM queue INNER JOIN offices ON offices.ID = queue.office WHERE queue.status = 'Waiting' AND offices.name = '".$_GET["office"]."' AND queue.date_of_transaction  = '".date("Y-m-d")."' ORDER BY number DESC LIMIT 1";       
    $result = mysqli_query($con,$sql);  
    if(mysqli_num_rows( $result ) >= 1){
    while ($row = $result->fetch_assoc()) {
    $_SESSION["office_id"] = $row["office"];
    $_SESSION["office_name"] = $row["name"];
    return $row["number"];
    }
    }
    else{

        $sql="SELECT * FROM offices WHERE offices.name = '".$_GET["office"]."'";       
        $result = mysqli_query($con,$sql);  
        if(mysqli_num_rows( $result ) >= 1){
    while ($row = $result->fetch_assoc()) {
        $_SESSION["office_id"] = $row["ID"];
    }
        $sql = "INSERT INTO queue (date_of_transaction, number, office,status)
        VALUES ('".date('Y-m-d')."',1, '".$_SESSION["office_id"]."', 'Waiting')";
        
        if ($con->query($sql) === TRUE) {
          } 
        }}
}
else{
    header("location: queue-number.php");
}}
function getOfficeName(){
    if (isset($_GET["office"])) {
        include("./utils/db.php");
    $sql="SELECT * FROM `queue` INNER JOIN offices ON offices.ID = queue.office WHERE status = 'Waiting' AND name = '".$_GET["office"]."' AND queue.date_of_transaction = ".date("Y-m-d")."";       
    $result = mysqli_query($con,$sql);  
    while ($row = $result->fetch_assoc()) {
    return $row["name"];
    }
    }
else{
    header("location: queue-number.php");
}}

function getOfficeImage(){
    if (isset($_GET["office"])) {
        include("./utils/db.php");
    $sql="SELECT * FROM `offices` INNER JOIN queue ON offices.ID = queue.office WHERE  status = 'Waiting' AND name = '".$_GET["office"]."'";       
    $result = mysqli_query($con,$sql);  
    while ($row = $result->fetch_assoc()) {
    return $row["image"];
    }
    }
else{
    header("location: queue-number.php");
}
}
// if (condition) {
//     # code...
// }
?>