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
        C.monto_gravado,
         C.monto_iva, C.total,
          C.nro_lote_entidad_liq_prest,
           A.fecha_prestacion,
            A.apellido_nombre_afiliado,
             A.cod_prestacion,
              A.ctd_prestacion,
               A.pieza_dental,
                A.cara_mesial,
                 A.cara_distal,
                  A.cara_vestibular,
                   A.cara_palatina_lingual,
                    A.cara_incisal_oclusal
FROM COMP_ENTIDAD_LIQ_PREST C 
INNER JOIN PRESTADOR B ON B.TIPO_DOC_ENT_LIQ_PREST = C.TIPO_DOC_ENT_LIQ_PREST AND B.NRO_DOC_ENT_LIQ_PREST = C.NRO_DOC_ENT_LIQ_PREST
INNER JOIN DET_COMP_ENTIDAD_LIQ_PREST A ON A.TIPO_DOC_ENT_LIQ_PREST = C.TIPO_DOC_ENT_LIQ_PREST AND A.NRO_DOC_ENT_LIQ_PREST = C.NRO_DOC_ENT_LIQ_PREST 
AND A.NRO_LOTE_ENTIDAD_LIQ_PREST = C.NRO_LOTE_ENTIDAD_LIQ_PREST 
AND A.NRO_COMP = C.NRO_COMP AND C.ANO_PRESENTACION=".$_SESSION['anio']." AND C.MES_PRESENTACION=".$_SESSION['mes']." AND A.LIQUIDADO='S' AND A.NRO_DOC_ENT_LIQ_PREST=".$_SESSION['nrodnientidad']." AND A.ctrl_tasa_uso='S'";

$comproResult = pg_query($con, $comproQuery);

$comprorow = pg_fetch_array($comproResult, null, PGSQL_ASSOC);

$entidad = $_SESSION['prestador'];
$date = date_create($comprorow['fecha_comp']);
$fecha = date_format($date, 'd/m/Y');
$datePrest = date_create($comprorow['fecha_prestacion']);
$fechaPrest = date_format($datePrest, 'd/m/Y');
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
  $pdf->MultiCell(30,5,utf8_decode('           Cara          M   D   V   P/L   I/O'),'T','C',true);

  while ($comprorow = pg_fetch_array($comproResult, null, PGSQL_ASSOC)) {
  $pdf->SetFont('Arial','',7); 
  $pdf->Cell(80,5,utf8_decode($comprorow['apellido_nombre_afiliado']),0,'C','L');
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(25,5,utf8_decode($fechaPrest),0,'C','C');
  $pdf->Cell(35,5,utf8_decode($comprorow['cod_prestacion']),0,'C','C');
  $pdf->Cell(15.3,5,utf8_decode($comprorow['pieza_dental']),0,'C','C');
  $pdf->Cell(5,5,utf8_decode($comprorow['cara_mesial']),0,'C','C');
  $pdf->Cell(5,5,utf8_decode($comprorow['cara_distal']),0,'C','C');
  $pdf->Cell(5.2,5,utf8_decode($comprorow['cara_vestibular']),0,'C','C');
  $pdf->Cell(5.2,5,utf8_decode($comprorow['cara_palatina_lingual']),0,'C','C');
  $pdf->Cell(10.2,5,utf8_decode($comprorow['cara_incisal_oclusal']),0,'C','C');
  $pdf->Ln('5');

}

  $pdf->SetTitle("Prestaciones presentadas", true);
  $pdf->Output();

?>