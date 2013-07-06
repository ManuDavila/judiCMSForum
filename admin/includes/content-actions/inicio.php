<?php 
if($_GET["action"] == "")
{
session_start();
if ($_SESSION["admin"] != true)
{
header("location: admin.php");
exit();
}
?>
<h4>Algunas estadísticas del foro ...</h4>
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
<td>Total de Índices:</td><td><span class="label label-info"><?php echo $total_indices; ?></span></td>
</tr>
<tr>
<td>Total de Subíndices:</td><td><span class="label label-info"><?php echo $total_subindices; ?></span></td>
</tr>
<tr>
<td>Total de Temas:</td><td><span class="label label-info"><?php echo $total_temas; ?></span></td>
</tr>
<tr>
<td>Total de Mensajes:</td><td><span class="label label-info"><?php echo $total_mensajes; ?></span></td>
</tr>
<tr>
<td>Total de Usuarios:</td><td><span class="label label-info"><?php echo $total_usuarios; ?></span></td>
</tr>
<tr>
<td>Total de páginas vistas:</td><td><span class="label label-info"><?php echo $total_visitas; ?></span></td>
</tr>
</table>

Para descargar nuevos temas para tu foro ve a la siguiente dirección ... <a href="http://www.judicms.com/index.php?action=buscar-themes" target="_blank">THEMES</a>
<br>
También puedes colaborar o participar ayudando a mejorar <strong>JUDI CMS FORUM</strong>, enviando reportes o mejoras en el <a href="http://www.judicms.com/" target="_blank">foro oficial</a>

<?php
}
?>