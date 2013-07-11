<?php
if(isset($_POST["nuevo_tema"]))
{
include_once "".$url_foro."system/restricted.php";

if (empty($_COOKIE["tema"]))
{
setcookie("tema", 1, time()+3600);
}
else
{
setcookie("tema", $_COOKIE["tema"] + 1, time()+3600);
}
if ($_COOKIE["tema"] > $max_temas)
{
echo "NO ROBOTS";
exit();
}

$id_categoria = addslashes(htmlspecialchars(strip_tags($_POST["categoria"])));
$id_subcategoria = addslashes(htmlspecialchars(strip_tags($_POST["subcategoria"])));
$imagen = addslashes(strip_tags(htmlspecialchars($_POST["_imagen"])));
$url = addslashes(strip_tags(htmlspecialchars($_POST["_url"])));
$titulo = addslashes(strip_tags(htmlspecialchars($_POST["titulo"])));
$comentario = nl2br(htmlspecialchars($_POST["comentario"]));
$comentario = str_replace("'", "\'", $comentario);
$comentario = str_replace("\"", "\\\"", $comentario);
$id_usuario = $_SESSION["id"];
$fecha = date("Y-m-d");
$hora = date("H:i:s");

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

if (!preg_match("/^(ht|f)tps?:\/\/(.*)\.(gif|png|jpg|jpeg)$/i", $imagen) || strlen($imagen) > 150 && $imagen != "")
{
$imagen = "";
}
if (!preg_match("/^(ht|f)tps?:\/\/\w+(.*)$/i", $url) || strlen($url) > 150 && $url != "")
{
$url = "";
}
$filtrar = new InputFilter();
$titulo = $filtrar->process($titulo);

$consulta = "SELECT id_categoria FROM categorias WHERE id_categoria=$id_categoria";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
if($fila == 0)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_nuevo_tema[0]."</strong>
</div>";
return;
}

$consulta = "SELECT id_subcategoria, id_categoria FROM subcategorias WHERE id_categoria=$id_categoria AND id_subcategoria=$id_subcategoria";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
if($fila == 0)
{
$msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>".$pro_nuevo_tema[0]."</strong>
</div>";
return;
}

$consulta = "INSERT INTO temas(id_categoria, id_subcategoria, tema, mensaje, url, imagen, id_usuario, fecha, hora)";
$consulta .= " VALUES('$id_categoria', '$id_subcategoria', '$titulo', '$comentario', '$url', '$imagen', '$id_usuario', '$fecha', '$hora')";
$resultado = $conexion->query($consulta);

$consulta = "SELECT id_tema FROM temas WHERE id_categoria=$id_categoria AND id_subcategoria=$id_subcategoria AND ";
$consulta .= "tema='$titulo' AND mensaje='$comentario' AND id_usuario=id_usuario AND fecha='$fecha' AND hora='$hora'";
$resultado = $conexion->query($consulta);
$fila = $resultado->fetch_array();
$id_tema = $fila["id_tema"];
if ($fila > 0)
{
$consulta = "INSERT INTO mensajes(id_tema, id_categoria, id_subcategoria, tema, mensaje, url, imagen, id_usuario, fecha, hora, es_tema_principal)";
$consulta .= " VALUES('$id_tema', '$id_categoria', '$id_subcategoria', '$titulo', '$comentario', '$url', '$imagen', '$id_usuario', '$fecha', '$hora', 'true')";
$resultado = $conexion->query($consulta);
}

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
if ($notificacion_tema == "on")
{
$fecha = date("d-m-Y");
$hora = date("H:m:s");
$ip = $_SERVER["REMOTE_ADDR"];
$titulo = "".$pro_nuevo_tema[1]." $title_foro";
$mensaje = "
<b>".$pro_nuevo_tema[2]." <a href='$url_foro'>$title_foro</a> ...</b>
<br><br>
".$pro_nuevo_tema[3].":
<br><br>
".$pro_nuevo_tema[4].": $fecha<br>
".$pro_nuevo_tema[5].": $hora<br>
".$pro_nuevo_tema[6].": $id_usuario<br>
".$pro_nuevo_tema[7].": ".$_SESSION["nick"]."<br>
Whois: <a href='http://whois.arin.net/rest/ip/$ip'>http://whois.arin.net/rest/ip/$ip</a><br>
".$pro_nuevo_tema[8].": <a href='".$url_foro."index.php?action=tema&categoria=$id_categoria&subcategoria=$id_subcategoria&tema=$id_tema'>".$pro_nuevo_tema[9]."</a>
<br><br>
".$pro_nuevo_tema[10].":
<br><br>
<i>$comentario</i>
<br><br>
".$pro_nuevo_tema[11]." <a href='".$url_foro."admin/'>".$pro_nuevo_tema[12]."</a>.
<br><br>
".$pro_nuevo_tema[13].".
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
header("location: index.php?action=tema&categoria=$id_categoria&subcategoria=$id_subcategoria&tema=$id_tema");
}
}
?>