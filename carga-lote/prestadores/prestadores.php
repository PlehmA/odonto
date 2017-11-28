<?php 

include('../includes/dbconnect.php');

$prestasql = "SELECT * FROM prestador WHERE cuit='".$_SESSION['cuit']."'";

$prestaresult = pg_query($con, $prestasql);

$presta = pg_fetch_array($prestaresult, null, PGSQL_BOTH);

pg_close($con);
?>