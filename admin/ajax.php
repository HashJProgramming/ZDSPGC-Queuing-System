<?php
include '../utils/db.php';

$action = filter_input(INPUT_POST, "action");
$officeID = filter_input(INPUT_POST, "officeID");
if ($action == "get_regular_current_queue") {
    $resultString = "";
    $sql = "SELECT * , MAX(number) AS 'maxnum'from queue INNER JOIN offices ON offices.ID = queue.office WHERE status = 'Served' AND office = '" . $officeID . "' AND queue.status = 'Served' AND  date_of_transaction = '" . date('Y-m-d') . "'  ";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) >= 1) {
        while ($row = $result->fetch_assoc()) {
            $resultString = $row["maxnum"];
        }
    }
    echo $resultString;
}

if ($action == "get_priority_current_queue") {
    $resultString = "";
    $sql = "SELECT * , MAX(number) AS 'maxnum'from priority_queue INNER JOIN offices ON offices.ID = priority_queue.office WHERE status = 'Served' AND office= '" . $officeID . "' AND priority_queue.status = 'Served' AND  date_of_transaction = '" . date('Y-m-d') . "' ";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) >= 1) {
        while ($row = $result->fetch_assoc()) {
            $resultString = $row["maxnum"];
        }
    }
    echo $resultString;
}
if ($action == "get_offices") {
    $resultant_array = array();
    $sql = "SELECT * FROM offices ORDER BY name ASC";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) >= 1) {
        while ($row = $result->fetch_assoc()) {
            $result_object = new stdClass;
            $result_object->name = $row["name"];
            $result_object->ID = $row["ID"];
            array_push($resultant_array, $result_object);
        }
    }
    
    echo json_encode($resultant_array);
}

if ($action == "get_on_queue") {
    $resultString = "";
    $sql = "SELECT COUNT(ID) FROM queue WHERE status = 'Waiting' AND office = '" . $officeID . "' AND queue.date_of_transaction = '" . date('Y-m-d') . "' ";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) >= 1) {
        while ($row = $result->fetch_assoc()) {
            $resultString = $row["COUNT(ID)"];
        }
    }
    echo $resultString;

}
if ($action == "get_notifications") {
    $resultString = "";
    $sql = "SELECT SUM(tbl.tableCount) FROM (SELECT COUNT(ID) AS tableCount FROM `queue` WHERE status='Waiting' AND date_of_transaction = '".date('Y-m-d')."' AND office = '".$officeID."'
      UNION SELECT COUNT(ID) AS tableCount FROM priority_queue WHERE status='Waiting' AND date_of_transaction = '".date('Y-m-d')."' AND office = '".$officeID."' )tbl; ";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) >= 1) {
        while ($row = $result->fetch_assoc()) {
            $resultString = $row["SUM(tbl.tableCount)"];
        }
    }
    echo $resultString;

}
if ($action == "get_priority_on_queue") {
    $resultString = "";
    $sql = "SELECT COUNT(ID) FROM priority_queue WHERE status = 'Waiting' AND office = '" . $officeID . "' AND priority_queue.date_of_transaction = '" . date('Y-m-d') . "' ";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) >= 1) {
        while ($row = $result->fetch_assoc()) {
            $resultString = $row["COUNT(ID)"];
        }
    }
    echo $resultString;

}
if ($action == "get_office_availability") {
    $resultString = "";
    $sql = "SELECT availability FROM offices WHERE ID = '" . $officeID . "' ";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) >= 1) {
        while ($row = $result->fetch_assoc()) {
            $resultString = $row["availability"];
        }
    }
    echo $resultString;

}
if ($action == "pause_office") {
    $sql = "UPDATE offices SET availability = 'on break' WHERE ID = '" . $officeID . "'";
    if (mysqli_query($con, $sql)) {
        echo "You are now on break";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
if ($action == "resume_office") {
    $sql = "UPDATE offices SET availability = 'available' WHERE ID = '" . $officeID . "'";
    if (mysqli_query($con, $sql)) {
        echo "You are now available";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
?>
