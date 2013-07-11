<?php 
if (isset($_POST["editar_indice"]))
{
include_once "".$url_foro."admin/system/restricted.php";
$id_categoria = addslashes(htmlspecialchars(strip_tags($_POST["editar_indice"])));
$title = addslashes(htmlspecialchars($_POST["titulo"]));
$description = addslashes(htmlspecialchars($_POST["descripcion"]));
$keywords = addslashes(htmlspecialchars($_POST["keywords"]));

if (!preg_match("/^([0-9])+$/", $id_categoria))
{
header("location: index.php");
exit();
}
$consulta = "UPDATE categorias SET categoria='$title', title='$title', description='$description', keywords='$keywords' WHERE id_categoria=$id_categoria";
$resultado = $conexion->query($consulta);
header("location: index.php?action=indice");
exit();
}
?>