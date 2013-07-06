<?php
header('Content-type: text/xml; charset="iso-8859-1"', true);
echo '<?xml version="1.0" encoding="iso-8859-1"?>';
include "system/conexion.php";
include "system/procesos/detalles-foro.php";
?>
<rss version="2.0">
<channel>
<title><?php echo $title_foro; ?></title>
<description><?php echo $description_foro; ?></description>
<link><?php echo $url_foro; ?></link>
<lastBuildDate><?php echo date('r') ?> </lastBuildDate>

<?php

//categorias
$consulta = "SELECT * FROM categorias";
$resultado = $conexion->query($consulta);

 while ($fila = $resultado->fetch_array())
{
echo "<item>\n";
echo "<title>".$fila["title"]."</title>\n";
echo "<description>".strip_tags($fila["description"])."</description>\n";
echo "<link>".$url_foro."index.php?action=categoria&amp;categoria=".$fila["id_categoria"]."</link>\n";
    echo "</item>\n";
}

//subcategorias
$consulta = "SELECT * FROM subcategorias";
$resultado = $conexion->query($consulta);

 while ($fila = $resultado->fetch_array())
{
echo "<item>\n";
echo "<title>".$fila["title"]."</title>\n";
echo "<description>".strip_tags($fila["description"])."</description>\n";
echo "<link>".$url_foro."index.php?action=temas&amp;categoria=".$fila["id_categoria"]."&amp;subcategoria=".$fila["id_subcategoria"]."</link>\n";
    echo "</item>\n";
}

//temas
$consulta = "SELECT * FROM mensajes WHERE es_tema_principal='true'";
$resultado = $conexion->query($consulta);

 while ($fila = $resultado->fetch_array())
{
echo "<item>\n";
echo "<title>".$fila["tema"]."</title>\n";
echo "<description>".strip_tags($fila["mensaje"])."</description>\n";
echo "<link>".$url_foro."index.php?action=tema&amp;categoria=".$fila["id_categoria"]."&amp;subcategoria=".$fila["id_subcategoria"]."&amp;tema=".$fila["id_tema"]."</link>\n";
    echo "</item>\n";
}
?>
</channel>
</rss>