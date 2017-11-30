<?php 
require('fpdf/fpdf.php');
include ('includes/dbconnect.php');

session_start();


$comproQuery = "SELECT C.nro_pto_vta_comp, C.tipo_comp, C.letra_comp, C.nro_comp, C.fecha_comp, C.mes_presentacion, C.ano_presentacion, C.monto_exento, C.monto_gravado, C.monto_iva, C.total FROM COMP_ENTIDAD_LIQ_PREST C INNER JOIN DET_COMP_ENTIDAD_LIQ_PREST A ON A.TIPO_DOC_ENT_LIQ_PREST = C.TIPO_DOC_ENT_LIQ_PREST AND A.NRO_DOC_ENT_LIQ_PREST = C.NRO_DOC_ENT_LIQ_PREST AND A.NRO_LOTE_ENTIDAD_LIQ_PREST = C.NRO_LOTE_ENTIDAD_LIQ_PREST AND A.NRO_COMP = C.NRO_COMP AND C.ANO_PRESENTACION=".$_SESSION['anio']." AND C.MES_PRESENTACION=".$_SESSION['mes']." AND A.LIQUIDADO='S' AND A.NRO_DOC_ENT_LIQ_PREST=".$_SESSION['nrodnientidad']." AND A.ctrl_tasa_uso='S'";
$comproResult = pg_query($con, $comproQuery);

$comprorow = pg_fetch_array($comproResult, null, PGSQL_ASSOC);

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
  $this->Image('img/logoicon.png',10,1,50,30,'png');
  $this->SetFont('Arial','B',20);
  $this->Cell(200,10,utf8_decode('Presentación Lote Prestador'),0,'C','C');
  $this->Ln('10');
  $this->SetFont('Arial','I',10);
  $this->Cell(200,5,utf8_decode('Entidad: '.$GLOBALS['prestador']),0,'C','R');
  $this->Cell(40,5,utf8_decode('Período: 0'.$GLOBALS['periodo']),0,'C','C');
  $this->Cell(40,5,utf8_decode(' Fecha Liq: ' .date_format($GLOBALS['fechaliq'], 'd-m-Y')),0,'C','C');
  $this->Ln('10');
  $this->Cell(200,5,utf8_decode('Provincia: '.$GLOBALS['provincia']),0,'C','R');
  $this->Cell(40,5,utf8_decode(' Cuit: '.$GLOBALS['cuit']),0,'C','C');
}
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf = new PDF('l');
$pdf->AliasNbPages();
$pdf->AddPage();
//include('calculo.php');
$prestador = $GLOBALS['prestador'];
mysqli_set_charset($con, 'utf8');
$consulta  = ("/*" . MYSQLND_QC_ENABLE_SWITCH . "*/" . "SELECT APELLIDO_RAZON_SOC FROM detalles_ts1 WHERE CUIT='$cuit' AND MES_PRESENTACION='$mesperio' AND ANO_PRESENTACION='$anoperio' GROUP BY APELLIDO_RAZON_SOC");
$res = mysqli_query($con, $consulta);
while ($rw = mysqli_fetch_array($res)) {

  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(263,8,utf8_decode("Liquidación correspondiente a: ".$rw[0]),'0','C','L');
  $pdf->Ln('8');

  $sql1  = ("/*" . MYSQLND_QC_ENABLE_SWITCH . "*/" . "SELECT * FROM detalles_ts1 WHERE CUIT='$cuit' AND MES_PRESENTACION='$mesperio' AND ANO_PRESENTACION='$anoperio' AND APELLIDO_RAZON_SOC='$rw[0]'");
  $result1 = mysqli_query($con, $sql1);


  $pdf->SetFont('Arial','',7);
  $pdf->Cell(40,5,utf8_decode(substr($row1['APELLIDO_NOMBRE_AFILIADO'],0,25)),'0','C','L');
  $pdf->SetFont('Arial','',8);
  $pdf->Cell(19,5,utf8_decode($row1['NRO_CARNET_AFILIADO']),'0','C','L');
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(17,5,utf8_decode(substr($row1['PLAN_ASISTENCIAL'],0,15)),'0','C','L');
  $pdf->SetFont('Arial','',8);
  $fechaprest = date_create($row1['FECHA_PRESTACION']);
  $pdf->Cell(25,5,utf8_decode(date_format($fechaprest, 'd-m-Y')),'0','C','C');
  $pdf->Cell(20,5,utf8_decode($row1['COD_PRESTACION']),'0','C','C');
  $pdf->Cell(10,5,utf8_decode($row1['PIEZA_DENTAL']),'0','C','C');
}
include('calculo.php');
  $pdf->SetFont('Arial','',8);
  $pdf->SetFillColor(230,230,230);
  $pdf->Cell(146,5,utf8_decode('Total'),'0','C','C', true);
  $pdf->Cell(23,5,utf8_decode($row['exento']),'0','C','R');
  $pdf->Cell(23,5,utf8_decode($row1['gravado']),'0','C','R');
  $pdf->Cell(21,5,utf8_decode(number_format($row1['gravado']*(0.105),2,'.',',')),'0','C','R');

  $pdf->SetTitle("Detalle de Liquidación", true);
  $pdf->Output();

?>