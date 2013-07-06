<?php if ($_GET["action"] == "recuperar-2")
{
?>
    <form method="post" id="form_recuperar_2" action="">
    <fieldset>
    <legend>Recuperar password:</legend>
	<table class="table table-hover" style="width: auto;">
	<td class="text-right">Email:</td><td><input type="text" name="email" id="email" placeholder="Email"><label id="e_email"></label></td>
	</tr>
	<tr>
	<td class="text-right">Nuevo Password:</td><td><input type="password" name="password" id="password" placeholder="Password"><label id="e_password"></label></td>
	</tr>
    <tr>
	<td class="text-right">Repetir Password:</td><td><input type="password" name="repetir_password" id="repetir_password" placeholder="Repetir password"><label id="e_repetir_password"></label></td>
	</tr>
	<tr>
	<td class="text-right">Código de verificación:</td><td><input type="password" name="codigo_verificacion" id="codigo_verificacion" placeholder="Código de verificación"><label id="e_codigo_verificacion"></label></td>
	</tr>	
	</table>
    <button type="button" class="btn" id="button_recuperar_2">Enviar</button>
	<input type="hidden" name="recuperar_password_2">
    </fieldset>
    </form>
	<div id="error"></div>
<?php
}
?>