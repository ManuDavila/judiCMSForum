<?php 
if ($_GET["action"] == "ayuda")
{
?>
<center>
<strong>Estas en la secci�n de ayuda del foro.</strong>
<hr>
<ul style="width: 70%; text-align: left;">
<li>Para registrarte en el foro ve a la siguiente direcci�n <a href="index.php?action=registro">Registrarme</a></li>
<li>Para cambiar el avatar o ver los detalles de tu cuenta haz click en el bot�n superior derecho que te da la bienvenida</a></li>
<li>Si has olvidado tu password dir�gete a la siguiente direcci�n ... <a href="index.php?action=recuperar-1">Recuperar password</a></li>
<li>Si has introducido tus datos correctamente y no puedes iniciar sesi�n probablemente el moderador del foro haya eliminado tu cuenta debido a un 
comportamiento anormal de tu actividad en el foro.</a></li>
<li><a href="index.php?action=normas">Leer las normas del foro</a></li>
</ul>
</center>
<?php
}
?>