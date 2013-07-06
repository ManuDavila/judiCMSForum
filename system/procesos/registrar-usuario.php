<?php
if (isset($_POST["registrar_usuario"]))
{
/*SEGURIDAD*/
if (empty($_COOKIE["registrar"]))
{
setcookie("registrar", 1, time()+3600);
}
else
{
setcookie("registrar", $_COOKIE["registrar"] + 1, time()+3600);
}
if ($_COOKIE["registrar"] > $max_registro)
{
echo "NO ROBOTS";
exit();
}
/*SEGURIDAD*/

$nick = addslashes(htmlspecialchars(strip_tags($_POST["nick"])));
$nombre = addslashes(htmlspecialchars(strip_tags($_POST["nombre"])));
$apellido_1 = addslashes(htmlspecialchars(strip_tags($_POST["apellido_1"])));
$apellido_2 = addslashes(htmlspecialchars(strip_tags($_POST["apellido_2"])));
$email = addslashes(htmlspecialchars(strip_tags($_POST["email"])));
$password = addslashes(htmlspecialchars(strip_tags($_POST["password"])));
$repetir_password = addslashes(htmlspecialchars(strip_tags($_POST["repetir_password"])));
$sexo = addslashes(htmlspecialchars(strip_tags($_POST["sexo"])));
$ip = $_SERVER["REMOTE_ADDR"];


/*Comprobar si existe usuario*/
$consulta = "SELECT email FROM usuarios WHERE email='$email'";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
if($fila>0)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>El usuario ya se encuentra registrado</strong>
</div>";
return;
}
/*Comprobar si existe usuario*/

/*SEGURIDAD*/
$filtrar = new InputFilter();
$nombre = $filtrar->process($nombre);
$apellido_1 = $filtrar->process($apellido_1);
$apellido_2 = $filtrar->process($apellido_2);
$email = $filtrar->process($email);
$password = $filtrar->process($password);
$codigo_array = array ("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f");
$codigo_verificacion = "";
for($x=0; $x < 16; $x++)
{
$codigo_verificacion .= $codigo_array[rand(0, count($codigo_array) - 1)];
}
$activo = "false";
$fecha = date("Y-m-d");
/*SEGURIDAD*/

/*SEGURIDAD*/
if(!preg_match("/^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_]+$/", $nick))
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa</strong>
</div>";
return;
}

if (strlen($nick) < 3 || strlen($nick) > 25)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa</strong>
</div>";
return;
}

$consulta_nick = "SELECT nick FROM usuarios WHERE nick='$nick'";
$resultado_nick = $conexion->query($consulta_nick);
$fila_nick = $resultado_nick->fetch_array();

if ($fila_nick > 0)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa</strong>
</div>";
return;
}
/*SEGURIDAD*/

/*SEGURIDAD*/

//Sexo
if ($sexo == "")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>No has indicado el sexo</strong>
</div>";
return;
}

if ($sexo == "chico")
{
$avatar = "imagenes/avatares/chico.jpg";
}

if ($sexo == "chica")
{
$avatar = "imagenes/avatares/chica.jpg";
}

//nombre
$elemento = $nombre;
$buscar = "/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/";
if ($elemento == "")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa</strong>
</div>";
return;
}
else if(!preg_match($buscar, $elemento) || strlen($elemento) > 50)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa</strong>
</div>";
return;
}

//apellido 1
$elemento = $apellido_1;
$buscar = "/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/";
if ($elemento == "")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa</strong>
</div>";
return;
}
else if(!preg_match($buscar, $elemento) || strlen($elemento) > 50)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa</strong>
</div>";
return;
}

//apellido 2
$elemento = $apellido_2;
$buscar = "/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\s]+$/";
if ($elemento == "")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa</strong>
</div>";
return;
}
else if(!preg_match($buscar, $elemento) || strlen($elemento) > 50)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa</strong>
</div>";
return;
}

//email
$elemento = $email;
$buscar = "/^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/";
if ($elemento == "")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa</strong>
</div>";
return;
}
else if(!preg_match($buscar, $elemento) || strlen($elemento) > 80)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa</strong>
</div>";
return;
}

//password
$elemento = $password;
$buscar = "/^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i";
if ($elemento == "")
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa</strong>
</div>";
return;
}
else if(!preg_match($buscar, $elemento) || strlen($elemento) < 8 || strlen($elemento) > 16)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa</strong>
</div>";
return;
}

//repetir password
$elemento = $repetir_password;
if ($elemento != $password)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Actividad sospechosa</strong>
</div>";
return;
}

else
{
$consulta = "INSERT INTO usuarios(nombre, apellido_1, apellido_2, email, nick, password, sexo, avatar, codigo_verificacion, activo, fecha_registro, ip)";
$consulta .= " VALUES('$nombre', '$apellido_1', '$apellido_2', '$email', '$nick', '$password', '$sexo', '$avatar', '$codigo_verificacion', '$activo', '$fecha', '$ip')";
$resultado = $conexion->query($consulta);

if($resultado)
{
require("system/phpmailer/class.phpmailer.php");

/* ADMINISTRADOR */
if ($notificacion_registro == "on")
{
$fecha = date("d-m-Y");
$hora = date("H:m:s");
$titulo = "Notificación de registro de usuario en $title_foro";
$mensaje = "
<b>Buenos días administrador del foro <a href='$url_foro'>$title_foro</a> ...</b>
<br><br>
Nuevo usuario registrado:
<br><br>
Fecha: $fecha<br>
Hora: $hora<br>
nombre: $nombre<br>
apellidos: $apellido_1 $apellido_2<br>
Nick: $nick<br>
Whois: <a href='http://whois.arin.net/rest/ip/$ip'>http://whois.arin.net/rest/ip/$ip</a>
<br><br>
Puedes tener más información sobre este usuario introduciendo su nick en la búsqueda de usuarios del <a href='".$url_foro."admin/'>panel de administración</a>.
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


/* USUARIO */
$titulo = "Confirmar registro - $title_foro";
$mensaje = "<b>$nombre bienvenido a <a href='$url_foro'>$title_foro</a> ...</b>
<br><br> 
Para iniciar sesión utilice la cuenta de correo electrónico y la contraseña con la que se 
registró.
<br><br>
Para activar la cuenta vaya a la siguiente dirección
<a href='".$url_foro."index.php?action=activar'>ACTIVAR</a>
 y actívela con el siguiente código: <b>$codigo_verificacion</b>
<br><br>
Gracias por registrarte en el foro, saludos.
";
$mail = new PHPMailer();
$mail->Host = $url_foro;
$mail->From = $email_foro;
$mail->FromName = $titulo;
$mail->Subject = $titulo;
$mail->AddAddress($email, $nombre);
$mail->Body = $mensaje;
$mail->IsHTML(true);
/* USUARIO */

if($mail->Send())
{
$msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>Le ha sido enviado un email a su cuenta de correo electrónico para que confirme su cuenta</strong>
</div>";
}
else
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>No se ha podido procesar su consulta, prueba más tarde</strong>
</div>";
}
}
}
}
?>