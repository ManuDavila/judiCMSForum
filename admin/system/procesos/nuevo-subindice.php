<?php
if(isset($_POST["nuevo_subindice"]))
{
restringido();
$id_categoria = $_POST["id_categoria"];
$title = addslashes(htmlspecialchars($_POST["titulo"]));
$description = addslashes(htmlspecialchars($_POST["descripcion"]));
$keywords = addslashes(htmlspecialchars($_POST["keywords"]));
$consulta = "INSERT INTO subcategorias(id_categoria, subcategoria, title, description, keywords) VALUES ('$id_categoria', '$title', '$title', '$description', '$keywords')";
$resultado = $conexion->query($consulta);
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Tarea realizada con éxito</strong>
</div>";
}
?>