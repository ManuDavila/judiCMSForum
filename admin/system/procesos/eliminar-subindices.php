<?php
if(isset($_POST["eliminar_subindices"]))
{
restringido();
foreach($_POST["item_a_eliminar"] as $campo => $valor){
if (preg_match("/^([0-9])+$/", $valor))
{
$consulta = "DELETE FROM mensajes WHERE id_subcategoria=$valor";
$resultado = $conexion ->query($consulta);

$consulta = "DELETE FROM temas WHERE id_subcategoria=$valor";
$resultado = $conexion ->query($consulta);

$consulta = "DELETE FROM subcategorias WHERE id_subcategoria=$valor";
$resultado = $conexion ->query($consulta);
}
}
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Tarea realizada con �xito</strong>
</div>";
}
?>