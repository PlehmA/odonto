<?php 
require('fpdf/fpdf.php');

include ('includes/dbconnect.php');

session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');

$loteSql = "SELECT * FROM tmp_carga_prest_".$_SESSION['cuit'];

$loteResult = pg_query($con, $loteSql);

$loterow = pg_fetch_array($loteResult, null, PGSQL_ASSOC);

$entidad = $_SESSION['prestador'];
$date = date_create($loterow['fecha_comp']);
$fecha = date_format($date, 'd/m/Y');
$datePrest = date_create($loterow['fecha_prestacion']);
$fechaPrest = date_format($datePrest, 'd/m/Y');
$periodo = $loterow['mes_presentacion']."/".$loterow['ano_presentacion'];
$lote = $loterow['nro_lote_entidad_liq_prest'];
$total = $loterow['total'];

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
  $this->Image('img/logoicon.png',9,5,35,20,'png');
  $this->SetFont('Arial','B',20);
  $this->Cell(160,10,utf8_decode('Presentación Lote Prestador'),0,'C','R');
  $this->Ln('10');
  $this->SetFont('Arial','I',10);
  $this->Cell(62,5,'',0,'C','R');
  $this->Cell(15,5,utf8_decode('Entidad:'),0,'C','L');
  $this->SetFont('Arial','B',10);
  $this->Cell(105,5,utf8_decode(''.$GLOBALS['entidad']),0,'C','L');
  $this->SetFont('Arial','I',10);
  $this->Ln('5');
  $this->Cell(62,5,'',0,'C','R');
  $this->Cell(15,5,utf8_decode('Fecha:'),0,'C','L');
  $this->Cell(35,5,utf8_decode(''.$GLOBALS['fecha']),0,'C','L');
  $this->Cell(15,5,utf8_decode('Nº Lote:'),0,'C','L');
  $this->Cell(35,5,utf8_decode('' .$GLOBALS['lote']),0,'C','L');
  $this->Ln('5');
  $this->Cell(62,5,'',0,'C','R');
  $this->Cell(15,5,utf8_decode('Periodo: '),0,'C','L');
  $this->Cell(35,5,utf8_decode(''.$GLOBALS['periodo']),0,'C','L');
  $this->Cell(15,5,utf8_decode('Total:'),0,'C','L');
  $this->Cell(35,5,utf8_decode($GLOBALS['total']),0,'C','L');
}
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(40,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    $this->Cell(40,10,utf8_decode('IMPRESO POR '.$GLOBALS['entidad']),0,0,'C');

}
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
//include('calculo.php');

  $pdf->Ln('8');
  $pdf->SetFont('Arial','',9);
  $pdf->SetFillColor(230,230,230);
  $pdf->Cell(80,10,utf8_decode('Afiliado'),'T','C','L', true);
  $pdf->Cell(25,10,utf8_decode('Fecha realiza'),'T','C','C', true);
  $pdf->Cell(35,10,utf8_decode('Codigo prestación'),'T','C','C',true);
  $pdf->Cell(15,10,utf8_decode('Pieza'),'T','C','C',true);
  $pdf->MultiCell(28,5,utf8_decode('          Cara         M   D   V  P/L I/O'),'T','C',true);

  while ($loterow = pg_fetch_array($loteResult, null, PGSQL_ASSOC)) {
  $pdf->SetFont('Arial','',7);
  $pdf->SetDrawColor(230,230,230);
  $pdf->Cell(80,5,utf8_decode($loterow['apellido_nombre_afiliado']),'B','C','L');
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(25,5,utf8_decode($fechaPrest),'B','C','C');
  $pdf->Cell(35,5,utf8_decode($loterow['cod_prestacion']),'B','C','C');
  $pdf->Cell(15.3,5,utf8_decode($loterow['pieza_dental']),'B','C','C');
  if ($loterow['cara_mesial'] == 'N') {
    $pdf->Cell(5,5,utf8_decode(''),'B','C','C');
  }else {
    $pdf->Cell(5,5,utf8_decode($loterow['cara_mesial']),'B','C','C');
  }
  if ($loterow['cara_distal'] == 'N') {
    $pdf->Cell(5,5,utf8_decode(''),'B','C','C');
  }else {
    $pdf->Cell(5,5,utf8_decode($loterow['cara_distal']),'B','C','C');
  }
  if ($loterow['cara_vestibular'] == 'N') {
    $pdf->Cell(5.2,5,utf8_decode(''),'B','C','C');
  }else {
    $pdf->Cell(5.2,5,utf8_decode($loterow['cara_vestibular']),'B','C','C');
  }
  if ($loterow['cara_palatina_lingual'] == 'N') {
    $pdf->Cell(5.2,5,utf8_decode(''),'B','C','C');
  }else {
    $pdf->Cell(5.2,5,utf8_decode($loterow['cara_palatina_lingual']),'B','C','C');
  }
  if ($loterow['cara_incisal_oclusal'] == 'N') {
     $pdf->Cell(8,5,utf8_decode(''),'B','C','C');
  }else {
     $pdf->Cell(8,5,utf8_decode($loterow['cara_incisal_oclusal']),'B','C','C');
  }
 
  $pdf->Ln('5');

}

  $pdf->SetTitle("Prestaciones presentadas", true);
  $pdf->Output();

?>