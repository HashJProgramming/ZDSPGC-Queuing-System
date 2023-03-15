<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1920, initial-scale=1.0">
    <title>Queueing System - Queuing</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Geo&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,700;0,800;1,100;1,200;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
    <?php 
session_start();
include("./functions/get_office.php");

?>
    <div class="center-card-number">
        <div class="card-image">
            <img src="./assets/thumbnails/<?php echo getOfficeImage();?>" alt="2 women talking">
            <div class="image-cover"></div>
        </div>
        <div class="card-content">
            <h2 id="officeName"><?php echo $_GET["office"]; ?> </h2>
            <h3>is now Serving</h3>
            <h5>Number</h5>
        <h1 id="lastNumber"><?php echo getLastNumber();?></h1>
        </div>
        <div class="card-controls">
            <button><span class="material-symbols-outlined">print</span> <a href="./functions/print_number.php?office_id=<?php echo $_SESSION["office_id"]?>&reprint=no">Print New  Number</a> </button>
            <button><span class="material-symbols-outlined">
redo
</span> <a href="./functions/print_number.php?office_id=<?php echo $_SESSION["office_id"]?>&reprint=yes">Reprint Number</a></button>

        </div>
    </div>
    <script>
        function playbackNumber(){
    let synthesis = window.speechSynthesis;
    let number = 1;
    if (document.getElementById('lastNumber').innerHTML != '') {
        
        number = document.getElementById('lastNumber').innerHTML;
    }
    else{
        number = 1;
        document.getElementById('lastNumber').innerHTML = '1';
    }
    let utterance = new SpeechSynthesisUtterance("Office of the " + document.getElementById("officeName").innerHTML + "is now serving number " +number);
    utterance.lang = 'en-US';
utterance.rate = 1;
utterance.pitch = 1;
utterance.volume = 1;
synthesis.cancel()

return synthesis.speak(utterance)
}
window.addEventListener("load", playbackNumber);

    </script>
</body>