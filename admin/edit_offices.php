<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1920, initial-scale=1.0">
    <title>Queueing System - Admin Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Geo&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,700;0,800;1,100;1,200;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
session_start();?>
        <nav >
            <button type="submit"><a href="./admin_home.php">Log out</a></button>
        </nav>
    <div class="center-content">
            <div class="login-form">
                <form method="POST" action="./functions/edit_office.php">
                    <h2>Toggle Offices</h2>
                    <h3>Check the available offices to display for today</h3>
                    <?php
               include("../utils/db.php");
               $sql="SELECT *  FROM offices;";       
               $result = mysqli_query($con,$sql);  
               while ($row = $result->fetch_assoc()) {
                   if ($row['availability'] == 'available') {
                       ?>
               <input type="checkbox" value="<?php echo $row['ID']?>"  checked  name="office_<?php echo $row['name']?>">
               <label for="office_<?php echo $row['name']?>"><?php echo $row['name']?></label><br>
               <?php
               }
               else{
                   ?>
               <input type="checkbox"  value="<?php echo $row['ID']?>"  name="office_<?php echo $row['name']?>">
               <label for="office_<?php echo $row['name']?>"><?php echo $row['name']?></label><br>
               
               <?php
               }
            }
            ?>  
                <input type="submit" value="Save" name="save_offices">
                <input type="submit" value="Edit Offices" name="edit_office">
            </form>
    </div>
    </div>
</body>