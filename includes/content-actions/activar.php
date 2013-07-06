<?php if ($_GET["action"] == "activar")
{
?>
    <form method="post" id="form_activar" action="">
    <fieldset>
    <legend>Activar la cuenta:</legend>
	<table class="table table-hover" style="width: auto;">
	<tr>
	<td class="text-right">Email:</td><td><input type="text" name="email" id="email" placeholder="Email"><label id="e_email"></label></td>
	</tr>
	<tr>
	<td class="text-right">Password:</td><td><input type="password" name="password" id="password" placeholder="Password"><label id="e_password"></label></td>
	</tr>
	<tr>
	<td class="text-right">Código de verificación:</td><td><input type="password" name="codigo_verificacion" id="codigo_verificacion" placeholder="Código de verificación"><label id="e_codigo_verificacion"></label></td>
	</tr>	
	</table>
    <button type="button" class="btn" id="button_activar">Activar cuenta</button>
	<input type="hidden" name="activar_usuario">
    </fieldset>
    </form>
	<div id="error"></div>
<?php
}
?>