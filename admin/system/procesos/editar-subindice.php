<?php 
if (isset($_POST["editar_subindice"]))
{
session_start();
if ($_SESSION["admin"] != true)
{
header("location: admin.php");
exit();
}

$id_subcategoria = addslashes(htmlspecialchars(strip_tags($_POST["editar_subindice"])));

$consulta = "SELECT id_categoria FROM subcategorias WHERE id_subcategoria=$id_subcategoria";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
$id_categoria = $fila["id_categoria"];

$title = addslashes(htmlspecialchars($_POST["titulo"]));
$description = addslashes(htmlspecialchars($_POST["descripcion"]));
$keywords = addslashes(htmlspecialchars($_POST["keywords"]));

//Evitar inyección sql
if (!preg_match("/^([0-9])+$/", $id_subcategoria))
{
header("location: index.php");
exit();
}
$consulta = "UPDATE subcategorias SET subcategoria='$title', title='$title', description='$description', keywords='$keywords' WHERE id_subcategoria=$id_subcategoria";
$resultado = $conexion->query($consulta);
header("location: index.php?action=subindice&id_categoria=$id_categoria");
exit();
}
?>