<?php 
session_start(); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Bienvenido</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/logoicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Spectral+SC:400,700" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.css">
     <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css"/>
  </head>
  <body>
    <style>
      * {
        font-family: 'Roboto', sans-serif;
      }
    </style>
<?php include 'template/header.php'; ?>

<div class="container mt-3">
  <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="../home/">Home</a>
  </li>
    <?php if ($_SESSION['rol_usuario'] == 1) {
      echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='../afiliados/'>Consulta de afiliados</a>";
      echo "</li>";
    }elseif ($_SESSION['rol_usuario'] == 4) {
      echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='../afiliados-interno/'>Consulta de afiliados</a>";
      echo "</li>";
    }else {

    } ?>
  <li class="nav-item">
    <a class="nav-link" href="../carga-lote/">Carga de prestaciones</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#">Consulta de comprobantes</a>
  </li>
  <li class="nav-item mx-auto text-right">
    <a class="nav-link active text-danger" href="#" onclick="salirPag();">Salir</a>
  </li>
</ul>
<div class="card-header mt-3 text-center">
  <h4>Consulta de comprobantes</h4>
</div>

<form class="mt-5 form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
  <div class="form-group col-sm-3">
    
  </div>
  <div class="form-group col-sm-2">
    <label class="mr-1">MES: </label>
      <input type="number" min="01" max="12" minlength="2" maxlength="2" placeholder="<?php echo date('m'); ?>" value="<?php echo date('m'); ?>" class="form-control form-control-sm" name="mesperiodo">
  </div>

  <div class="form-group col-sm-2">
    <label class="mr-1">AÑO: </label>
      <input type="number" min="2000" max="4000" minlength="4" maxlength="4" placeholder="<?php echo date('Y'); ?>" value="<?php echo date('Y'); ?>" class="form-control form-control-sm" name="anioperiodo">
  </div>

  <div class="form-group col-sm-2">
    <input type="submit" value="Comprobar" class="btn btn-primary" name="submit">
  </div>
  
</form>

</div>

<div class="container">
  <table class="table table-sm">
  <thead>
    <tr>
      <th>Comprobante</th>
      <th>Fecha comprobante</th>
      <th>Mes presentación</th>
      <th>Año presentación</th>
      <th>Monto exento</th>
      <th>Monto gravado</th>
      <th>Monto I.V.A.</th>
      <th>Total</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
<?php include '../includes/dbconnect.php';
if (isset($_POST['submit'])) {
  $mes = $_POST['mesperiodo'];
  $anio = $_POST['anioperiodo'];
  $comprobanteQuery = "SELECT * FROM liq_entidad_liq_prest WHERE nro_doc_ent_liq_prest=".$_SESSION['nrodnientidad']." AND mes_presentacion=$mes AND ano_presentacion=$anio";
  $comprobanteResult = pg_query($con, $comprobanteQuery); ?>
 <?php while ($comprobantes = pg_fetch_array($comprobanteResult, null, PGSQL_ASSOC)) { ?>
 <tr>
   <td><?php echo str_pad($comprobantes[''], 4, "0", STR_PAD_LEFT); ?></td>
   <td><?php echo $comprobantes['fecha_liquidacion']; ?></td>
   <td><?php echo $comprobantes['mes_presentacion']; ?></td>
   <td><?php echo $comprobantes['ano_presentacion']; ?></td>
   <td><?php echo $comprobantes['']; ?></td>
   <td><?php echo $comprobantes['']; ?></td>
   <td><?php echo $comprobantes['']; ?></td>
   <td><?php echo $comprobantes['']; ?></td>
   <td><button class="btn">Imprimir</button></td>
  </tr>
  <?php } ?> <!-- TERMINA LA CONDICION WHILE -->
 
<?php } ?> <!-- TERMINA LA CONDICION IF -->
<?php pg_close($con); ?>
 </tbody>
</table>
</div>
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
    
    
<script>
  function recargarPag(){
    window.location.assign('index.php');
  };
</script>
<script>
  function volverPag(){
    window.location.assign('../index.php');
  };
</script>
<script>
  function salirPag(){
    window.location.assign('../logout.php');
  };
</script>

  </body>
</html>