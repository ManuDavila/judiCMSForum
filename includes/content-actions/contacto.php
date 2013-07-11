<?php
if ($_GET["action"] == "contacto")
{
if ($_SESSION["usuario"] != true)
{
?>
<div class="alert alert-info text-center"><?php echo $inc_contacto[0]; ?></div>
<center><a href="index.php?action=registro"><strong><?php echo $inc_contacto[1]; ?></strong></a></center>
<?php
}
else
{
?>
<center>
<form method="post" id="form_contacto">
<label class='alert alert-info'><?php echo $_SESSION["nombre"]; ?> <?php echo $inc_contacto[2]; ?>:</label>
<textarea rows='8' style='width: 50%;' placeholder='<?php echo $inc_contacto[2]; ?>' id='contacto' name='contacto'></textarea><label id='e_contacto'></label>
<button type="button" id="button_contacto" class="btn"><?php echo $inc_contacto[3]; ?></button>
</form>
</center>
<?php
}
}
?>