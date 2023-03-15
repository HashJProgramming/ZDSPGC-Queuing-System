<?php
include 'db.php'; 
if (isset($_POST['add_staff'])) {
    # code...
    $sql = "INSERT INTO users(username,password,type,office,name) VALUES('".$_POST['staff_username']."','123','staff','".$_POST['office_id']."','Staff')";
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin_home.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>