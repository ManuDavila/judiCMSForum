<?php
if ($_GET["action"] == "editar-indice")
{
include_once "".$url_foro."admin/system/restricted.php";
$id_categoria = $_GET["id_categoria"];
//Evitar inyección sql
if (!preg_match("/^([0-9])+$/", $id_categoria))
{
header("location: index.php");
exit();
}
$consulta = "SELECT title, description, keywords FROM categorias WHERE id_categoria=$id_categoria";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
$title = $fila["title"];
$description = $fila["description"];
$keywords = $fila["keywords"];
?>
<div>
<form method='post' id='form_editar_indice'>
<label><h4><?php echo $inc_editar_indice_adm[0]; ?></h4></label>
<?php echo $inc_editar_indice_adm[1]; ?>: <input type='text' name='titulo' id='titulo' style='width: 50%;' value="<?php echo $title; ?>"><label id='e_titulo'></label>
<?php echo $inc_editar_indice_adm[2]; ?>:
<textarea rows='8' style='width: 90%;' id='descripcion' name='descripcion'><?php echo $description; ?></textarea><label id='e_descripcion'></label>
<?php echo $inc_editar_indice_adm[3]; ?>: <input type='text' name='keywords' id='keywords' style='width: 50%;' value="<?php echo $keywords; ?>"><label id='e_keywords'></label>
<button type='button' id='button_editar_indice' class='btn'><?php echo $inc_editar_indice_adm[4]; ?></button>
<input type='hidden' name='editar_indice' value="<?php echo $id_categoria; ?>">
</form>
<a class='btn' href="index.php?action=indice"><?php echo $inc_editar_indice_adm[5]; ?></a>
</div>
<?php
}
?>