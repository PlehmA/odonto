<?php
//insert.php
include('../includes/dbconnect.php');
if(isset($_POST["item_fecha"])) {

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

$item_fecha = $_POST["item_fecha"];
$item_codigo = $_POST["item_codigo"];
$item_descripcion = $_POST["item_descripcion"];
if (isset($_POST["item_cantidad"]) && $_POST["item_cantidad"] == "") {
  $cantidad = 1;
}else {
  $item_cantidad = $_POST["item_cantidad"];
}
$item_pieza = $_POST["item_pieza"];
$item_carad = $_POST["item_carad"];
$item_caraio = $_POST["item_caraio"];
$item_caram = $_POST["item_caram"];
$item_carapl = $_POST["item_carapl"];
$item_carav = $_POST["item_carav"];
$item_observaciones = $_POST["item_observaciones"];

$query = '';
 for($count = 0; $count<count($item_fecha); $count++) {

  $item_fecha_clean = pg_escape_string($con, $item_fecha[$count]);
  $item_codigo_clean = pg_escape_string($con, $item_codigo[$count]);
  $item_descripcion_clean = pg_escape_string($con, $item_descripcion[$count]);
  $item_cantidad_clean = pg_escape_string($con, $item_cantidad[$count]);
  $item_carad_clean = pg_escape_string($con, $item_carad[$count]);
  $item_caraio_clean = pg_escape_string($con, $item_caraio[$count]);
  $item_caram_clean = pg_escape_string($con, $tem_caram[$count]);
  $item_carapl_clean = pg_escape_string($con, $item_carapl[$count]);
  $item_carav_clean = pg_escape_string($con, $item_carav[$count]);
  $item_observaciones_clean = pg_escape_string($con, $item_observaciones[$count]);

  if($item_fecha_clean != '' && $item_codigo_clean != '' && $item_cantidad_clean != '') {

   $query .= 'INSERT INTO item(item_fecha, item_codigo, item_descripcion, item_price) VALUES("'.$item_name_clean.'", "'.$item_code_clean.'", "'.$item_descripcion_clean.'", "'.$item_price_clean.'")';
  }
 }
}
?>
