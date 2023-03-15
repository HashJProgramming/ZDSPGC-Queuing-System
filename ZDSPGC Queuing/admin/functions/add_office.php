<?php
include 'db.php'; 
  $sql = "INSERT INTO offices(name,image,availability) VALUES('".$_POST['name']."','none','available')";
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if ($conn->query($sql) === TRUE) {
    $sql = "SELECT ID FROM offices WHERE name = '" . $_POST['name'] . "' ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) >= 1) {
        $row = $result->fetch_assoc();
            $officeID = $row["ID"];
            $sql = "INSERT INTO users(username,password,type,office,name) VALUES('".$_POST['name']."','none','staff','".$officeID."','".$_POST['name']."')";
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            if ($conn->query($sql) === TRUE) {
              echo "<script type='text/javascript'>alert('$msg');</script>";
              header("Location: ../admin_home.php");
            }
        
    }
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
?>