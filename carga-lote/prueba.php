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
<?php include 'template/header.php'; ?>
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
				Tipo Afiliado: <b><?php echo 'Aca va el tipo de afi'  ?></b>
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<?php $resultado = pg_query($con, "SELECT tipo_mat_efector FROM mat_efector GROUP BY tipo_mat_efector ORDER BY tipo_mat_efector ASC"); ?>
<div class="row">
    <div class="col-sm">
      <label>Nro. Matrícula:</label>
      <input type='number' name='nromatric' id="nromatric" class="form-control" required pattern="[0-9]{1,100}" tittle="Ingrese solo numeros sin caracteres especiales">
    </div>
    <div class="col-sm">
      <label>Tipo Matrícula:</label>
      <select name="tipomatric" id="tipomatric" required class="form-control">
        <?php while ($fila = pg_fetch_array($resultado, null, PGSQL_ASSOC)) { ?>        
        <option value="<?php echo $fila['tipo_mat_efector']; ?>"><?php echo $fila['tipo_mat_efector']; ?></option>
        <?php } ?>
      </select>
    </div>
    <button name="matricula" type="submit" class="btn">Comprobar</button>
  </div>

 <?php
 if (isset($_POST['matricula'])) {
   $queryefector = "SELECT * FROM mat_efector WHERE tipo_mat_efector='".mb_strtoupper($_POST['tipomatric'])."' AND nro_mat_efector='".$_POST['nromatric']."'";
    $resultefector = pg_query($con, $queryefector);
if ($matriculaefec = pg_num_rows($resultefector) >= 1) {
      $_SESSION['tipomatricula'] = mb_strtoupper($_POST['tipomatric']);
      $_SESSION['matricula'] = $_POST['nromatric'];
      echo "<script>window.location.assign('carga-prestaciones/index.php');</script>";
    }else{
      echo "<br>";
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' data-dismiss='alert'>Ingrese otra matricula o comuniquese al 011-4811-5555.</div>";
    }
 }


 ?>
</form>
<div class="mx-auto text-center mt-5">
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
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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