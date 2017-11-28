<?php

$afisql = "SELECT * FROM tmp_carga_afi_".$_SESSION['nro_documento'];

$afiresult = pg_query($afisql);

 ?>