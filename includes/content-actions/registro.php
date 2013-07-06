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
    <legend>Regístrate en el Foro:</legend>
	<table class="table table-hover" style="width: auto;">
	<tr>
	<td class="text-right">Nick de usuario:</td><td><input type="text" name="nick" id="nick" placeholder="Nick de usuario"><label id="e_nick"></label></td>
	</tr>
	<tr>
    <td class="text-right">Nombre:</td><td><input type="text" name="nombre" id="nombre" placeholder="Nombre"><label id="e_nombre"></label></td>
	</tr>
	<tr>
	<td class="text-right">Primer apellido:</td><td><input type="text" name="apellido_1" id="apellido_1" placeholder="Segundo apellido"><label id="e_apellido_1"></label></td>
	</tr>
	<tr>
	<td class="text-right">Segundo apellido:</td><td><input type="text" name="apellido_2" id="apellido_2" placeholder="Primer apellido"><label id="e_apellido_2"></label></td>
	</tr>
	<tr>
	<td class="text-right">Sexo:</td><td><label class="radio"><input type="radio" name="sexo" value="chico" checked> Hombre</label><label class="radio"><input type="radio" name="sexo" value="chica"> Mujer</label></td>
	</tr>
	<tr>
	<td class="text-right">Email:</td><td><input type="text" name="email" id="email" placeholder="Email"><label id="e_email"></label></td>
	</tr>
	<tr>
	<td class="text-right">Password:</td><td><input type="password" name="password" id="password" placeholder="Password"><label id="e_password"></label></td>
	</tr>
	<tr>
	<td class="text-right">Repetir password:</td><td><input type="password" name="repetir_password" id="repetir_password" placeholder="Repetir password"><label id="e_repetir_password"></label></td>
	</tr>	
	</table>
	<a href="index.php?action=normas">Acepto las normas:</a> <input type="checkbox" id="terminos" name="terminos">
	<label id="e_terminos"></label>
	<br><br>
    <button type="button" class="btn" id="button_registrarse">Registrarme</button>
	<input type="hidden" name="registrar_usuario">
    </fieldset>
    </form>
	<div id="error"></div>
<?php
}
?>