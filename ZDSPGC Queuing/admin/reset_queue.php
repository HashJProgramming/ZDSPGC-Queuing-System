<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1920, initial-scale=1.0">
    <title>Queueing System - Admin Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="../jquery-3.6.1.min.js"></script>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Geo&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,700;0,800;1,100;1,200;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>
<body>
    <script>    
    $(document).ready(()=>{
        $(document).append("<nav/>");
    });
</script>
    <?php 
session_start();?>
        <nav >
            <button type="submit"><a href="./account_settings.php">Account</a></button>
            <button type="submit"><a href="./logout.php">Log out</a></button>
        </nav>
        <div class="report">

            <form action="./functions/reports.php" method="post">
                <br>
                <label for="from_date">From (Date)</label>
                <input type="date" name="from_date">
                <br>
                <label for="to_date">To (Date)</label>
                <input type="date" name="to_date">
                <br>
                <label for="office">Office</label>
                <select name="office" id="office">Office
                    <br>
                    <?php
                    include("../utils/db.php");
                    $sql="SELECT *  FROM offices;";       
                    $result = mysqli_query($con,$sql);  
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <option value=<?php echo $row["ID"]?>> <?php echo $row["name"]?></option>
                        
                        <?php
                    }
                    ?>

                </select>
                <br>
                <input type="submit" value="Generate" id="generate">
            </form>
            <!-- <table id = "report_table">
                <thead>
                    <tr>
                        <th>Hi</th>
                        <th>Hi</th>
                        <th>Hi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Hello</td>
                        <td>Hello</td>
                        <td>Hello</td>
                    </tr>
                </tbody> -->
            <!-- </table> -->
        </div>
</body>