<?php
if(isset($_POST["cerrar_temas"]))
{
include_once "".$url_foro."admin/system/restricted.php";
foreach($_POST["item_a_cerrar"] as $campo => $valor){
if (preg_match("/^([0-9])+$/", $valor))
{
$consulta = "UPDATE temas SET tema_cerrado='true' WHERE id_tema=$valor";
$resultado = $conexion ->query($consulta);
}
}
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$cerrar_temas_adm[0]."</strong>
</div>";
}
?>