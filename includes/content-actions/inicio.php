<?php 
if ($_GET["action"] == "" || $_GET["action"] == "inicio")
{
?>
<?php
$consulta_categoria = "SELECT * FROM categorias";
$resultado_categoria = $conexion->query($consulta_categoria);
while($fila_categoria=$resultado_categoria->fetch_array())
{
?>
    <table class="table table-bordered" style="width: 90%;">
   <tr>
   <td style="width: 25%;"><?php echo "<a href='index.php?action=categoria&categoria=".$fila_categoria["id_categoria"]."'><strong style='font-size: 18px;'>".$fila_categoria["categoria"]; ?></strong></a></td>
   <td><strong>TEMAS</strong></td>
   <td><strong>MENSAJES</strong></td>
   <td style="width: 60%;"><strong>ÚLTIMO MENSAJE</strong></td>
   </tr>
   <?php
   $consulta_subcategoria = "SELECT * FROM subcategorias WHERE id_categoria=".$fila_categoria["id_categoria"]."";
   $resultado_subcategoria = $conexion -> query($consulta_subcategoria);
   $x=0;
   while ($fila_subcategoria=$resultado_subcategoria->fetch_array())
   {
   ?>
    <tr>
   <td><strong><a href="index.php?action=temas&categoria=<?php echo $fila_subcategoria["id_categoria"]; ?>&subcategoria=<?php echo $fila_subcategoria["id_subcategoria"]; ?>"><?php echo $fila_subcategoria["subcategoria"]; ?></a></strong></td>
   <td style="text-align: center;">
   <span class='label label-success'>
   <?php
   $consulta_total_temas = "SELECT COUNT(id_tema) as total_temas FROM temas WHERE id_categoria=".$fila_categoria["id_categoria"]." AND id_subcategoria=".$fila_subcategoria["id_subcategoria"]."";
   $resultado_total_temas = $conexion->query($consulta_total_temas);
   $fila_total_temas = $resultado_total_temas -> fetch_array();
   $total_temas = $fila_total_temas["total_temas"];
   echo $total_temas;
   ?>
   </span>
   </td>
   <td style="text-align: center;">
   <span class='label label-success'>
   <?php
   $consulta_total_mensajes = "SELECT COUNT(id_mensaje) as total_mensajes FROM mensajes WHERE id_categoria=".$fila_categoria["id_categoria"]." AND id_subcategoria=".$fila_subcategoria["id_subcategoria"]." AND es_tema_principal='false'";
   $resultado_total_mensajes = $conexion->query($consulta_total_mensajes);
   $fila_total_mensajes = $resultado_total_mensajes -> fetch_array();
   $total_mensajes = $fila_total_mensajes["total_mensajes"];
   echo $total_mensajes;
   ?>
   </span>
   </td>
   <td> 
   <?php
   $consulta_ultimo_msg = "SELECT * FROM mensajes WHERE id_mensaje='".$fila_subcategoria["id_ultimo_mensaje"]."'";
   $resultado_ultimo_msg = $conexion->query($consulta_ultimo_msg);
   $fila_ultimo_msg = $resultado_ultimo_msg->fetch_array();
   if ($fila_ultimo_msg == 0)
   {
    $content_tema = "<span class='label label-info'>Aun no hay temas que mostrar</span>";
   }
   else
   {
   $consulta_user = "SELECT * FROM usuarios WHERE id='".$fila_ultimo_msg["id_usuario"]."'";
   $resultado_user = $conexion->query($consulta_user);
   $fila_user = $resultado_user->fetch_array();
   $nombre_autor = "<a href='index.php?action=user&id_usuario=".$fila_user["id"]."&query=verusuario'><span class='label label-important'>".$fila_user["nick"]."</span></a>";
   $content_tema = "".$nombre_autor." en el tema <span class='icon-arrow-right'></span> <a id='text-overflow-$x' href='index.php?action=tema&categoria=".$fila_categoria["id_categoria"]."&subcategoria=".$fila_subcategoria["id_subcategoria"]."&tema=".$fila_ultimo_msg["id_tema"]."'>".$fila_ultimo_msg["tema"]."</a>";
   if($fila_user["nick"] == "")
   {
   $nombre_autor = "<span class='label label-important'>Ya no pertenece al foro</span>";
   }
   }
echo $content_tema;
   ?>
   </td>
   </tr>
         <script type='text/javascript'>
   $(function()
   {
   text_ellipsis('#text-overflow-<?php echo $x; ?>', 60);
   });
   </script>
   <?php
   $x++;
   }
   ?>
    </table>
	<?php
	}
	?>
<?php
}
?>