<?php
include ('../utils/db.php');
include ('./models/office.php');
// $sql = "INSERT INTO queue (date_of_transaction, number, office,status)
//       VALUES ('".date('Y-m-d')."','".($queue_number +1)."', '".$_GET["office_id"]."', 'Waiting')";
      
//       if ($con->query($sql) === TRUE) {
//           echo "New record created successfully";
//         } 

$officeID = filter_input(INPUT_POST,'office');
$action = filter_input(INPUT_POST,'action');
$current_queue = filter_input(INPUT_POST,'current_queue');

// if ($officeID && $action == "get_queue") {
//     $officesQuery="SELECT *,MAX(number) AS 'max_num' FROM queue INNER JOIN offices ON 
// offices.ID = queue.office WHERE date_of_transaction = '".date('Y-m-d')."' AND status = 'waiting' AND offices.id = '".$officeID."';";       
//         $officesQueryResult = mysqli_query($con,$officesQuery);  
//         $officeRow = $officesQueryResult->fetch_assoc();
//         echo $officeRow["max_num"];
// }
// if ($officeID && $action == "get_priority_queue") {
//     $officesQuery="SELECT *,MAX(number) AS 'max_num' FROM priority_queue INNER JOIN offices ON 
//     offices.ID = priority_queue.office WHERE date_of_transaction = '".date('Y-m-d')."' AND status = 'waiting' AND offices.id = '".$officeID."';";       
//         $officesQueryResult = mysqli_query($con,$officesQuery);  
//         $officeRow = $officesQueryResult->fetch_assoc();
//         echo $officeRow["max_num"];
// }

if ($officeID && $action == "staff_login") {
    $officesQuery="UPDATE offices SET availability = 'available' WHERE ID = '".$officeID."'";       
    if ($con->query($officesQuery) === TRUE) {
    }
}
if ($officeID && $action == "staff_logout") {
    $officesQuery="UPDATE offices SET availability = 'unavailable' WHERE ID = '".$officeID."'";       
    if ($con->query($officesQuery) === TRUE) {
    }
}
if ($officeID && $action == "get_staff_queue") {
    $officesQuery="SELECT *,MIN(number) AS 'max_num' FROM queue INNER JOIN offices ON 
offices.ID = queue.office WHERE date_of_transaction = '".date('Y-m-d')."' AND status = 'waiting' AND offices.ID = '".$officeID."';";       
        $officesQueryResult = mysqli_query($con,$officesQuery);  
        $officeRow = $officesQueryResult->fetch_assoc();
        echo $officeRow["max_num"];
}
if ($officeID && $action == "get_staff_priority_queue") {
    $officesQuery="SELECT *,MIN(number) AS 'max_num' FROM priority_queue INNER JOIN offices ON 
offices.ID = priority_queue.office WHERE date_of_transaction = '".date('Y-m-d')."' AND status = 'waiting' AND offices.ID = '".$officeID."';";       
        $officesQueryResult = mysqli_query($con,$officesQuery);  
        $officeRow = $officesQueryResult->fetch_assoc();
        echo $officeRow["max_num"];
}
if ($officeID && $action == "get_queue") {
    $officesQuery="SELECT *,MAX(number) AS 'max_num' FROM queue INNER JOIN offices ON 
offices.ID = queue.office WHERE date_of_transaction = '".date('Y-m-d')."' AND offices.ID = '".$officeID."';";       
        $officesQueryResult = mysqli_query($con,$officesQuery);  
        $officeRow = $officesQueryResult->fetch_assoc();
        echo $officeRow["max_num"];
}
if ($officeID && $action == "get_priority_queue") {
    $officesQuery="SELECT *,MAX(number) AS 'max_num' FROM priority_queue INNER JOIN offices ON 
offices.ID = priority_queue.office WHERE date_of_transaction = '".date('Y-m-d')."' AND offices.ID = '".$officeID."';";       
        $officesQueryResult = mysqli_query($con,$officesQuery);  
        $officeRow = $officesQueryResult->fetch_assoc();
        echo $officeRow["max_num"];
}
if($officeID && $action == "start_queue"){
    $insert_new_number = "INSERT INTO queue (date_of_transaction, number, office,status)
    VALUES ('".date('Y-m-d')."','1', '".$officeID."', 'Waiting')";
    if ($con->query($insert_new_number) === TRUE) {
    }
}
if($officeID && $action == "start_priority_queue"){
    $insert_new_number = "INSERT INTO priority_queue (date_of_transaction, number, office,status)
    VALUES ('".date('Y-m-d')."','1', '".$officeID."', 'Waiting')";
    if ($con->query($insert_new_number) === TRUE) {
    }
}
if($officeID && $current_queue && $action == "new_queue_number"){
    $insert_new_number = "INSERT INTO queue (date_of_transaction, number, office,status)
    VALUES ('".date('Y-m-d')."','".($current_queue+1)."', '".$officeID."', 'Waiting')";
    if ($con->query($insert_new_number) === TRUE) {
    }
}
if($officeID && $current_queue && $action == "new_priority_queue_number"){
    $insert_new_number = "INSERT INTO priority_queue (date_of_transaction, number, office,status)
    VALUES ('".date('Y-m-d')."','".($current_queue+1)."', '".$officeID."', 'Waiting')";
    if ($con->query($insert_new_number) === TRUE) {
        echo "success";
    }
}
if($officeID && $current_queue && $action == "update_office_queue"){
    $insert_new_number = "UPDATE  queue SET status = 'Serving' WHERE date_of_transaction ='".date('Y-m-d')."', number, office,status)
    '".$current_queue."', '".$officeID."', 'Waiting')";
    if ($con->query($insert_new_number) === TRUE) {
    }
}
if ($officeID && $action == "next_queue") {
    $officesQuery="SELECT *,MIN(number) AS 'max_num' FROM queue INNER JOIN offices ON 
    offices.ID = queue.office WHERE date_of_transaction = '".date('Y-m-d')."' AND status = 'waiting' AND offices.ID = '".$officeID."';";       
            $officesQueryResult = mysqli_query($con,$officesQuery);  
            $officeRow = $officesQueryResult->fetch_assoc();
            $queue_number = $officeRow["max_num"];
            if ($queue_number == "") {
                echo "None";
            }
            else{
              
                $next_queue = $queue_number + 1;
                $update_queue_status = "UPDATE  queue SET status = 'Served' WHERE date_of_transaction = '".date('Y-m-d')."' AND number = '".$queue_number."' AND office = '".$officeID."'";
                if($con->query($update_queue_status)== TRUE){
                    
                    $officesQuery="SELECT *,MIN(number) AS 'max_num' FROM queue INNER JOIN offices ON 
                    offices.ID = queue.office WHERE date_of_transaction = '".date('Y-m-d')."' AND status = 'waiting' AND offices.ID = '".$officeID."';";       
                            $officesQueryResult = mysqli_query($con,$officesQuery);  
                            $officeRow = $officesQueryResult->fetch_assoc();
                            $queue_number = $officeRow["max_num"];
                            if ($queue_number == "") {
                                echo "None";
                            }else{
                                
                                echo $next_queue;
                            }
                }
            }
        
}

if ($officeID  && $action == "next_priority_queue") {
    $officesQuery="SELECT *,MIN(number) AS 'max_num' FROM priority_queue INNER JOIN offices ON 
    offices.ID = priority_queue.office WHERE date_of_transaction = '".date('Y-m-d')."' AND status = 'waiting' AND offices.ID = '".$officeID."';";       
            $officesQueryResult = mysqli_query($con,$officesQuery);  
            $officeRow = $officesQueryResult->fetch_assoc();
            $queue_number = $officeRow["max_num"];
            if ($queue_number == "") {
                echo "None";
            }
            else{
              
                $update_queue_status = "UPDATE  priority_queue SET status = 'Served' WHERE date_of_transaction = '".date('Y-m-d')."' AND number = '".$queue_number."' AND office = '".$officeID."'";
                if($con->query($update_queue_status)== TRUE){
                    $officesQuery="SELECT *,MIN(number) AS 'max_num' FROM priority_queue INNER JOIN offices ON 
                    offices.ID = priority_queue.office WHERE date_of_transaction = '".date('Y-m-d')."' AND status = 'Waiting' AND offices.ID = '".$officeID."';";       
                            $officesQueryResult = mysqli_query($con,$officesQuery);  
                            $officeRow = $officesQueryResult->fetch_assoc();
                            $queue_number1 = $officeRow["max_num"];
                            if ($queue_number1 == "") {
                                echo "None";
                            }else{
                                
                                echo $queue_number1;
                            }
                }
            }
        
}
if ($action == "get_available_offices") {
    $officeArray = array();
    $officesQuery="SELECT * FROM offices;";   
    $officesQueryResult = mysqli_query($con,$officesQuery);  
    while($officeRow =  $officesQueryResult->fetch_assoc()){
        $office = new Office();
        $office->officeID = $officeRow["ID"];
        $office->officeName = $officeRow["name"];
        $office->availability = $officeRow["availability"];
        array_push($officeArray,$office);
    }
    echo json_encode($officeArray);
    
}
?>