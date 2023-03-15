<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1920, initial-scale=1.0">
    <title>Queueing System - Home - Guard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="jquery-3.6.1.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="printThis/printThis.js" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css2?family=Geo&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,700;0,800;1,100;1,200;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>

<body>

    <style>
        .print>h1 {
            font-size: 2em;
        }

        .print>h6 {
            font-size: 0.8em;
        }
    </style>

    <script>
        $(document).ready(() => {
            $.post("ajax/get_numbers.php", {
                action: 'get_available_offices'
            }, (data, status) => {
                const offices = JSON.parse(data);
                const center_content = $("#center-content");
                offices.forEach(element => {
                    if (element.availability != "available") {
                        center_content.append($("<div class='office_row'></div>").append($("<div class='office_name'>" + element.officeName + "</div>")).append($("<h5  >Unavailable</h5>")));
                    } else {
                        center_content.append($("<div class='office_row'></div>").append($("<div class='office_name'>" + element.officeName + "</div>")).append($("<button id = 'print_button' class='print_button' >Print</button>").click((event) => {
                            //function for printing number
                            $.post("admin/ajax.php", {
                                action: "get_office_availability",
                                officeID: element.officeID
                            }, (availability) => {
                                if (availability == "available") {
                                    $.post("ajax/get_numbers.php", {
                                            office: element.officeID,
                                            action: 'get_queue'
                                        },
                                        ((data, status) => {
                                            if (status == 'success' && data == "") {
                                                $.post("ajax/get_numbers.php", {
                                                    action: "start_queue",
                                                    office: element.officeID
                                                }, ((data, status) => {}));
                                                $("<center class='print'></center>").append($("<h6>ZDSPGC Queueing System</h6>")).append($("<h5>" + element.officeName + "</h5>")).append($("<h1>1</h1>"))
                                                    .append($("<h6>This is only valid until: " + new Date(Date.now()).toDateString() + "</h6>")).printThis();
                                            } else {
                                                $.post("ajax/get_numbers.php", {
                                                    action: "new_queue_number",
                                                    office: element.officeID,
                                                    current_queue: data
                                                }, (((data, status) => {
                                                    $.post("ajax/get_numbers.php", {
                                                        office: element.officeID,
                                                        action: 'get_queue'
                                                    }, ((data, status) => {
                                                        $("<center class='print'></center>").append($("<h6>ZDSPGC Queueing System</h6>")).append($("<h5>" + element.officeName + "</h5>")).append($("<h1>" + data + "</h1>"))
                                                            .append($("<h6>This is only valid until: " + new Date(Date.now()).toDateString() + "</h6>")).printThis();
                                                    }));
                                                })));

                                            }

                                        }));
                                } else {
                                    alert("Cannot Print. Staff is on break");
                                }
                            });
                        }), $("<button id = 'priority_queue' class='priority_queue' >Priority</button>").click((event) => {
                            $.post("admin/ajax.php", {
                                action: "get_office_availability",
                                officeID: element.officeID
                            }, (availability) => {
                                if (availability == "available") {
                                    $.post("ajax/get_numbers.php", {
                                            office: element.officeID,
                                            action: 'get_priority_queue'
                                        },
                                        ((priority_data, status) => {
                                            if (status == 'success' && priority_data == "") {
                                                $.post("ajax/get_numbers.php", {
                                                    action: "start_priority_queue",
                                                    office: element.officeID
                                                }, ((priority_data, status) => {}));
                                                $("<center class='print'></center>").append($("<h6>ZDSPGC Queueing System</h6>")).append($("<h1>Priority</h1>")).append($("<h5>" + element.officeName + "</h5>")).append($("<h1>1</h1>"))
                                                    .append($("<h6>This is only valid until: " + new Date(Date.now()).toDateString() + "</h6>")).printThis();
                                            } else {
                                                $.post("ajax/get_numbers.php", {
                                                    action: "new_priority_queue_number",
                                                    office: element.officeID,
                                                    current_queue: priority_data
                                                }, (((data, status) => {
                                                    $.post("ajax/get_numbers.php", {
                                                        office: element.officeID,
                                                        action: 'get_priority_queue'
                                                    }, ((priority_data, status) => {
                                                        $("<center class='print'></center>").append($("<h6>ZDSPGC Queueing System</h6>")).append($("<h1>Priority</h1>")).append($("<h5>" + element.officeName + "</h5>")).append($("<h1>" + priority_data + "</h1>"))
                                                            .append($("<h6>This is only valid until: " + new Date(Date.now()).toDateString() + "</h6>")).printThis();
                                                    }));
                                                })));
                                            }

                                        }));
                                } else {
                                    alert("Cannot Print. Staff is on break");
                                }
                            });
                        })));
                    }
                });
            });

        });
    </script>

    <nav>
        <button type="submit"><a href="./guard/logout.php">Log out</a></button>
    </nav>
    <div class="center-content" id="center-content">

        <h1>Welcome, Chief!</h1>
        <h4>Select an office below</h4>
        <br>
        <br>
    </div>

</body>