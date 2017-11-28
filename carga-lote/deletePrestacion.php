<?php
session_start();
  header('Content-Type: text/html;charset=utf-8');
  include_once 'includes/dbconnect.php';
  if (isset($_GET['id'])) {
    $codEliminar = $_GET['id'];
    $sql = "DELETE FROM tmp_carga_prest_".$_SESSION['cuit']." WHERE id=".$codEliminar;
    $result = pg_query($con, $sql);
    header("Location: totalprestaciones.php");
  }
 ?>