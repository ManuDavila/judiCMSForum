<?php 
if (isset($_POST["editar_indice"]))
{
session_start();
if ($_SESSION["admin"] != true)
{
header("location: admin.php");
exit();
}

$id_categoria = addslashes(htmlspecialchars(strip_tags($_POST["editar_indice"])));
$title = addslashes(htmlspecialchars($_POST["titulo"]));
$description = addslashes(htmlspecialchars($_POST["descripcion"]));
$keywords = addslashes(htmlspecialchars($_POST["keywords"]));

//Evitar inyecci�n sql
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