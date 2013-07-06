<?php
if ($_GET["action"] == "contacto")
{
if ($_SESSION["usuario"] != true)
{
?>
<div class="alert alert-info text-center">Para poder ponerte en contacto con el Administrador del Foro tienes que estar registrado.</div>
<center><a href="index.php?action=registro"><strong>Regístrate en el Foro</strong></a></center>
<?php
}
else
{
?>
<center>
<form method="post" id="form_contacto">
<label class='alert alert-info'><?php echo $_SESSION["nombre"]; ?> rellena la consulta:</label>
<textarea rows='8' style='width: 50%;' placeholder='Consulta' id='contacto' name='contacto'></textarea><label id='e_contacto'></label>
<button type="button" id="button_contacto" class="btn">Enviar</button>
</form>
</center>
<?php
}
}
?>