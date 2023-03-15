<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1920, initial-scale=1.0">
    <title>Queueing System - Guard Account</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Geo&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,700;0,800;1,100;1,200;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>
<body>  <?php 
session_start();?>
<div class="header-text">
    </div>
    
    <div class="login-page">
        <h2>Edit your account details below:</h2>
        <br>
        <div class="form">
            <form class="login-form" action=<?php echo $_SERVER["PHP_SELF"]?> method="post">
                <input type="password" placeholder="Old Password" name="old_password"/>
                <input type="password" placeholder="New Password" name="new_password"/>
                <input type="Submit" value="Change Password"name="change_password">
            </form>
        </div>
        <?php
        if(isset($_POST)){

            if (isset($_POST['old_password']) and isset($_POST['new_password'])) {
                if ($_POST['old_password'] == $_POST['new_password']) {
                    include("../utils/db.php");
                    $sql = "UPDATE users SET password = '".$_POST['new_password']."' WHERE ID = ".$_SESSION["ID"] ." AND type = 'guard'";
                    
                    if ($con->query($sql) === TRUE) {
                        echo "<script>alert('Password Changed Successfully!');</script>";
                      } 
                }
                else{
                echo "<script>alert('Passwords Must match!');</script>";
                }
            }
        }
        ?>
</body>