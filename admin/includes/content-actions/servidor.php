<?php
if ($_GET["action"] == "servidor")
{
restringido();
?>
<h3>Configuración del Servidor</h3>

	<div class="btn-group">
    <button class="btn" id="btn_ip">Bloquear acceso a ips</button>
    <button class="btn" id="btn_htaccess">Configurar .htaccess</button>
	<button class="btn" id="btn_antirobots">Antirobots</button>
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
<label><h4>Banear ips - Lista negra</h4></label>
<div class="alert alert-block">Jamás incluya la ip de su localhost -> 127.0.0.1 se estará impidiendo el acceso a su propio foro, y tendrá que eliminar la ip manualmente de la base de datos</div>
Algunas ips han podido ser bloqueadas automáticamente y aparecerán en esta lista.
<br>
Incluya la/s ip/s separándolas con comas. Ejemplo: 192.92.68.1, 192.169.23.3, ...
<br><br>
<textarea rows='8' style="width: 90%; font-family: 'Lucida Console'; font-size: 12px;" id='lista_negra' name='lista_negra'><?php echo $dark_list; ?></textarea>
<br><br>
<button type='submit' class='btn'>Aceptar</button>
<button type="button" class="btn" id="cerrar_ip"><span class=" icon-remove-circle"></span> Cerrar</button>
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
<span class="alert alert-success">Sólo para nombres de dominio para localhost no es necesario</span>
<br><br>
<form method="post">
<label><strong>Forzar solicitud con www o sin www</strong></label>
Con www <input type="radio" name="forzar_request" value="con" <?php if($www == "con"){echo "checked";} ?>> 
Sin www <input type="radio" name="forzar_request" value="sin" <?php if($www == "sin"){echo "checked";} ?>>
<br><br>
<label><strong>Forzar seguridad SSL (https)</strong></label>
<div class="alert alert-block">No modifique este parámetro si no está seguro de tener acceso al protoco SSL
puede provocar un error en su servidor y tendrá que modificar manualmente el archivo .htaccess</div>
No <input type="radio" name="forzar_ssl" value="no" <?php if($ssl == "no"){echo "checked";} ?>> 
Si <input type="radio" name="forzar_ssl" value="si" <?php if($ssl == "si") {echo "checked";} ?>>
<br><br>
<input type="hidden" name="htaccess">
<button type="submit" class="btn">Aceptar</button>
<button type="button" class="btn" id="cerrar_htaccess"><span class=" icon-remove-circle"></span> Cerrar</button>
</form>
</div>

<div id='box_antirobots'>
<br><br>
<form method="post" class="form-search">
<label style="text-align: justify;">Configuración para evitar la ejecución automática de robots en secciones importantes de la web, específique el máximo permitido/hora para cada visitante. Esto provoca 
que al llegar al máximo permitido aparecerá un mensaje de "NO ROBOTS" impidiendo que pueda seguir ejecutando el formulario, algunas secciones importantes como el 
inicio de sesión están configuradas para banear la ip una vez ha sido superado el límite permitido redireccionándolo a google, dicha ip aparecerá en el apartado 
"Bloquear acceso a ips".</label>

<h4>Ajustes del Foro</h4>
<table>
<tr>
<td style="text-align: right;">Formulario de registro:</td><td><input type="text" name="max_registro" class="input-small" value="<?php echo $max_registro; ?>"></td>
</tr>
<tr>
<td style="text-align: right;">Formulario activar cuenta:</td><td><input type="text" name="max_activar_cuenta" class="input-small" value="<?php echo $max_activar_cuenta; ?>"></td>
</tr>
<tr>
<td style="text-align: right;">Formulario iniciar sesión:</td><td><input type="text" name="max_iniciar_sesion" class="input-small" value="<?php echo $max_iniciar_sesion; ?>"></td>
</tr>
<tr>
<td style="text-align: right;">Formulario recuperar password:</td><td><input type="text" name="max_recuperar_password" class="input-small" value="<?php echo $max_recuperar_password; ?>"></td>
</tr>
<tr>
<td style="text-align: right;">Formulario activar password:</td><td><input type="text" name="max_activar_password" class="input-small" value="<?php echo $max_activar_password; ?>"></td>
</tr>
<tr>
<td style="text-align: right;">Formulario de contacto:</td><td><input type="text" name="max_contacto" class="input-small" value="<?php echo $max_contacto; ?>"></td>
</tr>
<tr>
<td style="text-align: right;">Max. temas de usuario:</td><td><input type="text" name="max_temas" class="input-small" value="<?php echo $max_temas; ?>"></td>
</tr>
<tr>
<td style="text-align: right;">Max. mensajes de usuario:</td><td><input type="text" name="max_mensajes" class="input-small" value="<?php echo $max_mensajes; ?>"></td>
</tr>
</table>
<br><br>
<h3>Ajustes del Panel de Administración Foro</h3>
<table>
<tr>
<td style="text-align: right;">Formulario iniciar sesión:</td><td><input type="text" name="max_iniciar_sesion_adm" class="input-small" value="<?php echo $max_iniciar_sesion_adm; ?>"></td>
</tr>
<tr>
<td style="text-align: right;">Formulario recuperar password:</td><td><input type="text" name="max_recuperar_password_adm" class="input-small" value="<?php echo $max_recuperar_password_adm; ?>"></td>
</tr>
<tr>
<td style="text-align: right;">Formulario activar password:</td><td><input type="text" name="max_activar_password_adm" class="input-small" value="<?php echo $max_activar_password_adm; ?>"></td>
</tr>
</table>
<input type="hidden" name="antirobots">
<br><br>
<button type="submit" class="btn">Aceptar</button>
<button type="button" class="btn" id="cerrar_antirobots"><span class=" icon-remove-circle"></span> Cerrar</button>
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

