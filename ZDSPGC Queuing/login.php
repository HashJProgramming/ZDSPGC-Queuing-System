<?php 
session_start();
$con = mysqli_connect('localhost','root','','queuing_system');
mysqli_select_db($con,"queuing_system");
if (isset($_POST["guard_login"])) {
    require('./fpdf184_3/fpdf.php');
    
        // $pdf = new FPDF('P','mm',array(70,297));
        // $pdf->AddPage();
        // $pdf->SetFont('Arial','B',16);
        // $pdf->Cell(50,8,'ZDSPGC',0,0,'C');
        // $pdf->Ln();
        // $pdf->SetFont('Arial','',12);
        // $pdf->Cell(50,2,'Transaction Management System',0,0,'C');
        // $pdf->Output();
        $sql="SELECT * FROM users WHERE username = '".$_POST["username"]."' AND type = 'guard' ORDER BY ID DESC LIMIT 1;";
        $result = mysqli_query($con,$sql);  
        if(mysqli_num_rows( $result ) >= 1){
          while ($row = $result->fetch_assoc()) {
            $_SESSION["guard_name"] = $row["name"];
            $_SESSION["guard_ID"] = $row["ID"];
        }
        header("Location: ./guard_home.php");
      }
      else{
        echo "<script>alert('No user found');history.back();</script>";
      }
    
  }
    if(isset($_POST["staff_login"])){
      $sql="SELECT users.name AS 'Staff Name',users.ID,users.office,offices.name FROM users INNER JOIN offices ON offices.ID = users.office WHERE username = '".$_POST["username"]."'  AND type = 'staff' ORDER BY ID DESC LIMIT 1;";
      $result = mysqli_query($con,$sql);  
      if(mysqli_num_rows( $result ) >= 1){
        while ($row = $result->fetch_assoc()) {
          $_SESSION["staff_name"] = $row["Staff Name"];
          $_SESSION["staff_ID"] = $row["ID"];
          $_SESSION["staff_office_id"] = $row["office"];
          $_SESSION["staff_office_name"] = $row["name"];
        }
        header("Location: ./staff_home.php");
      }
      else{
        echo "<script>alert('No staff found');history.back();</script>";

      }
    }
  
?>