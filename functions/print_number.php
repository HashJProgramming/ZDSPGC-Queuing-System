<?php
require('../fpdf184_3/fpdf.php');
if (isset($_GET["office_id"]) and $_GET["reprint"] == "no" and $_GET["priority_queue"] == "false") {
    session_Start();
$queue_number = 'Invalid';
$office_name = 'Invalid';
        
        // Instanciation of inherited class
    $pdf = new FPDF('P','mm',array(50,300));
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
    // Title
    $con = mysqli_connect('localhost','root','','queuing_system');
    $sql="SELECT * FROM queue INNER JOIN offices ON offices.ID = queue.office WHERE status = 'Waiting' AND
     office = ".$_GET["office_id"]." AND queue.date_of_transaction = '".date("Y-m-d")."' ORDER BY number DESC LIMIT 1";
    $result = mysqli_query($con,$sql);  
    if(mysqli_num_rows( $result ) >= 1){
        while ($row = $result->fetch_assoc()) {
            $office_name = $row["name"];
            $queue_number = $row["number"];
        }
        $pdf->Cell(0,5,'Office:',0,0,'C');
        $pdf->SetFont('Arial','B',20);
        $pdf->Ln();
        $pdf->Cell(0,10,$office_name,0,0,'C');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Times','',12);
        $pdf->SetFont('Arial','B',50);
        $pdf->Cell(0,5,$queue_number,0,0,'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial','I',8);
        $pdf->Cell(0,5,'Valid only until: '.date("M d, Y"),0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,5,'This will serve as proof of transaction.',0,0,'C');
        $pdf->Ln();
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,5,' Please do not lose.',0,0,'C');
        $pdf->SetDisplayMode('real','single');
        $pdf->Output();
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        
        $sql = "INSERT INTO queue (date_of_transaction, number, office,status)
      VALUES ('".date('Y-m-d')."','".($queue_number +1)."', '".$_GET["office_id"]."', 'Waiting')";
      
      if ($con->query($sql) === TRUE) {
          echo "New record created successfully";
        } 
    }
    else{  
         $sql = "INSERT INTO queue (date_of_transaction, number, office,status)
        VALUES ('".date('Y-m-d')."','1', '".$_GET["office_id"]."', 'Waiting')";
         if ($con->query($sql) === TRUE) {
            echo "<h1> No Record Found</h1>";
            header("location: ../guard_home.php");
            // header("location:../queue-number.php?office=".$_SESSION['office_name']);
          } 
    }
}
elseif (isset($_GET["office_id"]) and $_GET["reprint"] == "no" and $_GET["priority_queue"] == "true") {
    session_Start();
    $queue_number = 'Invalid';
    $office_name = 'Invalid';

    // start printer
// $handle = printer_open();
// printer_start_doc($handle, "My Document");
// printer_start_page($handle);
// // create content here
// // print
// printer_end_page($handle);
// printer_end_doc($handle);
// printer_close($handle);
            
            // Instanciation of inherited class
        $pdf = new FPDF('P','mm',array(50,300));
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',15);
        // Title
        $con = mysqli_connect('localhost','root','','queuing_system');
        $sql="SELECT * FROM priority_queue INNER JOIN offices ON offices.ID = priority_queue.office WHERE status = 'Waiting' AND
         office = ".$_GET["office_id"]." AND priority_queue.date_of_transaction = '".date("Y-m-d")."' ORDER BY number DESC LIMIT 1";
        $result = mysqli_query($con,$sql);  
        if(mysqli_num_rows( $result ) >= 1){
            while ($row = $result->fetch_assoc()) {
                $office_name = $row["name"];
                $queue_number = $row["number"];
            }
            $pdf->SetFont('Arial','B',30);
            $pdf->Cell(0,5,'Priority',0,0,'C');
            $pdf->Ln();
            $pdf->SetFont('Arial','B',20);
            $pdf->Ln(10);
            $pdf->Cell(0,5,'Office:',0,0,'C');
            $pdf->Ln();
            $pdf->Cell(0,10,$office_name,0,0,'C');
            // Line break
            $pdf->Ln(20);
            $pdf->SetFont('Times','',12);
            $pdf->SetFont('Arial','B',50);
            $pdf->Cell(0,5,$queue_number,0,0,'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial','I',8);
            $pdf->Cell(0,5,'Valid only until: '.date("M d, Y"),0,0,'C');
            $pdf->Ln();
            $pdf->Cell(0,5,'This will serve as proof of transaction.',0,0,'C');
            $pdf->Ln();
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,5,' Please do not lose.',0,0,'C');
            $pdf->SetDisplayMode('real','single');
            $pdf->Output();
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }
            
            $sql = "INSERT INTO priority_queue (date_of_transaction, number, office,status)
          VALUES ('".date('Y-m-d')."','".($queue_number +1)."', '".$_GET["office_id"]."', 'Waiting')";
          
          if ($con->query($sql) === TRUE) {
              echo "New record created successfully";
            } 
        }
        else{  
             $sql = "INSERT INTO priority_queue (date_of_transaction, number, office,status)
            VALUES ('".date('Y-m-d')."','1', '".$_GET["office_id"]."', 'Waiting')";
             if ($con->query($sql) === TRUE) {
                echo "<h1> No Record Found!</h1>";
                // header("location:../queue-number.php?office=".$_SESSION['office_name']);
              } 
        }
}
elseif (isset($_GET["office_id"]) and $_GET["reprint"] == "yes") {
    $queue_number = 'Invalid';
$office_name = 'Invalid';
        
        // Instanciation of inherited class
    $pdf = new FPDF('P','mm',array(50,300));
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',15);
    // Title
    $con = mysqli_connect('localhost','root','','queuing_system');
    $sql="SELECT * FROM queue INNER JOIN offices ON offices.ID = queue.office WHERE status = 'Waiting' AND office = ".$_GET["office_id"]." ORDER BY number DESC LIMIT 1";
    $result = mysqli_query($con,$sql);  
    if(mysqli_num_rows( $result ) >= 1){
        while ($row = $result->fetch_assoc()) {
            $office_name = $row["name"];
            $queue_number = $row["number"];
        }
    }
            $pdf->Cell(0,5,'Office:',0,0,'C');
            $pdf->SetFont('Arial','B',20);
            $pdf->Ln();
            $pdf->Cell(0,10,$office_name,0,0,'C');
            // Line break
            $pdf->Ln(20);
    $pdf->SetFont('Times','',12);
    $pdf->SetFont('Arial','B',50);
    $pdf->Cell(0,5,$queue_number,0,0,'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial','I',8);
    $pdf->Cell(0,5,'Valid only until: '.date("M d, Y"),0,0,'C');
    $pdf->Ln();
    $pdf->Cell(0,5,'This will serve as proof of transaction.',0,0,'C');
    $pdf->Ln();
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(0,5,' Please do not lose.',0,0,'C');
    $pdf->SetDisplayMode('real','single');
    $pdf->Output();
    
}
?>