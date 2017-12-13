<?php 
$compSql ="SELECT nro_det_comp_entidad_liq_prest, tipo_comp, letra_comp, nro_pto_vta_comp, nro_comp FROM det_comp_entidad_liq_prest WHERE nro_lote_entidad_liq_prest=";
$compQuery = pg_query($con, $compSql);

?>