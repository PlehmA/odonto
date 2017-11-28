function deletePrestacion(id){
  if (window.confirm("¿Desea ELIMINAR la prestación seleccionada?")) {
    document.location.href = "deletePrestacion.php?id="+id;
  }
}