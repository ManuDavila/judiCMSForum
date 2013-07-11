<?php
if ($_GET["action"] == "editar-subindice")
{
include_once "".$url_foro."admin/system/restricted.php";
$id_subcategoria = $_GET["id_subcategoria"];
//Evitar inyección sql
if (!preg_match("/^([0-9])+$/", $id_subcategoria))
{
header("location: index.php");
exit();
}
$consulta = "SELECT id_categoria, title, description, keywords FROM subcategorias WHERE id_subcategoria=$id_subcategoria";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
$title = $fila["title"];
$description = $fila["description"];
$keywords = $fila["keywords"];
$id_categoria = $fila["id_categoria"];
?>
<div>
<form method='post' id='form_editar_subindice'>
<label><h4><?php echo $inc_editar_subindice_adm[0]; ?></h4></label>

<?php echo $inc_editar_subindice_adm[1]; ?>: <input type='text' name='titulo' id='titulo' style='width: 50%;' value="<?php echo $title; ?>"><label id='e_titulo'></label>

<?php echo $inc_editar_subindice_adm[2]; ?>:
<textarea rows='8' style='width: 90%;' id='descripcion' name='descripcion'><?php echo $description; ?></textarea><label id='e_descripcion'></label>

<?php echo $inc_editar_subindice_adm[3]; ?>: <input type='text' name='keywords' id='keywords' style='width: 50%;' value="<?php echo $keywords; ?>"><label id='e_keywords'></label>
<button type='button' id='button_editar_subindice' class='btn'><?php echo $inc_editar_subindice_adm[4]; ?></button>
<input type='hidden' name='editar_subindice' value="<?php echo $id_subcategoria; ?>">
<input type='hidden' name="id_categoria" value="<?php echo $id_categoria; ?>">
</form>
<a class='btn' href="index.php?action=subindice&id_categoria=<?php echo $id_categoria; ?>"><?php echo $inc_editar_subindice_adm[5]; ?></a>
</div>
<?php
}
?>