<?php 
session_start(); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Carga</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/logoicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Spectral+SC:400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/afi_style.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.css">
     <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/bootstrap.min.css"/>
    <!-- Animate Css -->
    <link rel="stylesheet" href="css/animate.css">
  </head>
  <body>
    <style>
      * {
        font-family: 'Roboto', sans-serif;
      }
      ins{
       font-family: 'Spectral SC', serif;
      }
    </style>
    <?php include 'template/header.php'; ?>
<div class="container">
    <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="../home/">Home</a>
  </li>
    <?php if ($_SESSION['rol_usuario'] == 1) {
      echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='../afiliados'>Consulta de afiliados</a>";
      echo "</li>";
    }elseif ($_SESSION['rol_usuario'] == 4) {
      echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='../afiliados-interno/'>Consulta de afiliados</a>";
      echo "</li>";
    }else {

    } ?>
  <li class="nav-item">
    <a class="nav-link active" href="#">Carga de prestaciones</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="../comprobantes-show/">Consulta de comprobantes presentados</a>
  </li>
  <li class="nav-item mx-auto text-right">
    <a class="nav-link active text-danger" href="#" onclick="salirPag();">Salir</a>
  </li>
</ul>
     <div class="card-header mt-3 text-center">
      <h4>Carga de prestaciones</h4>
    </div>
      <br>
    <div class="pl-5 ml-5">
      <form name="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="validateForm()" class="form-inline">
        <label for="">Nro. Carnet: </label>
          <input type="text" name="carnet" class="form-control">

        <label for="" class="ml-5">Nro. Documento: </label>
          <input type="number" name="documento" class="form-control">

        <input type="submit" class="ml-5 btn btn-outline-success" name="submit">
      </form>
    </div>
      <br>
        <?php 
        include ('includes/dbconnect.php'); 
        date_default_timezone_set('America/Argentina/Buenos_Aires');
      $where = array();

          if(isset($_POST['documento']) && $_POST['documento']!="")
          {

            //$documento = $_POST['documento'];

          $where[] = "nro_documento = '".$_POST['documento']."'";
          }else{
              
          }

          if(isset($_POST['carnet']) && $_POST['carnet']!="")
            {

              //$carnet = $_POST['carnet'];

          $where[] = "codigo_afiliado = '".$_POST['carnet']."'";
          }else{
                
          }

          if (isset($_POST['submit'])) {
              if ($_POST['documento']=="" && $_POST['carnet']=="") {
          echo "<br>";
          echo "<div class='alert alert-danger alert-dismissible fade show animated zoomIn' role='alert' data-dismiss='alert'>Ingrese al menos un DNI o número de carnet.</div>";
                                
              }else {
                $sql = "SELECT * FROM padron WHERE " .implode(" AND ", $where). " ORDER BY apellidos_nombres ASC";
       
        $result = pg_query($sql) or die('No se encontraron resultados');
    
         $row = pg_fetch_array($result, null, PGSQL_BOTH);
            

        

$_SESSION['id'] = $row['id'];

$_SESSION['apellidos_nombres'] = $row['apellidos_nombres'];

$_SESSION['cod_agremiado'] = $row['cod_agremiado'];

$_SESSION['cod_cartilla'] = $row['cod_cartilla'];

$_SESSION['cod_estado_civil'] = $row['cod_estado_civil'];

$_SESSION['cod_plan'] = $row['cod_plan'];

$_SESSION['cod_plan_adicional'] = $row['cod_plan_adicional'];

$_SESSION['cod_provincia'] = $row['cod_provincia'];

$_SESSION['cod_zona'] = $row['cod_zona'];

$_SESSION['codigo_afiliado'] = $row['codigo_afiliado'];

$_SESSION['codigo_afiliado_cliente'] = $row['codigo_afiliado_cliente'];

$_SESSION['codigo_facturacion'] = $row['codigo_facturacion'];

$_SESSION['codigo_pais'] = $row['codigo_pais'];

$_SESSION['codigo_postal'] = $row['codigo_postal'];

$_SESSION['cuil'] = $row['cuil'];

$_SESSION['desc_obra_social'] = $row['desc_obra_social'];

$_SESSION['desc_plan'] = $row['desc_plan'];

$_SESSION['discapacitado'] = $row['discapacitado'];

$_SESSION['domicilio'] = $row['domicilio'];

$_SESSION['fecha_alta'] = $row['fecha_alta'];

$_SESSION['fecha_baja'] = $row['fecha_baja'];

$_SESSION['fecha_carga'] = $row['fecha_carga'];

$_SESSION['fecha_fin_de_vigencia'] = $row['fecha_fin_de_vigencia'];

$_SESSION['fecha_hora_de_carga'] = $row['fecha_hora_de_carga'];

$_SESSION['fecha_inicio_vigencia'] = $row['fecha_inicio_vigencia'];

$_SESSION['fecha_nacimiento'] = $row['fecha_nacimiento'];

$_SESSION['id_status'] = $row['id_status'];

$_SESSION['id_tipo_documento'] = $row['id_tipo_documento'];

$_SESSION['id_usuario'] = $row['id_usuario'];

$_SESSION['localidad'] = $row['localidad'];

$_SESSION['nro_documento'] = $row['nro_documento'];

$_SESSION['partido'] = $row['partido'];

$_SESSION['reparticion'] = $row['reparticion'];

$_SESSION['sexo'] = $row['sexo'];

$_SESSION['telefono'] = $row['telefono'];

$_SESSION['tipo_afiliado'] = $row['tipo_afiliado'];

$_SESSION['tipo_afiliado_parentesco'] = $row['tipo_afiliado_parentesco'];

$_SESSION['tipo_domicilio'] = $row['tipo_domicilio'];

$_SESSION['proveedor_del_template_id'] = $row['proveedor_del_template_id'];

if ($row[0] == null) {
          
          echo "<br>";
          echo "<div class='alert alert-danger alert-dismissible fade show text-center animated zoomIn' role='alert' data-dismiss='alert'>No se encuentra el afiliado.</div>";
             
}else {
?>


                 
                                                    
<div class="bordecito">
<div class="row">
    <div class="col-sm-5">
      Apellido y Nombre: <?php echo " <b>".$row['apellidos_nombres']."</b>"; ?>
    </div>
    <div class="col-sm">
      Tipo Documento: <b><?php echo $row['id_tipo_documento']; ?></b>
    </div>
    <div class="col-sm">
       Nro. Doc: <?php echo " <b>".$row['nro_documento']."</b>"; ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-5">
       <?php
              $afil = $row[1];
              $consul2 = "SELECT  to_date(fecha_nacimiento, 'dd/mm/YYYY') FROM padron WHERE apellidos_nombres='$afil'";
              $rs3 = pg_query($consul2) or die('La consulta fallo: ' . pg_last_error());
              $filita = pg_fetch_array($rs3, null, PGSQL_BOTH);
              $cumpleanos = new DateTime($filita[0]);
              $actual = new DateTime();
              $anios = $actual->diff($cumpleanos);

              $_SESSION['edad'] = $anios->y;
              echo "Edad: <b>".$anios->y."</b>";
              ?> 
    </div>
    <div class="col-sm">
     Estado:  <?php if ($row['fecha_fin_de_vigencia'] == null) { echo " <b> Activo. </b>"; }else{echo " <b> No activo. </b>";} ?>
    </div>
    <div class="col-sm">
      Localidad: <b><?php echo $row['localidad']; ?></b>
    </div>
</div>
<div class="row">
    <div class="col-sm-5">
      <?php $idTemplate = $row['proveedor_del_template_id'];
        $convenio = "SELECT A.descripcion FROM obra_social A INNER JOIN padron_template_header B ON A.id = B.obra_social_id INNER JOIN padron C ON B.id = C.proveedor_del_template_id AND C.proveedor_del_template_id= $idTemplate";
          $convCon = pg_query($convenio) or die('La consulta fallo: ' . pg_last_error());

          $conv = pg_fetch_array($convCon, null, PGSQL_BOTH);
          $_SESSION['cobertura'] = $conv[0];
         ?>
              
              Cobertura Odontologica:<b> <?php echo $conv[0]; ?></b>
    </div>
    <div class="col-sm">
       Plan Asist:
              <?php
              if ($row['cod_plan_adicional'] != null) {
                $_SESSION['plan_asis'] = $row['cod_plan']." - ".$row['cod_plan_adicional'];
                echo "<b>".$row['cod_plan']." - ".$row['cod_plan_adicional']."</b>";
              }else {
                $_SESSION['plan_asis'] = $row['cod_plan'];
                echo "<b>".$row['cod_plan']."</b>";
              }
              ?>
    </div>
    <div class="col-sm">
      Provincia: <?php echo " <b>".$row['cod_provincia']."</b>"; ?>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-5">
      Tipo Afiliado: <b> <?php echo $row['tipo_afiliado']; ?></b>
    </div>
    <div class="col-sm">
      Nro. Carnet: <b><?php echo $row['codigo_afiliado']; ?></b>
    </div>
    <div class="col-sm">
      Fecha Alta: <?php echo " <b>".$row['fecha_alta']."</b>"; ?>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <?php if ($row['fecha_fin_de_vigencia'] != null) {
        $date = date_create($row['fecha_fin_de_vigencia']);
                  echo "Fecha de baja: <b>".date_format($date, 'd/m/Y')."</b>"; 
      }else {
        echo "Fecha de baja: ";
      }
                ?>
    </div>
  </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-sm-12">
     <?php if ($row['fecha_fin_de_vigencia'] == null) { ?>
              <div class="mx-auto text-center"><a href="prueba.php" class="btn">Cargar prestaciones</a></div>
        <?php 
        }else {

          echo "<br>";
          echo "<div class='alert alert-danger alert-dismissible fade show text-center animated zoomIn' role='alert' data-dismiss='alert'>El afiliado se encuentra No Activo.</div>";
          echo "<center><button class='btn btn-outline-secondary' onclick='recargarPag();'>Recargar</button></center>";
        }
      }
    }} ?>

<center>
  <div class="btn-group mt-5">
      <a href="totalprestaciones.php" class="btn btn-outline-primary">Prestaciones</a>
  </div>
  <div class="container mt-5">
    <a href="#" onclick="presentaLote()"><button class="btn">Presentar Lote</button></a>
  </div>
</center>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
    <script src="js/presentaLote.js"></script>
    
    
<script>
  function recargarPag(){
    window.location.assign('index.php');
  };
</script>
<script>
  function volverPag(){
    window.location.assign('../home/index.php');
  };
</script>
<script>
  function salirPag(){
    window.location.assign('logout.php');
  };
</script>

  </body>
</html>