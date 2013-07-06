<?php
if(isset($_POST["nuevo_comentario"]))
{
session_start();
if ($_SESSION["usuario"] != true)
{
header("location: index.php");
exit();
}
/*SEGURIDAD*/
if (empty($_COOKIE["comentario"]))
{
setcookie("comentario", 1, time()+3600);
}
else
{
setcookie("comentario", $_COOKIE["comentario"] + 1, time()+3600);
}
if ($_COOKIE["comentario"] > $max_mensajes)
{
echo "NO ROBOTS";
exit();
}
/*SEGURIDAD*/
$id_categoria = addslashes(htmlspecialchars(strip_tags($_POST["categoriaC"])));
$id_subcategoria = addslashes(htmlspecialchars(strip_tags($_POST["subcategoriaC"])));
$id_tema = addslashes(htmlspecialchars(strip_tags($_POST["tituloC"])));
$imagen = addslashes(strip_tags(htmlspecialchars($_POST["_imagenC"])));
$url = addslashes(strip_tags(htmlspecialchars($_POST["_urlC"])));
$comentario = nl2br(htmlspecialchars($_POST["comentarioC"]));
$comentario = str_replace("'", "\'", $comentario);
$comentario = str_replace("\"", "\\\"", $comentario);
$id_usuario = $_SESSION["id"];
$fecha = date("Y-m-d");
$hora = date("H:i:s");

/*SEGURIDAD*/
if (!preg_match("/^([0-9])+$/", $id_categoria))
{
header("location: index.php");
return;
}
if (!preg_match("/^([0-9])+$/", $id_subcategoria))
{
header("location: index.php");
return;
}
if (!preg_match("/^([0-9])+$/", $id_tema))
{
header("location: index.php");
return;
}
if (!preg_match("/^(ht|f)tps?:\/\/(.*)\.(gif|png|jpg|jpeg)$/i", $imagen) || strlen($imagen) > 150 && $imagen != "")
{
$imagen = "";
}
if (!preg_match("/^(ht|f)tps?:\/\/\w+(.*)$/i", $url) || strlen($url) > 150 && $url != "")
{
$url = "";
}
$filtrar = new InputFilter();
$titulo = $filtrar->process($id_tema);
/*SEGURIDAD*/
//Comprobar si el id_categoria existe
$consulta = "SELECT id_categoria FROM categorias WHERE id_categoria=$id_categoria";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
if($fila == 0)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa, el tema no ha sido creado</strong>
</div>";
return;
}
//Comprobar si el id_subcategoria existe
$consulta = "SELECT id_subcategoria, id_categoria FROM subcategorias WHERE id_categoria=$id_categoria AND id_subcategoria=$id_subcategoria";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
if($fila == 0)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa, el tema no ha sido creado</strong>
</div>";
return;
}
//Ahora obtenemos el id del tema para incluirlo como mensaje en la tabla mensajes
$consulta = "SELECT tema FROM temas WHERE id_categoria=$id_categoria AND id_subcategoria=$id_subcategoria AND ";
$consulta .= "id_tema=$id_tema AND tema_cerrado='false'";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
$titulo = $fila["tema"];
if ($fila > 0)
{
//Añadimos el tema como mensaje
$consulta = "INSERT INTO mensajes(id_tema, id_subcategoria, id_categoria, tema, mensaje, url, imagen, id_usuario, fecha, hora, es_tema_principal)";
$consulta .= " VALUES('$id_tema', $id_subcategoria, '$id_categoria', '$titulo', '$comentario', '$url', '$imagen', '$id_usuario', '$fecha', '$hora', 'false')";
$resultado = $conexion->query($consulta);
}

//Ahora obtenemos el último mensaje para incluirlo en la tabla subcategorias
$consulta = "SELECT id_mensaje FROM mensajes WHERE id_tema=$id_tema AND tema='$titulo' AND mensaje='$comentario' AND ";
$consulta .= " id_usuario=$id_usuario AND fecha='$fecha' AND hora='$hora'";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
$id_mensaje = $fila["id_mensaje"];
if ($fila > 0)
{
$consulta = "UPDATE subcategorias SET id_ultimo_mensaje=$id_mensaje WHERE id_categoria=$id_categoria AND id_subcategoria=$id_subcategoria";
$resultado = $conexion->query($consulta);

require("system/phpmailer/class.phpmailer.php");
/* ADMINISTRADOR */
if ($notificacion_mensaje == "on")
{
$fecha = date("d-m-Y");
$hora = date("H:m:s");
$ip = $_SERVER["REMOTE_ADDR"];
$titulo = "Notificación de comentario de usuario en $title_foro";
$mensaje = "
<b>Buenos días administrador del foro <a href='$url_foro'>$title_foro</a> ...</b>
<br><br>
Nuevo comentario de usuario:
<br><br>
Fecha: $fecha<br>
Hora: $hora<br>
id de usuario: $id_usuario<br>
Nick de usuario: ".$_SESSION["nick"]."<br>
Whois: <a href='http://whois.arin.net/rest/ip/$ip'>http://whois.arin.net/rest/ip/$ip</a><br>
Dirección del tema al que pertenece este comentario: <a href='".$url_foro."index.php?action=tema&categoria=$id_categoria&subcategoria=$id_subcategoria&tema=$id_tema'>VER TEMA</a>
<br><br>
Comentario:
<br><br>
<i>$comentario</i>
<br><br>
Puedes tener más información sobre este usuario introduciendo su nick o id de usuario en la búsqueda de usuarios del <a href='".$url_foro."admin/'>panel de administración</a>.
<br><br>
Saludos.
";
$mail = new PHPMailer();
$mail->Host = $url_foro;
$mail->From = $email_foro;
$mail->FromName = $titulo;
$mail->Subject = $titulo;
$mail->AddAddress($email_foro);
$mail->Body = $mensaje;
$mail->IsHTML(true);
$mail->Send();
}
/* ADMINISTRADOR */

/*USUARIOS*/
$consulta = "SELECT DISTINCT id_usuario FROM mensajes WHERE id_tema=$id_tema";
$resultado = $conexion -> query($consulta);
while ($fila=$resultado->fetch_array())
{

$fecha = date("d-m-Y");
$hora = date("H:m:s");

$consulta_usuario = "SELECT email, nombre FROM usuarios WHERE id=".$fila["id_usuario"]."";
$resultado_usuario = $conexion -> query($consulta_usuario);
$fila_usuario = $resultado_usuario -> fetch_array();
$email = $fila_usuario["email"];
$nombre = $fila_usuario["nombre"];
$nick = $_SESSION["nick"];
$titulo = "Nuevo comentario en una de tus charlas - $title_foro";
$mensaje = "
<b>Buenos días $nombre. Bienvenido a <a href='$url_foro'>$title_foro</a> ...</b>
<br><br>
Nuevo comentario de $nick en una de tus charlas:
<br><br>
Fecha: $fecha<br>
Hora: $hora<br>
Puedes verlo en la siguiente dirección: <a href='".$url_foro."index.php?action=tema&categoria=$id_categoria&subcategoria=$id_subcategoria&tema=$id_tema'>Ir al Foro</a>
<br><br>
Comentario:
<br><br>
<i>$comentario</i>
<br><br>
Saludos.
";
$mail = new PHPMailer();
$mail->Host = $url_foro;
$mail->From = $email_foro;
$mail->FromName = $titulo;
$mail->Subject = $titulo;
$mail->AddAddress($email);
$mail->Body = $mensaje;
$mail->IsHTML(true);
$mail->Send();
}
/*USUARIOS*/
header("location: index.php?action=tema&categoria=$id_categoria&subcategoria=$id_subcategoria&tema=$id_tema");
}
}
?>