<?php
if(isset($_POST["eliminar_indices"]))
{
include_once "".$url_foro."admin/system/restricted.php";
foreach($_POST["item_a_eliminar"] as $campo => $valor){
if (preg_match("/^([0-9])+$/", $valor))
{
$consulta = "DELETE FROM mensajes WHERE id_categoria=$valor";
$resultado = $conexion ->query($consulta);

$consulta = "DELETE FROM temas WHERE id_categoria=$valor";
$resultado = $conexion ->query($consulta);

$consulta = "DELETE FROM subcategorias WHERE id_categoria=$valor";
$resultado = $conexion ->query($consulta);

$consulta = "DELETE FROM categorias WHERE id_categoria=$valor";
$resultado = $conexion ->query($consulta);
}
}
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_eliminar_indices_adm[0]."</strong>
</div>";
}
?>