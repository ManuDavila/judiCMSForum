<?php
if(isset($_POST["eliminar_mensaje"]))
{
include_once "".$url_foro."admin/system/restricted.php";
foreach($_POST["item_eliminar_mensaje"] as $campo => $valor){
if (preg_match("/^([0-9])+$/", $valor))
{
$consulta = "DELETE FROM mensajes WHERE id_mensaje=$valor";
$resultado = $conexion ->query($consulta);
}
}
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_eliminar_mensaje_adm[0]."</strong>
</div>";
}
?>