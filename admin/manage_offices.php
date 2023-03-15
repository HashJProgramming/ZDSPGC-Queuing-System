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
                    <?php
               include("../utils/db.php");
               $sql="SELECT *  FROM offices;";       
               $result = mysqli_query($con,$sql);  
               while ($row = $result->fetch_assoc()) {
                ?>
                <div class="form-class" id="form-class">
                <h3><?php echo $row['name']?></h3>
                    <form class="manage_office_form" action="" method="post">
                        <input type="hidden" name="office_id" value = <?php echo $row["ID"]?>>
                        <input type="submit" value="Delete" name="delete_office">
                    </form>
                </div>
                <?php
            }
            ?>  
            <script>
                const form  = document.getElementById("form-class");
                function logSubmit(){
                    
                   const xhr  = new XMLHttpRequest();
                    let confirmation = confirm("Are you sure you want to delete this office?");
                    if (confirmation) {
                        xhr.open('GET', 'functions/manage_office.php?office_id=<?php echo $_POST["office_id"] ?>', true);

                        xhr.onload = () => {
                            alert("Record deletion success!");
                            location.reload();
                        };
                        xhr.send(null);
                    }
                }
                form.addEventListener('submit', logSubmit);
                
            </script>
                
    </div>
    </div>
</body>