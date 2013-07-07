<?php
if(isset($_POST["cerrar_temas"]))
{
restringido();
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
<strong>Tarea realizada con éxito</strong>
</div>";
}
?>