<?php
if(isset($_POST["nuevo_indice"]))
{
include_once "".$url_foro."admin/system/restricted.php";
$title = addslashes(htmlspecialchars($_POST["titulo"]));
$description = addslashes(htmlspecialchars($_POST["descripcion"]));
$keywords = addslashes(htmlspecialchars($_POST["keywords"]));
$consulta = "INSERT INTO categorias(categoria, title, description, keywords) VALUES ('$title', '$title', '$description', '$keywords')";
$resultado = $conexion->query($consulta);
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_nuevo_indice_adm[0]."</strong>
</div>";
}
?>