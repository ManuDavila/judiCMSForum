<?php
session_start();
if ($_SESSION["usuario"] == true)
{
$session = "
<form method='post' class='navbar-form pull-right'>
<button type='submit' class='btn'>
<i class='icon-off icon-grey'></i></button>
<input type='hidden' name='exit'>
</form>

<form method='get' class='navbar-form pull-right'>
<button type='submit' class='btn'>
<i class='icon-user icon-grey'></i>Bienvenid@ ".$_SESSION["nombre"]."
</button>
<input type='hidden' name='action' value='panel-usuario'>
</form>
";

$formularios_temas = "<div id='comandos'><button id='button_comentar' class='btn btn-primary' data-toggle='modal' style='margin-right: 20px;' data-target='#myModalC'>COMENTAR ESTE TEMA</button><button type='button' class='btn btn-inverse' data-toggle='modal' data-target='#myModal'>CREAR UN NUEVO TEMA</button></div>";
$formularios_temas .= 
"<div id='myModal' class='modal hide fade' style='top: 0px;' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-body'>
<br>
<form method='post' id='form_nuevo_tema'>
<label><strong>Crear un nuevo Tema</strong></label>
Título: <input type='text' name='titulo' id='titulo' placeholder='Título' style='width: 80%;'><label id='e_titulo'></label>
    <div class='btn-toolbar'>
    <div class='btn-group'>
<button type='button' id='add_image' class='btn'><span class='icon-picture'></span></button>
<button type='button' id='add_url' class='btn'><span class='icon-link'></span></button>
    </div>
    </div>
	<div id='box_image' style='display: none;'><input type='text' id='imagen' style='width: 50%;' placeholder='Url de la imagen'><br><button type='button' class='ok btn'>ok</button><br><br></div>
    <div id='box_url' style='display: none;'><input type='text' id='url' style='width: 50%;' placeholder='Url de la Web'><br><button type='button' class='ok btn'>ok</button><br><br></div>
	
	<span class='label label-success' id='label-imagen'></span>
	<span class='label label-success' id='label-url'></span>
	
	<textarea rows='8' style='width: 90%;' placeholder='Comentario' id='comentario' name='comentario'></textarea><label id='e_comentario'></label>

<button type='button' id='button_nuevo_tema' class='btn' style='font-size: 18px;'>Crear tema</button>
<input type='hidden' name='_imagen' id='_imagen'>
<input type='hidden' name='_url' id='_url'>
<input type='hidden' name='categoria' value='".$_GET["categoria"]."'>
<input type='hidden' name='subcategoria' value='".$_GET["subcategoria"]."'>
<input type='hidden' name='nuevo_tema'>
</form>
</div>
<div class='modal-footer'>
<button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
</div>
</div>
";

$formularios_temas .= 
"
<div id='myModalC' class='modal hide fade' style='top: 0px;' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-body'>
<br><br>
<form method='post' id='form_nuevo_comentario'>
<label><strong>Añadir un nuevo comentario</strong></label>
<input type='hidden' name='tituloC' id='tituloC' value='".$_GET["tema"]."'>
    <div class='btn-toolbar'>
    <div class='btn-group'>
<button type='button' id='add_imageC' class='btn'><span class='icon-picture'></span></button>
<button type='button' id='add_urlC' class='btn'><span class='icon-link'></span></button>
    </div>
    </div>
	<div id='box_imageC' style='display: none;'><input type='text' id='imagenC' style='width: 50%;' placeholder='Url de la imagen'><br><button type='button' class='ok btn'>ok</button><br><br></div>
    <div id='box_urlC' style='display: none;'><input type='text' id='urlC' style='width: 50%;' placeholder='Url de la Web'><br><button type='button' class='ok btn'>ok</button><br><br></div>
	
	<span class='label label-success' id='label-imagenC'></span>
	<span class='label label-success' id='label-urlC'></span>
	
	<textarea rows='8' style='width: 90%;' placeholder='Comentario' id='comentarioC' name='comentarioC'></textarea><label id='e_comentarioC'></label>

<button type='button' id='button_nuevo_comentario' class='btn' style='font-size: 18px;'>Añadir comentario</button>
<input type='hidden' name='_imagenC' id='_imagenC'>
<input type='hidden' name='_urlC' id='_urlC'>
<input type='hidden' name='categoriaC' value='".$_GET["categoria"]."'>
<input type='hidden' name='subcategoriaC' value='".$_GET["subcategoria"]."'>
<input type='hidden' name='nuevo_comentario'>
</form>
</div>
<div class='modal-footer'>
<button class='btn' data-dismiss='modal' aria-hidden='true'>Cerrar</button>
</div>
</div>
";


if ($_GET["action"] == "registro")
{
header("location: index.php");
exit();
}
}
else
{
$formularios_temas = "<strong>Para poder crear temas o comentar tienes que <a href='index.php?action=registro'>REGISTRARTE</a></strong>";

 $session ="
   <form method='post' class='navbar-form pull-right'>
    <input class='span2' type='text' placeholder='Email' name='email'>
    <input class='span2' type='password' placeholder='Password' name='password'>
	<input type='hidden' name='iniciar_sesion'>
    <button type='submit' class='btn'>Iniciar sesión</button>
	<button type='submit' class='btn btn-info'>Regístrate</button>
    </form>";
}
function restringido()
{
session_start();
if ($_SESSION["usuario"] != true)
{
header("location: index.php");
exit();
}
}
?>