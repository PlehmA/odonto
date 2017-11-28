<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="css/afi_style.css">
    <link rel="stylesheet" href="datatables.min.css">
  </head>
  <body>
    <?php include 'template/header.php'; ?>
    <div class="container">
      <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="../home/">Home</a>
  </li>
    <?php if ($_SESSION['rol_usuario'] == 1) {
      echo "<li class='nav-item'>";
      echo "<a class='nav-link active' href='#'>Consulta de afiliados</a>";
      echo "</li>";
    }elseif ($_SESSION['rol_usuario'] == 4) {
      echo "<li class='nav-item'>";
      echo "<a class='nav-link active' href='#'>Consulta de afiliados</a>";
      echo "</li>";
    }else {

    } ?>
  <li class="nav-item">
    <a class="nav-link" href="../carga-lote/">Carga de prestaciones</a>
  </li>
  <li class="nav-item mx-auto text-right">
    <a class="nav-link active text-danger" href="#" onclick="salirPag();">Salir</a>
  </li>
</ul>
  <div class="card-header mt-3 text-center">
      <h4>Consulta de Afiliados</h4>
    </div>
      <br>
    <div>
      <form name="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validateForm()" class="form-inline">
        <label for="">Nro. Carnet: </label>
          <input type="number" name="carnet" class="form-control">

        <label for="">Nro. Documento: </label>
          <input type="number" name="documento" class="form-control">
      
        <label for="">Apellido y Nombre: </label>
          <input type="text" name="apellido" class="form-control">

        <input type="submit" class="ml-5 btn btn-outline-success" name="submit">
      </form>
    </div>
      <br>
     <div>
      <table class="table table-sm table-striped" id="myTable">
      <thead>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
      </thead>
      <tbody>
        <?php 
        include ('includes/dbconnect.php'); 
        date_default_timezone_set('America/Argentina/Buenos_Aires');
      $where = array();

      if(isset($_POST['apellido']) && $_POST['apellido']!="")
          {

            //$apellido = $_POST['apellido'];
          $where[] = "apellidos_nombres LIKE '".strtoupper($_POST['apellido'])."%'";
          }else{
              echo "<script src='/javascripts/application.js' type='text/javascript' charset='utf-8' async defer>alert('Complete al menos un campo')</script>";
          }

          if(isset($_POST['documento']) && $_POST['documento']!="")
          {

            //$documento = $_POST['documento'];

          $where[] = "nro_documento = '".$_POST['documento']."'";
          }else{
              echo "<script src='/javascripts/application.js' type='text/javascript' charset='utf-8' async defer>alert('Complete al menos un campo')</script>";
          }

          if(isset($_POST['carnet']) && $_POST['carnet']!="")
            {

              //$carnet = $_POST['carnet'];

          $where[] = "codigo_afiliado = '".$_POST['carnet']."'";
          }else{
                  echo "<script src='/javascripts/application.js' type='text/javascript' charset='utf-8' async defer>alert('Complete al menos un campo')</script>";
          }

          if (isset($_POST['submit'])) {
              if ($_POST['documento']=="" && $_POST['carnet']=="" && $_POST['apellido'] == "") {
                echo "<script>alert('Complete por lo menos un campo!');</script>";
                echo "<script>window.location.assign('index.php')</script>";
              }
            

        $sql = "SELECT * FROM padron WHERE " .implode(" AND ", $where). " ORDER BY apellidos_nombres ASC LIMIT 100";
       
        $result = pg_query($sql) or die('La consulta fallo: ' . pg_last_error());
    
         while ($row = pg_fetch_array($result, null, PGSQL_BOTH)) { ?>

         <div id="exampleAccordion" data-children=".item">
                <div class="item">
        <tr>
                 
      <td class="text-left"  style="font-size: 14px;">
                                                    <!-- Apellido y Nombre Afiliado -->
        Apellido y Nombre:<br> 
              <?php echo " <b>".$row['apellidos_nombres']."</b>"; ?>
                                                    <!-- Apellido y Nombre Afiliado Fin -->
              <br>
              <br>
                                                    <!-- Edad Afiliado -->
              <?php
              $afil = $row[1];
              $consul2 = "SELECT  to_date(fecha_nacimiento, 'dd/mm/YYYY') FROM padron WHERE apellidos_nombres='$afil'";
              $rs3 = pg_query($consul2) or die('La consulta fallo: ' . pg_last_error());
              $filita = pg_fetch_array($rs3, null, PGSQL_BOTH);

              $cumpleanos = new DateTime($filita[0]); 
              $actual = new DateTime();
              $anios = $actual->diff($cumpleanos);
              echo "Edad: <b>".$anios->y."</b>";

              ?>  
                                                    <!-- Edad Afiliado Fin -->
              <br>
              <br>
                                                    <!-- Tipo Afiliado Afiliado -->
              Tipo Afiliado: <b> <?php echo $row['tipo_afiliado']; ?></b>
                                                    <!-- Tipo Afiliado Afiliado FIN -->
            </td>
      <td class="text-left"  style="font-size: 14px;">Nro. Carnet: 
          <b><?php echo $row['codigo_afiliado']; ?></b>
              <br>
              <br>
                Estado:  <?php if ($row['fecha_fin_de_vigencia'] == null) { echo " <b> Activo </b>"; }else{echo " <b> Baja </b>";} ?>
                
              </td>
      <td class="text-left"  style="font-size: 14px;">
              Cobertura Odontologica:<b> NULL </b>
              <br>
              <br>
              Plan Asist:
              <?php
              if ($row['cod_plan_asistencial'] != null) {
                echo "<b>".$row['cod_plan']." - ".$row['cod_plan_asistencial']."</b>";
              }else {
                echo "<b>".$row['cod_plan']."</b>";
              }
              ?>
              <br>
              <br>
              Fecha Alta: <?php echo " <b>".$row['fecha_alta']."</b>"; ?> 
            </td>
      <td class="text-left"  style="font-size: 14px;">Tipo Doc: 
              <?php
              /*$tipodoc = $row[21];
              $consul = "SELECT * FROM tipo_documento WHERE id=$tipodoc";
              $rs = pg_query($consul) or die('La consulta fallo: ' . pg_last_error());
              $fila = pg_fetch_array($rs, null, PGSQL_NUM);
              $id_documento = $fila[0];
              $desc_doc = $fila[1];
              
            if ($tipodoc == $id_documento) {
              echo " <b>".$desc_doc."</b>";
            }else {
              echo " <b>Documento no ingresado</b>";
            }*/
            ?>
            Tipo Documento: <b><?php echo $row['id_tipo_documento']; ?></b>
            <br>
            <br>
            Provincia: <?php echo " <b>".$row['cod_provincia']."</b>"; ?>
                <br>
                <br>
                Fecha de baja: <?php echo " <b>".$row['fecha_fin_de_vigencia']."</b>"; ?>
              </td>
      <td class="text-left"  style="font-size: 14px;">Nro. Doc: 
              <?php echo " <b>".$row['nro_documento']."</b>"; ?>
                <br>
                <br>
                Localidad: <b><?php echo $row['localidad']; ?></b>
              </td>
        </tr>
                </div>
              </div>
        <?php } } ?>
      </tbody>
    </table>
</div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="datatables.min.js"></script>
    <script>
      $(document).ready(function(){
    $('#myTable').DataTable({
       select: true,
       responsive: true,
       "language":{
       "sProcessing":     "Procesando...",
       "sLengthMenu":     "Mostrar _MENU_ registros",
       "sZeroRecords":    "No se encontraron resultados",
       "sEmptyTable":     "Ningún dato disponible en esta tabla",
       "sInfo":           "",
       "sInfoEmpty":      "",
       "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
       "sInfoPostFix":    "",
       "sSearch":         "Filtro:",
       "sUrl":            "",
       "sInfoThousands":  ",",
       "sLoadingRecords": "Cargando...",
       "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }}
    });
});
    </script>

  </body>
</html>
<!--?php } ?-->