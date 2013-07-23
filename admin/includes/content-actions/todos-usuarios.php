<?php
if ($_GET["action"] == "todos-usuarios")
{
include_once "".$url_foro."admin/system/restricted.php";

$intervalo_inicial = $_GET["intervalo_inicial"];
$intervalo_final = $_GET["intervalo_final"];
$orden = $_GET["orden"];

$consulta_nicks = "SELECT nick FROM usuarios";
$resultado_nicks = $conexion -> query($consulta_nicks);
while ($fila_nicks=$resultado_nicks->fetch_array())
{
$nicks .= '"'.$fila_nicks["nick"].'",';
}
$nicks .= '""';

?>
<h3><?php echo $inc_todos_usuarios_adm[0]; ?></h3>

<?php
$consulta_total = "SELECT COUNT(id) AS total_usuarios FROM usuarios";
$resultado_total = $conexion -> query ($consulta_total);
$fila_total = $resultado_total -> fetch_array();
$total_usuarios = $fila_total["total_usuarios"];
?>
<h4><?php echo $inc_todos_usuarios_adm[1]; ?>: <?php echo $total_usuarios; ?></h4>
<br>
<form method="get" id="form_id_usuario" class="form-search">
<input type="hidden" name="action" value="usuario">
<?php echo $inc_todos_usuarios_adm[2]; ?>: <input type="text" name="id_usuario" id="id_usuario" class="input-small" PlaceHolder="<?php echo $inc_todos_usuarios_adm[2]; ?>">
<button type="button" id="btn_id_usuario" class="btn"><?php echo $inc_todos_usuarios_adm[3]; ?></button> <label id="e_id_usuario"></label>
</form>
<form method="post" class="form-search">
<?php echo $inc_todos_usuarios_adm[4]; ?>: 
<input type="text" name="nick_usuario" id="nick_usuario" PlaceHolder="<?php echo $inc_todos_usuarios_adm[4]; ?>" data-provide="typeahead" data-source='[<?php echo $nicks; ?>]' data-items="8">
<button type="submit" id="btn_nick_usuario" class="btn"><?php echo $inc_todos_usuarios_adm[5]; ?></button> <label id="e_nick_usuario"></label>
</form>

<form method="get" class="form-search">
<input type="hidden" name="action" value="todos-usuarios">
<?php echo $inc_todos_usuarios_adm[6]; ?>: 
 Asc. <input type="radio" name="orden" value="ASC" <?php if($orden=="ASC"){echo "checked";} ?>> 
 Desc. <input type="radio" name="orden" value="DESC" <?php if($orden=="DESC"){echo "checked";} ?>>
<button type="submit" class="btn"><?php echo $inc_todos_usuarios_adm[3]; ?></button>
</form>

    <div class="btn-group">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    <?php echo $inc_todos_usuarios_adm[7]; ?>
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
	<li><a style="cursor: pointer;" id="eliminar_usuarios"><?php echo $inc_todos_usuarios_adm[8]; ?></a></li>
	<li><a style="cursor: pointer;" id="bloquearIP_usuarios"><?php echo $inc_todos_usuarios_adm[9]; ?></a></li>
	<li><a style="cursor: pointer;" id="enviarEmail_usuarios"><?php echo $inc_todos_usuarios_adm[10]; ?></a></li>
    </ul>
    </div>

	<button type="button" id="btn_marcar" onclick="marcar()" class="btn"><?php echo $inc_todos_usuarios_adm[11]; ?></button>
	<button type="button" id="btn_desmarcar" onclick="desmarcar()" class="btn"><?php echo $inc_todos_usuarios_adm[12]; ?></button>

	
    <form id="form_eliminar_usuarios" method="post">
	<input type='hidden' name='eliminar_usuarios'>
	</form>
	<form id="form_bloquearIP_usuarios" method="post">
	<input type='hidden' name='bloquearIP_usuarios'>
	</form>

<div id="box_usuarios">
 <table class="table table-bordered" style="width: 85%; font-size: 10px;">
<tr class="info">
<td><strong><?php echo $inc_todos_usuarios_adm[13]; ?></strong></td>
<td><strong><?php echo $inc_todos_usuarios_adm[14]; ?></strong></td>
<td><strong><?php echo $inc_todos_usuarios_adm[15]; ?></strong></td>
<td><strong><?php echo $inc_todos_usuarios_adm[16]; ?></strong></td>
<td><strong><?php echo $inc_todos_usuarios_adm[17]; ?></strong></td>
<td><strong><?php echo $inc_todos_usuarios_adm[18]; ?></strong></td>
<td><strong><?php echo $inc_todos_usuarios_adm[19]; ?></strong></td>
<td><strong><?php echo $inc_todos_usuarios_adm[20]; ?></strong></td>
<td><strong><?php echo $inc_todos_usuarios_adm[21]; ?></strong></td>
<td><strong><?php echo $inc_todos_usuarios_adm[22]; ?></strong></td>
<td><strong><?php echo $inc_todos_usuarios_adm[23]; ?></strong></td>
</tr>
 <?php
 //primero se hace la llamada al script
require("system/paginacion/paginacion.php");
// paginacion(conexion a la base de datos);
$paginacion = new paginacion($conexion);
$paginacion->contar_filas("SELECT COUNT(id) FROM usuarios ORDER BY id"); 
//tipo_resultados(numero de páginas, número de filas por página);
$paginacion->tipo_resultados(3, 10);
 
 $consulta = "SELECT * FROM usuarios ORDER BY id $orden LIMIT ".$_empezar_de_fila.", ".$_maximo_resultados_pagina."";
 $resultado = $conexion -> query($consulta);
 $x=0;
 while ($fila = $resultado -> fetch_array())
 {
 $id = $fila["id"];
 $email = $fila["email"];
 $nombre = $fila["nombre"];
 $apellidos = $fila["apellidos"];
 $nick = $fila["nick"];
 $avatar = $fila["avatar"];
 $leyenda = $fila["leyenda"];
 $activo = $fila["activo"];
 $ip = $fila["ip"];
 $fecha_registro = $fila["fecha_registro"];
 $fecha_registro = explode("-", $fecha_registro);
 $fecha_registro = $fecha_registro[2]."-".$fecha_registro[1]."-".$fecha_registro[0];
 ?>
<tr>
<td><?php echo $id; ?></td>
<td><?php echo $email; ?></td>
<td><?php echo $nombre; ?></td>
<td><?php echo $apellidos; ?></td>
<td><?php echo "<a href='../index.php?action=user&id_usuario=".$id."&query=verusuario' target='_blank'><span class='label label-important'>$nick <span class='icon-white icon-search'></span></span></a>"; ?></td>
<td><?php echo $activo; ?></td>
<td><?php echo $ip; ?></td>
<td><?php echo $fecha_registro; ?></td>
<td style="text-align: center;">
<?php
$consulta_mensajes = "SELECT COUNT(id_mensaje) AS total_mensajes FROM mensajes WHERE id_usuario=$id AND es_tema_principal='false'";
$resultado_mensajes =$conexion->query($consulta_mensajes);
$fila_mensajes=$resultado_mensajes->fetch_array();
$total_mensajes = $fila_mensajes["total_mensajes"];
echo "<a href='index.php?action=mensajes&id_usuario=$id'><span class='badge badge-success'>$total_mensajes</span> <span class='icon-edit'></span></a>";
?>
</td>
<td>
<?php
$consulta_temas = "SELECT COUNT(id_tema) AS total_temas FROM temas WHERE id_usuario=$id";
$resultado_temas =$conexion->query($consulta_temas);
$fila_temas=$resultado_temas->fetch_array();
$total_temas = $fila_temas["total_temas"];
echo "<a href='index.php?action=temas&id_usuario=$id'><span class='badge badge-success'>$total_temas</span> <span class='icon-edit'></span></a>";
?>
</td>
<td style='text-align: center;'>
<input type='checkbox' name='usuarios' value='<?php echo $id; ?>'>
<input type='hidden' name='email_usuarios[<?php echo $x; ?>]' value='<?php echo $email; ?>'>
</td>
</tr>
 <?php
 $x++;
}
?>
</table>

<?php
$consulta_todos_emails = "SELECT email FROM usuarios";
$resultado_todos_emails = $conexion -> query($consulta_todos_emails);
while($fila_todos_emails=$resultado_todos_emails->fetch_array())
{
$todos_emails .= $fila_todos_emails["email"].",";
}
$todos_emails = substr($todos_emails, 0, strlen($todos_emails)-1);
?>
  <div id='paginacion' class="btn-toolbar">
<div class="btn-group">
<?php
// paginas(id, parametros opcionales);
$paginacion->paginas("paginacion", "&action=todos-usuarios&orden=$orden");
?>
</div>
</div>
</div>

<div id="box_email">
<button type="button" class="btn" id="importar_emails"><span class="icon-plus"></span> <?php echo $inc_todos_usuarios_adm[24]; ?></button> 
<button type="button" class="btn" id="limpiar_emails"><span class="icon-minus"></span> <?php echo $inc_todos_usuarios_adm[25]; ?></button>
<button type="button" class="btn" id="cerrar_emails"><span class=" icon-remove-circle"></span> <?php echo $inc_todos_usuarios_adm[26]; ?></button>
<button type="button" id="ayuda_emails" data-toggle="tooltip" data-placement="bottom" title="<?php echo $usuarios_adm[33]; ?>" class="btn"><span class="icon-info-sign"></span> Info</button>
<br><br>
<form method='post' enctype="multipart/form-data">
<label><strong><?php echo $inc_todos_usuarios_adm[27]; ?></strong></label>
<table>
<tr>
<td style="text-align: right;"><?php echo $inc_todos_usuarios_adm[28]; ?>:</td><td style="width: 80%;"><input type='text' name='destinatarios' id='destinatarios' style='width: 80%;'></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $inc_todos_usuarios_adm[29]; ?>:</td><td><input type='text' name='asunto' id='asunto' placeholder='<?php echo $inc_todos_usuarios_adm[29]; ?>' style='width: 80%;'></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $inc_todos_usuarios_adm[30]; ?>:</td><td><input type='file' name='archivo1' id='archivo1'></td>
</tr>
</table>
<br>
<textarea rows='8' style="width: 90%; font-family: 'Lucida Console'; font-size: 10px;" placeholder='<?php echo $inc_todos_usuarios_adm[31]; ?>' id='mensaje' name='mensaje'></textarea>
<button type='submit' class='btn' style='font-size: 18px;'><?php echo $inc_todos_usuarios_adm[32]; ?></button>
<input type='hidden' id='todos_emails' value="<?php echo $todos_emails; ?>">
</form>
</div>
<script>
$(function(){
$("#box_email").hide();
$("#cerrar_emails").click(function()
{
$("#box_email").hide();
$("#box_usuarios").show();
});
$("#enviarEmail_usuarios").click(function(){
$("#box_email").show();
$("#box_usuarios").hide();
});
});
</script>
<?php
}
?>