<?php
if (isset($_POST["guardar_leyenda"]))
{
include_once "".$url_foro."system/restricted.php";
$leyenda = addslashes(htmlspecialchars($_POST["guardar_leyenda"]));
if (strlen($leyenda) > 50)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_guardar_leyenda[0]."</strong>
</div>";
return;
}
$consulta = "UPDATE usuarios SET leyenda='$leyenda' WHERE id=".$_SESSION["id"]."";
$resultado = $conexion ->query($consulta);
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_guardar_leyenda[1]."</strong>
</div>";
}
?>