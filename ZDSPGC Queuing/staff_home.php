<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - ZDSPGC Queuing</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="assets/css/Lista-Productos-Canito.css">
    <link rel="stylesheet" href="assets/css/Pricing-Free-Paid-badges.css">
    <link rel="stylesheet" href="assets/css/Pricing-Free-Paid-icons.css">
    <link rel="stylesheet" href="assets/css/Team-images.css">

    <script type="text/javascript" src="jquery-3.6.1.min.js"></script>
</head>
<?php
session_start();
?>

<body class="mainscreen">
    <script>
        let isPaused = false;
        $(document).ready(() => {
            var officeID = $("#staff_office_id").val();

            if (officeID != "") {
                $.post("ajax/get_numbers.php", {
                    office: officeID,
                    action: "staff_login"
                });
                $(window).on("beforeunload", function() {

                    if (confirm("Do you really want to close?")) {
                        $.post("ajax/get_numbers.php", {
                            office: officeID,
                            action: "staff_logout"
                        });

                    }
                });
            }
            $.post("ajax/get_numbers.php", {
                office: officeID,
                action: 'get_staff_queue'
            }, (data, status) => {
                $("#lastNumber").html(data);
            });
            $.post("ajax/get_numbers.php", {
                office: officeID,
                action: 'get_staff_priority_queue'
            }, (data, status) => {
                $("#lastPriorityNumber").html(data);
            });

            //Functions to get the next queue numbers
            $("#get_next_queue").click((event) => {
                $.post("ajax/get_numbers.php", {
                    office: officeID,
                    action: 'next_queue'
                }, (data, status) => {
                    $("#lastNumber").html(data);
                    $("#get_next_queue").prop("disabled", true);
                    $("#get_next_queue").html("...");
                    $("#get_next_priority_queue").prop("disabled", false);
                    $("#get_next_priority_queue").html("Next");
                    $.post("admin/ajax.php", {
                        action: "get_notifications",
                        officeID: officeID
                    }, (data) => {
                        $("#notification-badge").html(data);
                    });
                });
            });

            $("#get_next_priority_queue").click((event) => {
                $.post("ajax/get_numbers.php", {
                    office: officeID,
                    action: 'next_priority_queue'
                }, (data, status) => {
                    $("#lastPriorityNumber").html(data);
                    $("#get_next_priority_queue").prop("disabled", true);
                    $("#get_next_priority_queue").html("...");
                    $("#get_next_queue").prop("disabled", false);
                    $("#get_next_queue").html("Next");
                    $.post("admin/ajax.php", {
                        action: "get_notifications",
                        officeID: officeID
                    }, (data) => {
                        $("#notification-badge").html(data);
                    });
                });
            });
            $(".pause-stop").click(() => {
                if (!isPaused) {
                    $(".mainscreen").hide();
                    $.post("admin/ajax.php", {
                        action: "pause_office",
                        officeID: officeID
                    }, (data) => {
                        if (confirm("Are you done taking a break?")) {
                            $(".mainscreen").show();
                            $.post("admin/ajax.php", {
                                action: "resume_office",
                                officeID: officeID
                            }, (data) => {

                            });
                        } else {
                            $(".mainscreen").show();

                            $.post("admin/ajax.php", {
                                action: "resume_office",
                                officeID: officeID
                            }, (data) => {
                                alert(data);
                            });
                        }
                    });
                } else {
                    $.post("admin/ajax.php", {
                        action: "resume_office",
                        officeID: officeID
                    }, (data) => {
                        alert(data);
                    });
                    isPaused = false;
                }

            });
            $.post("admin/ajax.php", {
                action: "get_notifications",
                officeID: officeID
            }, (data) => {

            });
        });
    </script>





    <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-shrink py-3" id="mainNav">
        <input type="hidden" name="staff_office_id" id="staff_office_id" value=<?php echo $_SESSION["staff_office_id"] ?>>
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="./"><span>
                    <picture style="background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;);"><img src="assets/img/illustrations/image002.jpg" width="83" height="73"></picture>ZDSPGC Transaction Queuing System
                </span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">

                <ul class="navbar-nav mx-auto">

                </ul>
                <div class="pause-stop">
                    <a class="btn btn-primary shadow" type="button" role="button" id="pause-button" style="margin: 5px;">Take a Break</a>
                </div>

                <a class="btn btn-primary shadow" role="button" href="guard/logout-staff.php?officeID=<?php echo $_SESSION["staff_office_id"] ?>" style="margin: 5px;">Sign out</a>
            </div>
        </div>
    </nav>





    <?php
    include "./functions/staff_functions.php";
    getCurrentNumber();
    ?>








    <header class="py-5">
        <div class="container pt-4 pt-xl-5">
            <div class="row pt-5">
                <div class="col-12 col-lg-10 mx-auto">
                    <div class="text-center position-relative"></div>
                </div>
            </div>
        </div>
        <section class="py-5">

            <div class="col-md-8 text-center text-md-start mx-auto">
                <div class="text-center">
                    <h1 class="display-4 fw-bold mb-5"><strong>ZDSPGC - <?php echo $_SESSION['staff_office_name']; ?></strong><span style="font-weight: normal !important; color: rgb(9, 17, 24);">&nbsp;</span><br>&nbsp;<span class="underline">System</span>.</h1>
                    <p class="fs-5 text-muted mb-5">Zamboanga Del Sur Provincial Government College<br></p>
                    <div id="notification-bell">
                        <div id="notification-badge"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" style="fill: rgba(120, 120, 120, 1);">
                            <path d="M19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v3.586l-1.707 1.707A.996.996 0 0 0 3 16v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2a.996.996 0 0 0-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707A.996.996 0 0 0 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17zm-7 5a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22z"></path>
                        </svg>
                    </div>
                </div>
            </div>





            <div class="container py-4 py-xl-5">
                <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-lg-3 d-xl-flex justify-content-xl-center">
                    <div class="col">
                        <div class="card border-warning border-2 h-100">
                            <div class="card-body d-flex flex-column justify-content-between p-4"><span class="badge bg-warning position-absolute top-0 end-0 rounded-bottom-left text-uppercase text-primary">Most PRIORITIZES&nbsp;</span>
                                <div>
                                    <h6 class="fw-bold text-muted">Priority Number</h6>
                                    <h1 class="display-1 fw-bold text-center mb-4" id="lastPriorityNumber">0</h1>
                                    <ul class="list-unstyled">
                                        <li class="d-flex mb-2"><span class="bs-icon-xs bs-icon-rounded bs-icon me-2"></span><span>Seniors&nbsp;</span></li>
                                        <li class="d-flex mb-2"><span class="bs-icon-xs bs-icon-rounded bs-icon me-2"></span><span>PDWD's</span></li>
                                    </ul>
                                </div><a class="btn btn-warning" role="button" id="get_next_priority_queue">NEXT</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-info border-2 h-100">
                            <div class="card-body d-flex flex-column justify-content-between p-4"><span class="badge bg-info position-absolute top-0 end-0 rounded-bottom-left text-uppercase text-primary">Normal Queue</span>
                                <div>
                                    <h6 class="fw-bold text-muted">Queue Number</h6>
                                    <h1 class="display-1 fw-bold text-center mb-4" id="lastNumber">0</h1>
                                    <ul class="list-unstyled">
                                        <li class="d-flex mb-2"><span class="bs-icon-xs bs-icon-rounded bs-icon me-2"></span><span>Students</span></li>
                                        <li class="d-flex mb-2"><span class="bs-icon-xs bs-icon-rounded bs-icon me-2"></span><span>59 Age Below</span></li>
                                        <li class="d-flex mb-2"></li>
                                    </ul>
                                </div><a class="btn btn-info" role="button" id="get_next_queue">NEXT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>
    <section class="py-5"></section>
    <footer>
        <div class="container py-4 py-lg-5">
            <div class="row row-cols-2 row-cols-md-4">
                <div class="col-12 col-md-3">
                    <div class="fw-bold d-flex align-items-center mb-2"><span>ZDSPGC Queuing</span></div>
                    <p class="text-muted"><span style="text-decoration: underline;">Zamboanga Del Sur Provincial Government College</span><br></p>
                </div>
                <div class="col-sm-4 col-md-3 text-lg-start d-flex flex-column">
                    <h3 class="fs-6 fw-bold">Services</h3>
                    <ul class="list-unstyled"></ul>
                    <p class="text-muted"><span style="text-decoration: underline;">Automation</span></p>
                </div>
                <div class="col-sm-4 col-md-3 text-lg-start d-flex flex-column">
                    <h3 class="fs-6 fw-bold">About</h3>
                    <ul class="list-unstyled">
                        <li><a href="#">Team</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-md-3 text-lg-start d-flex flex-column">
                    <h3 class="fs-6 fw-bold">Careers</h3>
                    <ul class="list-unstyled">
                        <li></li>
                        <li><a href="#">Benefits</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-muted d-flex justify-content-between align-items-center pt-3">
                <p class="mb-0">Copyright © 2023 ZDSPGC Transaction Queuing System</p>
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-facebook">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                        </svg></li>
                    <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-twitter">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
                        </svg></li>
                    <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-instagram">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                        </svg></li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/startup-modern.js"></script>
</body>

</html>