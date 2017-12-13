<?php 
require('fpdf/fpdf.php');

include ('includes/dbconnect.php');

session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$comproQuery = "SELECT B.apellido_razon_soc,
 C.tipo_comp,
  C.letra_comp,
   C.nro_comp,
    C.fecha_comp,
     C.mes_presentacion,
      C.ano_presentacion,
       C.monto_exento,
        C.monto_gravado, C.monto_iva, C.total, C.nro_lote_entidad_liq_prest, A.fecha_prestacion, A.apellido_nombre_afiliado, A.cod_prestacion, A.ctd_prestacion, A.pieza_dental, A.cara_mesial, A.cara_distal, A.cara_vestibular, A.cara_palatina_lingual, A.cara_incisal_oclusal
FROM COMP_ENTIDAD_LIQ_PREST C 
INNER JOIN PRESTADOR B ON B.TIPO_DOC_ENT_LIQ_PREST = C.TIPO_DOC_ENT_LIQ_PREST AND B.NRO_DOC_ENT_LIQ_PREST = C.NRO_DOC_ENT_LIQ_PREST
INNER JOIN DET_COMP_ENTIDAD_LIQ_PREST A ON A.TIPO_DOC_ENT_LIQ_PREST = C.TIPO_DOC_ENT_LIQ_PREST AND A.NRO_DOC_ENT_LIQ_PREST = C.NRO_DOC_ENT_LIQ_PREST 
AND A.NRO_LOTE_ENTIDAD_LIQ_PREST = C.NRO_LOTE_ENTIDAD_LIQ_PREST 
AND A.NRO_COMP = C.NRO_COMP AND C.ANO_PRESENTACION=".$_SESSION['anio']." AND C.MES_PRESENTACION=".$_SESSION['mes']." AND A.LIQUIDADO='S' AND A.NRO_DOC_ENT_LIQ_PREST=".$_SESSION['nrodnientidad']." AND A.ctrl_tasa_uso='S'";

$comproResult = pg_query($con, $comproQuery);

$comprorow = pg_fetch_array($comproResult, null, PGSQL_ASSOC);

$entidad = $comprorow['apellido_razon_soc'];
$fecha = $comprorow['fecha_comp'];
$periodo = $comprorow['mes_presentacion']."/".$comprorow['ano_presentacion'];
$lote = $comprorow['nro_lote_entidad_liq_prest'];
$total = $comprorow['total'];

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
  $this->Image('img/logoicon.png',9,5,35,20,'png');
  $this->SetFont('Arial','B',20);
  $this->Cell(160,10,utf8_decode('Presentación Lote Prestador'),1,'C','R');
  $this->Ln('10');
  $this->SetFont('Arial','I',10);
  $this->Cell(62,5,'',1,'C','R');
  $this->Cell(80,5,utf8_decode('Entidad: '.$GLOBALS['entidad']),1,'C','L');
  $this->Cell(40,5,utf8_decode('Fecha: '),1,'C','C');
  $this->Cell(40,5,utf8_decode(' Nº Lote: ' .$GLOBALS['lote']),1,'C','C');
  $this->Ln('10');
  $this->Cell(200,5,utf8_decode('Periodo: '.$GLOBALS['periodo']),1,'C','R');
  $this->Cell(40,5,utf8_decode(' Total: '.$GLOBALS['total']),1,'C','C');
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
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
//include('calculo.php');


  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(263,8,utf8_decode("Liquidación correspondiente a: "),'0','C','L');
  $pdf->Ln('8');
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(40,5,utf8_decode('APELLIDO_NOMBRE_AFILIADO'),'0','C','L');
  $pdf->SetFont('Arial','',8);
  $pdf->Cell(19,5,utf8_decode('NRO_CARNET_AFILIADO'),'0','C','L');
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(17,5,utf8_decode('PLAN_ASISTENCIAL'),'0','C','L');
  $pdf->SetFont('Arial','',8);
  $pdf->Cell(25,5,utf8_decode('FECHA_PRESTACION'),'0','C','C');
  $pdf->Cell(20,5,utf8_decode('COD_PRESTACION'),'0','C','C');
  $pdf->Cell(10,5,utf8_decode('PIEZA_DENTAL'),'0','C','C');
  $pdf->SetFont('Arial','',8);
  $pdf->SetFillColor(230,230,230);
  $pdf->Cell(146,5,utf8_decode('Total'),'0','C','C', true);
  $pdf->Cell(23,5,utf8_decode('exento'),'0','C','R');
  $pdf->Cell(23,5,utf8_decode('gravado'),'0','C','R');
  $pdf->Cell(21,5,utf8_decode('gravado'),'0','C','R');

  $pdf->SetTitle("Detalle de Liquidación", true);
  $pdf->Output();

?>