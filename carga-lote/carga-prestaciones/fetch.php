<!doctype html>
<html lang="en">
  <head>
    <title>Carga!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="img/logoicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/semantic.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css"/>
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.css">
  </head>
  <body>
  	<style>
      * {
        font-family: 'Roboto', sans-serif;
      }   
  		body {
  			margin-bottom: 75px;
  		}
  	</style>
  	<?php session_start(); ?>
 <div class="container">
<div class="card card-outline-primary bg-light mt-5">
	<div class="card-header text-center">
		<?php echo $_SESSION['apellidos_nombres']; ?>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-4">
				Tipo Documento: <b><?php echo $_SESSION['id_tipo_documento']; ?></b>
			</div>
			<div class="col-sm-4">
				Nro. Doc: <b><?php echo $_SESSION['nro_documento']; ?></b>
			</div>
			<div class="col-sm-4">
				Localidad: <b><?php echo $_SESSION['localidad']; ?></b>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				Plan Asis: <b><?php echo $_SESSION['plan_asis']; ?></b>
			</div>
			<div class="col-sm-4">
				Cobertura Odontologica:<b> <?php echo $_SESSION['cobertura']; ?></b>
			</div>
			<div class="col-sm-4">
				Nro. Carnet: <b><?php echo $_SESSION['codigo_afiliado']; ?></b>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				Fecha Alta: <?php echo " <b>".$_SESSION['fecha_alta']."</b>"; ?>
			</div>
			<div class="col-sm-4">
				Edad: <b><?php echo $_SESSION['edad'];  ?></b>
			</div>
			<div class="col-sm-4">
				
			</div>
		</div>
	</div>
</div>
 	
<hr>
<b>Efector: </b>

<?php

require 'includes/dbconnect.php';
$prestasql = "SELECT * FROM prestador WHERE cuit='".$_SESSION['cuit']."'";

$prestaresult = pg_query($con, $prestasql);

$presta = pg_fetch_array($prestaresult, null, PGSQL_BOTH);

$_SESSION['prestaenttipodni'] = $presta['tipo_doc_ent_liq_prest']; 

$_SESSION['prestaentdni'] = $presta['nro_doc_ent_liq_prest'];

$_SESSION['prestatipodni'] = $presta['tipo_doc_prestador'];

$_SESSION['prestadni'] = $presta['nro_doc_prestador']; 

$_SESSION['prestarazonape'] = $presta['apellido_razon_soc'];

$_SESSION['prestanombre'] = $presta['nombre'];

$_SESSION['prestacuit'] = $presta['cuit'];

$_SESSION['prestalocalidad'] = $presta['localidad'];

$_SESSION['prestaprovincia'] = $presta['provincia']; 

$_SESSION['prestaobslogin'] = $presta['observaciones_login'];


?>
<form action="html" method="POST">

<div class="row">
    <div class="col-sm">
      <label>Nro. Matrícula:</label>
      <input type='number' name='nromatric' id="nromatric" class="form-control" required>
    </div>
    <div class="col-sm">
      <label>Tipo Matrícula:</label>
      <select name="tipomatric" id="tipomatric" required class="form-control">
        <option value=""></option>
      </select>
    </div>
  </div>

 <?php 
$queryefector = "SELECT * FROM MAT_EFECTOR WHERE tipo_mat_efector='".$_POST['tipomatric']."' AND nro_mat_efector='".$_POST['nromatric']."'";
$resultefector = pg_query($con, $queryefector);

 ?> 
</form>


<form id="form_conte" method="POST" action="cargalote.php">

  <div class="row">
    <div class="col-sm-4">
      <label>¿El afiliado fue derivado? </label>
    </div>
    <div class="col-sm">
       Si <input type='checkbox' name='check' id='check' value='1' onchange='javascript:showContent()' />
    </div>
  </div>
  <hr>
<div id="content" style="display: none;" >
    <div class="row">
      <div class="col-sm-12">
      <b>Prescriptor: </b>
      </div>
    </div>
<div class="row">
  <div class="col-sm">
      <label>Nro. Matrícula: </label> <input type='number' name='nromatricpres' id="nromatricpres" class="form-control">
  </div>
  <div class="col-sm">
        <label>Tipo Matrícula: </label> <input type='text' id="tipomatricpres" name='tipomatricpres' class="form-control">
  </div>
  <div class="col-sm">
        <label>Fecha Prescrip: </label> <input type='date' id="fechaprescrip" name='fechaprescrip' class="form-control" value="<?php date_default_timezone_set('America/Argentina/Buenos_Aires'); echo date('Y-m-d'); ?>">
  </div>
</div>
    <hr>
<div class="row">
    <div class="col-sm-12">
      Diagnostico: 
    </div>  
</div>
<div class="row">
    <div class="col-sm">
      <textarea name="diagnostico" id="diagnostico" class="form-control"></textarea>
    </div>
</div>
  </div>
  <br>
</div>
<div class="container-fluid">
<div class="bordecito">
    <div class="col-sm-12 text-center">
      Prestaciones a solicitar
    </div>
</div>
<div class="col-sm-12"> 
<table class="table table-sm table-responsive" id="crud_table">
  <thead>
    <tr>
      <th>Fecha de la prestación</th>
      <th>Código</th>
      <th>Descripción</th>
      <th>Cantidad</th>
      <th>Pieza</th>
      <th>Cara D</th>
      <th>Cara I/O</th>
      <th>Cara M</th>
      <th>Cara P/L</th>
      <th>Cara V</th>
      <th>Observaciones</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
     $afisql = "SELECT COUNT(*) AS TOTAL FROM pg_catalog.pg_tables WHERE tablename='tmp_carga_prest_".$_SESSION['prestacuit']."'";

    $afiresult = pg_query($con, $afisql);

    $afirow = pg_fetch_array($afiresult);

    if ($afirow['total'] == 1) {

    $afisql1 = "SELECT * FROM tmp_carga_prest_".$_SESSION['prestacuit']." WHERE nro_doc_afiliado='".$_SESSION['nro_documento']."'";

      $afiresult1 = pg_query($con, $afisql1);
     
      while ($afirow1 = pg_fetch_array($afiresult1, null, PGSQL_BOTH)) { ?>

      <tr>
        <td><?php $date = date_create($afirow1['fecha_prestacion']); echo date_format($date, 'd/m/Y'); ?></td>
        <td><?php echo $afirow1['cod_prestacion']; ?></td>
        <td class="w-25"><?php $codsql = "SELECT descripcion FROM cod_prestacion WHERE cod_prestacion='".$afirow1['cod_prestacion']."'";
          $codresult = pg_query($con, $codsql);
          $codrow = pg_fetch_assoc($codresult);
          echo $codrow['descripcion'];
         ?></td>
        <td><?php echo $afirow1['ctd_prestacion']; ?></td>
        <td><?php echo $afirow1['pieza_dental']; ?></td>
        <td><?php echo $afirow1['cara_distal']; ?></td>
        <td><?php echo $afirow1['cara_incisal_oclusal']; ?></td>
        <td><?php echo $afirow1['cara_mesial']; ?></td>
        <td><?php echo $afirow1['cara_palatina_lingual']; ?></td>
        <td><?php echo $afirow1['cara_vestibular']; ?></td>
        <td class="w-25"><?php echo $afirow1['observaciones']; ?></td>
        <td></td>
      </tr>
    <?php } } else { 
      ?>
      <tr>
        <td></td>
        <td></td>
        <td class="w-25"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="w-25"></td>
        <td></td>
      </tr>
      <?php } ?>
    <tr>
      <td><input type="date" class="form-control" value="<?php date_default_timezone_set('America/Argentina/Buenos_Aires'); echo date('Y-m-d'); ?>" name="fechaprestacion" id="fechaprestacion"></td>
      <td><input type="text" class="form-control" id="bus" name="codigoprest" onkeyup="loadXMLDoc()" autocomplete="off" required></td>
      <td class="w-25"><div id="myDiv" class="text-center"></div></td>
      <td><input type="number" id="cantidad" class="form-control" name="cantidad" placeholder="1"></td>
      <td><input type="number" id="piezanum" class="form-control" name="piezanum"></td>
      <td><input type="checkbox" id="carad" class="custom-checkbox" name="carad" value="S"></td>
      <td><input type="checkbox" id="caraio" class="custom-checkbox" name="caraio" value="S"></td>
      <td><input type="checkbox" id="caram" class="custom-checkbox" name="caram" value="S"></td>
      <td><input type="checkbox" id="carapl" class="custom-checkbox" name="carapl" value="S"></td>
      <td><input type="checkbox" id="carav" class="custom-checkbox" name="carav" value="S"></td>
      <td class="w-25"><input type="text" id="observaciones" class="form-control" name="observaciones" autocomplete="off"></td>
      <td><input type="submit" class="btn btn-outline-success" value="Agregar" name="carga" id="carga"></td>
    </tr>
  </tbody>
</table>
</div>
</form>

<div class="mx-auto text-center">
	<a href="index.php"><button class="btn">Volver</button></a>
</div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
    <script type="text/javascript">
    function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("check");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
  </script>
  </body>
</html>