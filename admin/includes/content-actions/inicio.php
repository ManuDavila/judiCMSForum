<?php 
if($_GET["action"] == "")
{
include_once "".$url_foro."admin/system/restricted.php";
?>
<h4><?php echo $inc_inicio_adm[0]; ?></h4>
<?php
$consulta = "SELECT COUNT(id_categoria) AS total_indices FROM categorias";
$resultado = $conexion -> query($consulta);
$fila = $resultado -> fetch_array();
$total_indices = $fila["total_indices"];

$consulta = "SELECT COUNT(id_subcategoria) AS total_subindices FROM subcategorias";
$resultado = $conexion -> query($consulta);
$fila = $resultado -> fetch_array();
$total_subindices = $fila["total_subindices"];

$consulta = "SELECT COUNT(id_tema) AS total_temas FROM temas";
$resultado = $conexion -> query($consulta);
$fila = $resultado -> fetch_array();
$total_temas = $fila["total_temas"];

$consulta = "SELECT COUNT(id_mensaje) AS total_mensajes FROM mensajes WHERE es_tema_principal='false'";
$resultado = $conexion -> query($consulta);
$fila = $resultado -> fetch_array();
$total_mensajes = $fila["total_mensajes"];

$consulta = "SELECT COUNT(id) AS total_usuarios FROM usuarios";
$resultado = $conexion -> query($consulta);
$fila = $resultado -> fetch_array();
$total_usuarios = $fila["total_usuarios"];

$consulta = "SELECT SUM(visitas) AS total_visitas FROM visitas";
$resultado = $conexion -> query($consulta);
$fila = $resultado -> fetch_array();
$total_visitas = $fila["total_visitas"];
?>

<table class="table table-bordered" style="width: 50%;">
<tr>
<td><?php echo $inc_inicio_adm[1]; ?>:</td><td><span class="label label-info"><?php echo $total_indices; ?></span></td>
</tr>
<tr>
<td><?php echo $inc_inicio_adm[2]; ?>:</td><td><span class="label label-info"><?php echo $total_subindices; ?></span></td>
</tr>
<tr>
<td><?php echo $inc_inicio_adm[3]; ?>:</td><td><span class="label label-info"><?php echo $total_temas; ?></span></td>
</tr>
<tr>
<td><?php echo $inc_inicio_adm[4]; ?>:</td><td><span class="label label-info"><?php echo $total_mensajes; ?></span></td>
</tr>
<tr>
<td><?php echo $inc_inicio_adm[5]; ?>:</td><td><span class="label label-info"><?php echo $total_usuarios; ?></span></td>
</tr>
<tr>
<td><?php echo $inc_inicio_adm[6]; ?>:</td><td><span class="label label-info"><?php echo $total_visitas; ?></span></td>
</tr>
</table>
<?php echo $inc_inicio_adm[7]; ?>
<br>
<?php echo $inc_inicio_adm[8]; ?>
<?php
}
?>