<?php
include('../includes/dbconnect.php');
session_start();
if (isset($_POST['carga'])) {

$prestaenttipodni = $_SESSION['prestaenttipodni'];

$prestaentdni = $_SESSION['prestaentdni'];

$prestatipodni = $_SESSION['prestatipodni'];

$prestadni = $_SESSION['prestadni'];

$prestarazonape = $_SESSION['prestarazonape']." ".$_SESSION['prestanombre'];

$prestacuit = $_SESSION['prestacuit'];;

$nrocarnet = $_SESSION['codigo_afiliado'];

$tipodocafi = $_SESSION['id_tipo_documento'];;

$nrodocuafi = $_SESSION['nro_documento'];

$apellinombreafi = $_SESSION['apellidos_nombres'];

$planasisafi = $_SESSION['plan_asis'];

$fechaaltaafi = $_SESSION['fecha_alta'];

$fechaprestacion = $_POST['fechaprestacion'];

$codigoprest = $_POST['codigoprest'];

if (isset($_POST['cantidad']) && $_POST['cantidad'] == "") {
  $cantidad = 1;
}else {
  $cantidad = $_POST['cantidad'];
}

$tipomatric = mb_strtoupper($_SESSION['tipomatricula']);

$nromatric = $_SESSION['matricula'];

if (isset($_POST['tipomatricpres']) && $_POST['tipomatricpres'] == "") {
  $tipomatricpres = "NULL";
}else {
  $tipomatricpres = $_POST['tipomatricpres'];
}
if (isset($_POST['nromatricpres']) && $_POST['nromatricpres'] == "") {
  $nromatricpres = 0;
}else {
  $nromatricpres = $_POST['nromatricpres'];
}

$fechaprescrip = $_POST['fechaprescrip'];

$diagnostico = mb_strtoupper($_POST['diagnostico']);

$observaciones = mb_strtoupper($_POST['observaciones']);

$cobertuafi = $_SESSION['cobertura'];

$piezanum = $_POST['piezanum'];

if (isset($_POST['carad']) && $_POST['carad'] == "S") {
  $carad = 'S';
}else {
  $carad = 'N';
}
if (isset($_POST['caraio']) && $_POST['caraio'] == "S") {
  $caraio = 'S';
}else {
  $caraio = 'N';
}
if (isset($_POST['caram']) && $_POST['caram'] == "S") {
  $caram = 'S';
}else {
  $caram = 'N';
}
if (isset($_POST['carapl']) && $_POST['carapl'] == "S") {
  $carapl = 'S';
}else {
  $carapl = 'N';
}
if (isset($_POST['carav']) && $_POST['carav'] == "S") {
  $carav = 'S';
}else {
  $carav = 'N';
}
if (isset($_POST['check']) && $_POST['check'] == "S") {
  $derivado = 'S';
}else {
  $derivado = 'N';
}


$createtabledb = "CREATE TABLE IF NOT EXISTS tmp_carga_prest_$prestacuit (
  tipo_doc_ent character varying(15) NOT NULL,
  nro_doc_ent bigint NOT NULL,
  tipo_doc_prestador character varying(15),
  nro_doc_prestador bigint,
  apellido_razon_soc character varying(60),
  cuit character varying(16),
  nro_carnet_afiliado character varying(16),
  tipo_doc_afiliado character varying(15),
  nro_doc_afiliado bigint,
  apellido_nombre_afiliado character varying(60),
  plan_asistencial character varying(35),
  fecha_alta date,
  fecha_prestacion date,
  cod_prestacion character varying(15),
  ctd_prestacion bigint DEFAULT 1,
  tipo_mat_efector character varying(20),
  nro_mat_efector bigint,
  derivado character varying(1) DEFAULT 'N'::bpchar,
  tipo_mat_prescriptor character varying(20) DEFAULT NULL,
  nro_mat_prescriptor bigint DEFAULT 0,
  fecha_prescripcion date,
  diagnostico character varying(250),
  observaciones character varying(250) DEFAULT NULL,
  convenio character varying(35),
  fecha_last_update timestamp without time zone DEFAULT current_date,
  fecha_carga timestamp with time zone DEFAULT current_timestamp,
  actualizado_por character varying(30) DEFAULT 'USER',
  pieza_dental character varying(3),
  cara_mesial char(1) DEFAULT 'N'::bpchar,
  cara_distal char(1) DEFAULT 'N'::bpchar,
  cara_vestibular char(1) DEFAULT 'N'::bpchar,
  cara_palatina_lingual char(1) DEFAULT 'N'::bpchar,
  cara_incisal_oclusal char(1) DEFAULT 'N'::bpchar,
  id SERIAL PRIMARY KEY)";

$createtablequery = pg_query($con, $createtabledb);

	$insertsql = "INSERT INTO tmp_carga_prest_$prestacuit(tipo_doc_ent, nro_doc_ent, tipo_doc_prestador, nro_doc_prestador, nro_carnet_afiliado, tipo_doc_afiliado, nro_doc_afiliado, plan_asistencial, fecha_alta, fecha_prestacion, cod_prestacion, ctd_prestacion, tipo_mat_efector, nro_mat_efector, tipo_mat_prescriptor,nro_mat_prescriptor, fecha_prescripcion, diagnostico, observaciones, convenio, pieza_dental, cara_mesial, cara_distal, cara_vestibular, cara_palatina_lingual, cara_incisal_oclusal, apellido_razon_soc, apellido_nombre_afiliado, cuit, derivado) VALUES ('$prestaenttipodni', $prestaentdni, '$prestatipodni', $prestadni, '$nrocarnet', '$tipodocafi', $nrodocuafi, '$planasisafi', '$fechaaltaafi', '$fechaprestacion', '$codigoprest', '$cantidad', '$tipomatric', '$nromatric', '$tipomatricpres', $nromatricpres,'$fechaprescrip', '$diagnostico', '$observaciones', '$cobertuafi', '$piezanum', '$caram', '$carad', '$carav', '$carapl', '$caraio', '$prestarazonape', '$apellinombreafi', '$prestacuit', '$derivado') ";
	$statement = pg_query($con, $insertsql);
if ($statement == true) {
  echo "<script>alert('Carga correcta');</script>";
  //header('Location: carga-prestaciones/index.php');
  echo "<script>window.location.assign('carga-prestaciones/index.php')</script>";
}



}
?>