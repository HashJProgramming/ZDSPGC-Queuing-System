<?php
require ('../../fpdf184_3/fpdf.php');
include 'db.php';
if (isset($_POST["from_date"]) &&isset($_POST["to_date"])) {
    $from_date = $_POST["from_date"];
    $to_date = $_POST["to_date"];
    $office = $_POST["office"];
    
    
    class PDF extends FPDF
    {
    // Page header
    function Header()
    {
        // Logo
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'ZDSPGC Queueing System',0,0,'C');
        $this->Ln(10);
        $this->Cell(80);
        $this->SetFont('Arial','',14);
        $this->Cell(30,10,'Transaction Report',0,0,'C');
        // Line break
        $this->Ln();
    }
    
    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-25);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Date Printed: '.date('M d, Y'),0,0,'C');
        $this->Ln();
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    }
    
    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $sql = "SELECT *,queue.ID AS 'trans_num' FROM queue INNER JOIN offices ON queue.office=offices.ID WHERE office = '".$office."' AND queue.status = 'Served' AND date_of_transaction >= '".$from_date."' AND date_of_transaction <= '".$to_date."' ";
    $result = mysqli_query($conn,$sql);  
    
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(30,5,"Trans. No.",1,0);
    $pdf->Cell(30,5,"Office",1,0);
    $pdf->Cell(50,5,"Status",1,0);
    $pdf->Cell(20,5,"Number",1,0);
    $pdf->Cell(50,5,"Date",1,0);
    $pdf->Ln();
    $pdf->SetFont('Arial','',11);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(30,5,$row["trans_num"],1,0);
        $pdf->Cell(30,5,$row["name"],1,0);
        $pdf->Cell(50,5,$row["status"],1,0);
        $pdf->Cell(20,5,$row["number"],1,0);
        $pdf->Cell(50,5,$row["date_of_transaction"],1,0);
        $pdf->Ln();
    }
    $pdf->Output();


}
?>