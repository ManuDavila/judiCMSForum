<?php if ($_GET["action"] == "recuperar-1")
{
?>
    <form method="post" id="form_recuperar_1" action="">
    <fieldset>
    <legend><?php echo $inc_recuperar_password_1[0]; ?>:</legend>
	<table class="table table-hover" style="width: auto;">
	<tr>
	<td class="text-right">Email:</td><td><input type="text" name="email" id="email" placeholder="Email"><label id="e_email"></label></td>
	</tr>	
	</table>
    <button type="button" class="btn" id="button_recuperar_1"><?php echo $inc_recuperar_password_1[0]; ?></button>
	<input type="hidden" name="recuperar_password_1">
    </fieldset>
    </form>
	<div id="error"></div>
<?php
}
?>