<?php
session_start();

include('includes/dbconnect.php');
$periodoConsul = pg_query($con, "SELECT * FROM periodo");
$periodo = pg_fetch_assoc($periodoConsul);

$mesperio = $periodo['mes_presentacion'];
$anioperio = $periodo['anio_presentacion'];
//print_r(array_keys(get_defined_vars()));
$sql = "SELECT * FROM tmp_carga_prest_".$_SESSION['cuit'];
$result = pg_query($con, $sql);

while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {

$tipoDocEntidad = $row['tipo_doc_ent'];
$numeroDocEntidad = $row['nro_doc_ent'];
$tipoDocPrestador = $row['tipo_doc_prestador'];
$numeroDocPrestador = $row['nro_doc_prestador'];
$numeroCarnet = $row['nro_carnet_afiliado'];
$tipoDocAfiliado = $row['tipo_doc_afiliado'];
$numeroDocAfiliado = $row['nro_doc_afiliado'];
$planAsistencial = $row['plan_asistencial'];
$fechaAlta = $row['fecha_alta'];
$fechaPrestacion = $row['fecha_prestacion'];
$codigoPrestacion = $row['cod_prestacion'];
$cantidadPrestacion = $row['ctd_prestacion'];
$tipoMatriculaEfector = $row['tipo_mat_efector'];
$numeroMatriculaEfector = $row['nro_mat_efector'];
$tipoMatriculaPrescriptor = $row['tipo_mat_prescriptor'];
$numeroMatriculaPrescriptor = $row['nro_mat_prescriptor'];
$fechaPrescripcion = $row['fecha_prescripcion'];
$diagnostico = $row['diagnostico'];
$observaciones = $row['observaciones'];
$convenio = $row['convenio'];
$piezaDental = $row['pieza_dental'];
$caraMesial = $row['cara_mesial'];
$caraDistal = $row['cara_distal'];
$caraVestibular = $row['cara_vestibular'];
$caraLingual = $row['cara_palatina_lingual'];
$caraOclusal = $row['cara_incisal_oclusal'];
$apellidoRazonSoc = $row['apellido_razon_soc'];
$apellidoNombreAfi = $row['apellido_nombre_afiliado'];
$cuit = $row['cuit'];
$derivado = $row['derivado'];
$fecha_carga = $row['fecha_carga'];

$query = "INSERT INTO det_lote_entidad_liq_prest
	(tipo_doc_ent, 
	nro_doc_ent, 
	tipo_doc_prestador, 
	nro_doc_prestador, 
	nro_carnet_afiliado, 
	tipo_doc_afiliado, 
	nro_doc_afiliado, 
	plan_asistencial, 
	fecha_alta, 
	fecha_prestacion, 
	cod_prestacion, 
	ctd_prestacion, 
	tipo_mat_efector, 
	nro_mat_efector, 
	tipo_mat_prescriptor, 
	nro_mat_prescriptor, 
	fecha_prescripcion, 
	diagnostico, 
	observaciones, 
	convenio,
    pieza_dental, 
    cara_mesial, 
    cara_distal, 
    cara_vestibular, 
    cara_palatina_lingual, 
    cara_incisal_oclusal, 
    apellido_razon_soc, 
    apellido_nombre_afiliado, 
    cuit, 
    mes_presentacion, 
    anio_presentacion,
    estado, 
    derivado,
    fecha_carga)
    VALUES 
    ('$tipoDocEntidad',
    $numeroDocEntidad,
    '$tipoDocPrestador',
    '$numeroDocPrestador',
    '$numeroCarnet',
    '$tipoDocAfiliado',
	'$numeroDocAfiliado',
	'$planAsistencial',
	'$fechaAlta',
	'$fechaPrestacion',
	'$codigoPrestacion',
	'$cantidadPrestacion',
	'$tipoMatriculaEfector',
	$numeroMatriculaEfector,
	'$tipoMatriculaPrescriptor',
	'$numeroMatriculaPrescriptor',
	'$fechaPrescripcion',
	'$diagnostico',
	'$observaciones',
	'$convenio',
	'$piezaDental',
	'$caraMesial',
	'$caraDistal',
	'$caraVestibular',
	'$caraLingual', 
	'$caraOclusal', 
	'$apellidoRazonSoc', 
	'$apellidoNombreAfi', 
	'$cuit',
	$mesperio,
	$anioperio,
	'PENDIENTE',
	'$derivado',
	'$fecha_carga')";
	$insert = pg_query($con, $query);
}

$droptabledb = "DROP TABLE IF EXISTS tmp_carga_prest_".$_SESSION['cuit'];

$droptablequery = pg_query($con, $droptabledb) or die(pg_last_error());

echo "<script>alert('Lote presentado correctamente')</script>";
echo "<script>window.location.assign('index.php')</script>";
?>