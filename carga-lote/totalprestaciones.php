<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <title>Prestaciones</title>
    <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="img/logoicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto|Spectral+SC:400,700" rel="stylesheet">
    
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
	table {
		margin-left: 5%;
	}
		th {
			font-size: 14px;
			text-align: center;
		}
		td {
			font-size: 14px;
			text-align: center;
		}
		tr:hover {
			background-color: #C2BCBC;

		}
		#botonVolver {
			margin-right: 15% !important;
		}
    #cuerpo {
      padding: 3em 16em 0 16em;
    }
    .cuerpo {
      padding: 3em 0 0 30em;
    }
	</style>
  <?php include 'template/header.php'; ?>
  <div class="container">
<div class="card-header mt-3 text-center">
  <h4>Consulta de comprobantes</h4>
</div>    
  </div>
<div class="text-center" id="cuerpo">
  		<?php 
  		include 'includes/dbconnect.php';
  		$sql = "SELECT id, apellido_nombre_afiliado, nro_carnet_afiliado, convenio, pieza_dental, cara_mesial, cara_distal, cara_vestibular, cara_palatina_lingual, cara_incisal_oclusal, cod_prestacion, ctd_prestacion, fecha_prestacion FROM tmp_carga_prest_".$_SESSION['cuit']." ORDER BY fecha_prestacion ASC";
  		$result = @pg_query($con, $sql);
  		?>

  	<table class="table table-responsive table-sm table-bordered">
  		<thead>
  			<tr class="bg-info">
  				<th>Afiliado</th>
  				<th>Nº de carnet</th>
  				<th>Convenio</th>
  				<th>Pieza número</th>
  				<th>Cara mesial</th>
  				<th>Cara distal</th>
  				<th>Cara vestibular</th>
  				<th>Cara ingual</th>
  				<th>Cara oclusal</th>
  				<th>Código prestación</th>
  				<th>Cantidad</th>
  				<th>Fecha de prestación</th>
  				<th></th>
  			</tr>
  		</thead>
  		<tbody>
  			<?php while ($row = @pg_fetch_array($result, null, PGSQL_BOTH)) { ?>
  			<tr>
  				<td><?php echo $row['apellido_nombre_afiliado']; ?></td>
  				<td><?php echo $row['nro_carnet_afiliado']; ?></td>
  				<td><?php echo $row['convenio']; ?></td>
  				<td><?php echo $row['pieza_dental']; ?></td>
  				<td><?php if ($row['cara_mesial'] == 'S'){echo "&#10004;";}else{echo $row['cara_mesial'];} ?></td>
  				<td><?php if ($row['cara_distal'] == 'S'){echo "&#10004;";}else{echo $row['cara_distal'];  }?></td>
  				<td><?php if ($row['cara_vestibular'] == 'S'){echo "&#10004;";}else{echo $row['cara_vestibular'];} ?></td>
  				<td><?php if ($row['cara_palatina_lingual'] == 'S'){echo "&#10004;";}else{echo $row['cara_palatina_lingual'];} ?></td>
  				<td><?php if ($row['cara_incisal_oclusal'] == 'S'){echo "&#10004;";}else{echo $row['cara_incisal_oclusal'];} ?></td>
  				<td><?php echo $row['cod_prestacion']; ?></td>
  				<td><?php echo $row['ctd_prestacion']; ?></td>
  				<td><?php $date = date_create($row['fecha_prestacion']);
                    echo date_format($date, 'd/m/Y'); ?></td>
  				<td><a href="#" onclick="deletePrestacion('<?php echo $row[0]; ?>');"><button class="btn" ><i class="fa fa-ban" aria-hidden="true"></i></button></a></td>
  			</tr>
  			<?php } ?>
  		</tbody>
  	</table>

  	
</div>
<div class="container">
  <div class="cuerpo" id="botonVolver">
      <button class="btn btn-secondary" onclick="recargarPag()">Volver</button>
    </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="js/deletePrestacion.js"></script>
    <script>
	  function recargarPag(){
	    window.location.assign('index.php');
	  };
	</script>
  </body>
</html>