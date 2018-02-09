<?php
require('fpdf.php');

$s = $_POST ["sum"];
$i = $_POST ["inn"];
$b = $_POST ["bik"];
$an = $_POST ["accNum"];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,$i);
$pdf->Cell(40,30,$b);
$pdf->Cell(40,50,$an);
$pdf->Cell(40,70,$s);
$pdf->Output();
?>