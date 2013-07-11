<?php
if(isset($_POST["eliminar_temas"]))
{
include_once "".$url_foro."admin/system/restricted.php";
foreach($_POST["item_a_eliminar"] as $campo => $valor){
if (preg_match("/^([0-9])+$/", $valor))
{
$consulta = "DELETE FROM mensajes WHERE id_tema=$valor";
$resultado = $conexion ->query($consulta);

$consulta = "DELETE FROM temas WHERE id_tema=$valor";
$resultado = $conexion ->query($consulta);
}
}
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_eliminar_temas_adm[0]."</strong>
</div>";
}
?>