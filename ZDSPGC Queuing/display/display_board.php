<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - ZDSPGC Queuing</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="../assets/css/Lista-Productos-Canito.css">
    <link rel="stylesheet" href="../assets/css/Pricing-Free-Paid-badges.css">
    <link rel="stylesheet" href="../assets/css/Pricing-Free-Paid-icons.css">
    <link rel="stylesheet" href="../assets/css/Team-images.css">
    <script src="../jquery-3.6.1.min.js"></script>
    <meta http-equiv="refresh" content="120" />
</head>

<script>
        $(document).ready(()=>{
            $.post("../admin/ajax.php",{action:"get_offices"},(data)=>{
            let result = JSON.parse(data);
          
            JSON.parse(data).forEach(element => {
                let regular_queue_number = 0;
                let priority_queue_number = 0;
                let priority_on_queue = 0;
                let on_queue = 0;
                $.post("../admin./ajax.php",{action:"get_regular_current_queue",officeID:element.ID},(regular_queue)=>{
                    regular_queue_number = regular_queue;
                    $.post("../admin./ajax.php",{action:"get_on_queue",officeID:element.ID},(on_queue_data)=>{
                        on_queue= on_queue_data;
                            $.post("../admin./ajax.php",{action:"get_priority_on_queue",officeID:element.ID},(on_priority_queue_data)=>{
                                priority_on_queue = on_priority_queue_data;

                            $.post("../admin./ajax.php",{action:"get_priority_current_queue",officeID:element.ID},(priority_queue)=>{
                            priority_queue_number = priority_queue;

                                
                            
                            $("#number-grid")
                                .append($("<div class='col-auto col-xl-3 px-4 my-5' style='height: 309.375px;'>")
                                .append($("<div class='card border-info border-2 h-100'>")
                                .append($(" <div class='card-body d-flex flex-column justify-content-between p-4'>")
                                .append($("<span class='badge bg-info position-absolute top-0 start-50 translate-middle text-uppercase text-primary' style='font-size: 25px;'>"+element.name+"</span>"))
                                .append($("<div style='padding: 3px;'>")
                                .append($("<div class='container'>")
                                .append($("<div class='row py-5'>")
                                .append($(" <div class='col-md-6'>")
                                .append($("<h6 class='fw-bold text-muted'>Priority</h6>"))
                                .append("<h1 class='display-1 fw-bold mb-4' style='font-size: 100px;'>"+priority_queue+"</h1>"))
                                .append($("<div class='col-md-6'>")
                                .append($("<h6 class='fw-bold text-muted'>Queue</h6>"))
                                .append($("<h1 class='display-1 fw-bold mb-4' style='font-size: 100px;'>"+regular_queue_number+"</h1>"))))))))
                                );
                            });

                              
                            
                        });
                    });
                    });
                });
                
            });
        });
    </script>

<body>
    <div class="row justify-content-start align-items-start row-cols-2 row-cols-lg-5 g-2 g-lg-3" id="number-grid">
       
    </div>





    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/startup-modern.js"></script>
</body>

</html>