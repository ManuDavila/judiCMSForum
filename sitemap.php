<?php
header('Content-type: text/xml; charset="iso-8859-1"', true);
echo '<?xml version="1.0" encoding="iso-8859-1"?>';
include "system/conexion.php";
include "system/procesos/detalles-foro.php";
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<url>
  <loc><?php echo $url_foro; ?></loc>
</url>
  <?php
//categorias
$consulta = "SELECT * FROM categorias";
$resultado = $conexion->query($consulta);

 while ($fila = $resultado->fetch_array())
{

echo "
<url>
<loc>".$url_foro."index.php?action=categoria&amp;categoria=".$fila["id_categoria"]."</loc>
</url>
\n";
}

//subcategorias
$consulta = "SELECT * FROM subcategorias";
$resultado = $conexion->query($consulta);

 while ($fila = $resultado->fetch_array())
{
echo "
<url>
<loc>".$url_foro."index.php?action=temas&amp;categoria=".$fila["id_categoria"]."&amp;subcategoria=".$fila["id_subcategoria"]."</loc>
</url>
\n";
}

//temas
$consulta = "SELECT * FROM mensajes WHERE es_tema_principal='true'";
$resultado = $conexion->query($consulta);

 while ($fila = $resultado->fetch_array())
{
echo "
<url>
<loc>".$url_foro."index.php?action=tema&amp;categoria=".$fila["id_categoria"]."&amp;subcategoria=".$fila["id_subcategoria"]."&amp;tema=".$fila["id_tema"]."</loc>
</url>
\n";
}
?> 
</urlset>
