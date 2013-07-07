<?php
if (isset($_POST["theme"]))
{
restringido();
$theme = htmlspecialchars($_POST["theme"]);
$consulta = "UPDATE detalles_foro SET theme='$theme'";
$resultado = $conexion -> query($consulta);
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>¡Tema cambiado con éxito! espere un momento, aplicando estilos ...</strong>
</div>";
?>
<meta http-equiv="refresh" content="3;URL=index.php?action=themes">
<?php
}
?>