<?php if ($_GET["action"] == "registro")
{
if ($_SESSION["usuario"] == true)
{
header("location: index.php");
exit();
}
?>
    <form method="post" id="form_nick">
	<input type="hidden" id="check_nick" name="check_nick">
	</form>
    <form method="post" id="form_registrarse" action="">
    <fieldset>
    <legend><?php echo $inc_registro[0]; ?>:</legend>
	<table class="table table-hover" style="width: auto;">
	<tr>
	<td class="text-right"><?php echo $inc_registro[1]; ?>:</td><td><input type="text" name="nick" id="nick" placeholder="<?php echo $inc_registro[1]; ?>"><label id="e_nick"></label></td>
	</tr>
	<tr>
    <td class="text-right"><?php echo $inc_registro[2]; ?>:</td><td><input type="text" name="nombre" id="nombre" placeholder="<?php echo $inc_registro[2]; ?>"><label id="e_nombre"></label></td>
	</tr>
	<tr>
	<td class="text-right"><?php echo $inc_registro[3]; ?>:</td><td><input type="text" name="apellidos" id="apellidos" placeholder="<?php echo $inc_registro[3]; ?>"><label id="e_apellidos"></label></td>
	</tr>
	<tr>
	<td class="text-right"><?php echo $inc_registro[5]; ?>:</td><td><label class="radio"><input type="radio" name="sexo" value="chico" checked> <?php echo $inc_registro[6]; ?></label><label class="radio"><input type="radio" name="sexo" value="chica"> <?php echo $inc_registro[7]; ?></label></td>
	</tr>
	<tr>
	<td class="text-right">Email:</td><td><input type="text" name="email" id="email" placeholder="Email"><label id="e_email"></label></td>
	</tr>
	<tr>
	<td class="text-right">Password:</td><td><input type="password" name="password" id="password" placeholder="Password"><label id="e_password"></label></td>
	</tr>
	<tr>
	<td class="text-right"><?php echo $inc_registro[8]; ?>:</td><td><input type="password" name="repetir_password" id="repetir_password" placeholder="<?php echo $inc_registro[8]; ?>"><label id="e_repetir_password"></label></td>
	</tr>	
	</table>
	<a href="index.php?action=normas"><?php echo $inc_registro[9]; ?>:</a> <input type="checkbox" id="terminos" name="terminos">
	<label id="e_terminos"></label>
	<br><br>
    <button type="button" class="btn" id="button_registrarse"><?php echo $inc_registro[10]; ?></button>
	<input type="hidden" name="registrar_usuario">
    </fieldset>
    </form>
	<div id="error"></div>
<?php
}
?>