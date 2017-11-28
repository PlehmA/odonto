<?php session_start(); ?>
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
    <a class="nav-link active" href="#">Home</a>
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
    <a class="nav-link" href="../comprobantes-show/">Consulta de comprobantes</a>
  </li>
  <li class="nav-item mx-auto text-right">
    <a class="nav-link active text-danger" href="#" onclick="salirPag();">Salir</a>
  </li>
</ul>
<?php 
include ('includes/dbconnect.php');

$notificacionQuery = "SELECT * FROM prestador WHERE cuit='".trim($_SESSION['cuit'])."'";
$notificacionResult = pg_query($con, $notificacionQuery);
$notificacion = pg_fetch_array($notificacionResult, null, PGSQL_ASSOC);

$_SESSION['tipodniprestador'] =  $notificacion['tipo_doc_prestador'];
$_SESSION['nrodniprestador'] =  $notificacion['nro_doc_prestador'];
$_SESSION['tipodnientidad'] =  $notificacion['tipo_doc_ent_liq_prest'];
$_SESSION['nrodnientidad'] =  $notificacion['nro_doc_ent_liq_prest'];

echo $_SESSION['tipodniprestador'].$_SESSION['nrodniprestador'].$_SESSION['tipodnientidad'].$_SESSION['nrodnientidad'];

if ($notificacion['observaciones_login'] == null) {
 echo "<div class='card-header mt-3 text-center'>";
 echo "<h1>Bienvenido</h1>";
 echo "</div>";
}else {
  echo "<div class='card card-body mt-5'>";
  echo "<div class='col'>";
  echo $notificacion['observaciones_login'];
  echo "</div>";
  echo "</div>";
}
?>
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