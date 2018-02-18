<?php
require('fpdf.php');

$s = $_POST ["sum"];
$n = $_POST ["nds"];
$i = $_POST ["inn"];
$b = $_POST ["bik"];
$an = $_POST ["accNum"];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,$i);
$pdf->Cell(40,30,$b);
$pdf->Cell(40,50,$an);
$pdf->Cell(40,70,$n);
$pdf->Cell(40,90,$s);
$pdf->Output();
?>