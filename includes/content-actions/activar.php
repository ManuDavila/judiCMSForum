<?php if ($_GET["action"] == "activar")
{
?>
    <form method="post" id="form_activar" action="">
    <fieldset>
    <legend><?php echo $inc_activar[0]; ?>:</legend>
	<table class="table table-hover" style="width: auto;">
	<tr>
	<td class="text-right">Email:</td><td><input type="text" name="email" id="email" placeholder="Email"><label id="e_email"></label></td>
	</tr>
	<tr>
	<td class="text-right">Password:</td><td><input type="password" name="password" id="password" placeholder="Password"><label id="e_password"></label></td>
	</tr>
	<tr>
	<td class="text-right"><?php echo $inc_activar[1]; ?>:</td><td><input type="password" name="codigo_verificacion" id="codigo_verificacion" placeholder="<?php echo $inc_activar[1]; ?>"><label id="e_codigo_verificacion"></label></td>
	</tr>	
	</table>
    <button type="button" class="btn" id="button_activar"><?php echo $inc_activar[2]; ?></button>
	<input type="hidden" name="activar_usuario">
    </fieldset>
    </form>
	<div id="error"></div>
<?php
}
?>