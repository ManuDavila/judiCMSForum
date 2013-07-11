<?php
if ($_GET["action"] == "servidor")
{
include_once "".$url_foro."admin/system/restricted.php";
?>
<h3><?php echo $inc_servidor_adm[0]; ?></h3>

	<div class="btn-group">
    <button class="btn" id="btn_ip"><?php echo $inc_servidor_adm[1]; ?></button>
    <button class="btn" id="btn_htaccess"><?php echo $inc_servidor_adm[2]; ?></button>
	<button class="btn" id="btn_antirobots"><?php echo $inc_servidor_adm[3]; ?></button>
    </div>
	
<?php
$consulta_ips = "SELECT ip FROM ip";
$resultado_ips = $conexion -> query($consulta_ips);
while($fila_ips = $resultado_ips -> fetch_array())
{
$dark_list .= $fila_ips["ip"].", ";
}
$dark_list = substr($dark_list, 0, -2);
?>


<div id='box_ip'>
<br>
<form method='post'>
<label><h4><?php echo $inc_servidor_adm[4]; ?></h4></label>
<div class="alert alert-info">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<?php echo $inc_servidor_adm[5]; ?>
</div>
<?php echo $inc_servidor_adm[6]; ?>
<br>
<?php echo $inc_servidor_adm[7]; ?>
<br><br>
<textarea rows='8' style="width: 90%; font-family: 'Lucida Console'; font-size: 12px;" id='lista_negra' name='lista_negra'><?php echo $dark_list; ?></textarea>
<br><br>
<button type='submit' class='btn'><?php echo $inc_servidor_adm[8]; ?></button>
<button type="button" class="btn" id="cerrar_ip"><span class=" icon-remove-circle"></span> <?php echo $inc_servidor_adm[9]; ?></button>
</form>
</div>

<div id='htaccess'>
<?php
$consulta_htaccess = "SELECT * FROM htaccess";
$resultado_htaccess = $conexion -> query($consulta_htaccess);
$fila_htaccess = $resultado_htaccess -> fetch_array();
$www = $fila_htaccess["www"];
$ssl = $fila_htaccess["ssl"];
?>
<br><br>
<div class="alert alert-info">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<?php echo $inc_servidor_adm[10]; ?>
</div>
<form method="post">
<label><strong><?php echo $inc_servidor_adm[11]; ?></strong></label>
<?php echo $inc_servidor_adm[12]; ?> <input type="radio" name="forzar_request" value="con" <?php if($www == "con"){echo "checked";} ?>> 
<?php echo $inc_servidor_adm[13]; ?> <input type="radio" name="forzar_request" value="sin" <?php if($www == "sin"){echo "checked";} ?>>
<br><br>
<label><strong><?php echo $inc_servidor_adm[14]; ?></strong></label>
<div class="alert alert-block"><?php echo $inc_servidor_adm[15]; ?></div>
<?php echo $inc_servidor_adm[16]; ?> <input type="radio" name="forzar_ssl" value="no" <?php if($ssl == "no"){echo "checked";} ?>> 
<?php echo $inc_servidor_adm[17]; ?> <input type="radio" name="forzar_ssl" value="si" <?php if($ssl == "si") {echo "checked";} ?>>
<br><br>
<input type="hidden" name="htaccess">
<button type="submit" class="btn"><?php echo $inc_servidor_adm[18]; ?></button>
<button type="button" class="btn" id="cerrar_htaccess"><span class=" icon-remove-circle"></span> <?php echo $inc_servidor_adm[19]; ?></button>
</form>
</div>

<div id='box_antirobots'>
<br><br>
<form method="post" class="form-search">
<div class="alert alert-info" style="text-align: justify;">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<?php echo $inc_servidor_adm[20]; ?>
</div>

<h4><?php echo $inc_servidor_adm[21]; ?></h4>
<table>
<tr>
<td style="text-align: right;"><?php echo $inc_servidor_adm[22]; ?>:</td><td><input type="text" name="max_registro" class="input-small" value="<?php echo $max_registro; ?>"></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $inc_servidor_adm[23]; ?>:</td><td><input type="text" name="max_activar_cuenta" class="input-small" value="<?php echo $max_activar_cuenta; ?>"></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $inc_servidor_adm[24]; ?>:</td><td><input type="text" name="max_iniciar_sesion" class="input-small" value="<?php echo $max_iniciar_sesion; ?>"></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $inc_servidor_adm[25]; ?>:</td><td><input type="text" name="max_recuperar_password" class="input-small" value="<?php echo $max_recuperar_password; ?>"></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $inc_servidor_adm[26]; ?>:</td><td><input type="text" name="max_activar_password" class="input-small" value="<?php echo $max_activar_password; ?>"></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $inc_servidor_adm[27]; ?>:</td><td><input type="text" name="max_contacto" class="input-small" value="<?php echo $max_contacto; ?>"></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $inc_servidor_adm[28]; ?>:</td><td><input type="text" name="max_temas" class="input-small" value="<?php echo $max_temas; ?>"></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $inc_servidor_adm[29]; ?>:</td><td><input type="text" name="max_mensajes" class="input-small" value="<?php echo $max_mensajes; ?>"></td>
</tr>
</table>
<br><br>
<h3><?php echo $inc_servidor_adm[30]; ?></h3>
<table>
<tr>
<td style="text-align: right;"><?php echo $inc_servidor_adm[31]; ?>:</td><td><input type="text" name="max_iniciar_sesion_adm" class="input-small" value="<?php echo $max_iniciar_sesion_adm; ?>"></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $inc_servidor_adm[32]; ?>:</td><td><input type="text" name="max_recuperar_password_adm" class="input-small" value="<?php echo $max_recuperar_password_adm; ?>"></td>
</tr>
<tr>
<td style="text-align: right;"><?php echo $inc_servidor_adm[33]; ?>:</td><td><input type="text" name="max_activar_password_adm" class="input-small" value="<?php echo $max_activar_password_adm; ?>"></td>
</tr>
</table>
<input type="hidden" name="antirobots">
<br><br>
<button type="submit" class="btn"><?php echo $inc_servidor_adm[34]; ?></button>
<button type="button" class="btn" id="cerrar_antirobots"><span class=" icon-remove-circle"></span> <?php echo $inc_servidor_adm[35]; ?></button>
</form>
</div>

<script>
$(function()
{

$("#htaccess").hide();
$("#btn_htaccess").click(function(){
$("#htaccess").show();
$("#box_ip").hide();
$("#box_antirobots").hide();
});

$("#box_ip").hide();
$("#btn_ip").click(function(){
$("#box_ip").show();
$("#htaccess").hide();
$("#box_antirobots").hide();
});

$("#box_antirobots").hide();
$("#btn_antirobots").click(function(){
$("#box_antirobots").show();
$("#htaccess").hide();
$("#box_ip").hide();
});

$("#cerrar_ip").click(function()
{
$("#box_ip").hide();
});

$("#cerrar_htaccess").click(function()
{
$("#htaccess").hide();
});

$("#cerrar_antirobots").click(function()
{
$("#box_antirobots").hide();
});

});
</script>
<?php
}
?>

