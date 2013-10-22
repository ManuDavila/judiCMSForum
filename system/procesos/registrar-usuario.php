<?php

if (isset($_POST["registrar_usuario"])) {
    if (empty($_COOKIE["registrar"])) {
        setcookie("registrar", 1, time() + 3600);
    } else {
        setcookie("registrar", $_COOKIE["registrar"] + 1, time() + 3600);
    }
    if ($_COOKIE["registrar"] > $max_registro) {
        echo "NO ROBOTS";
        exit();
    }

    $nick = addslashes(htmlspecialchars(strip_tags($_POST["nick"])));
    $nombre = addslashes(htmlspecialchars(strip_tags($_POST["nombre"])));
    $apellidos = addslashes(htmlspecialchars(strip_tags($_POST["apellidos"])));
    $email = addslashes(htmlspecialchars(strip_tags($_POST["email"])));
    $password = addslashes(htmlspecialchars(strip_tags($_POST["password"])));
    $repetir_password = addslashes(htmlspecialchars(strip_tags($_POST["repetir_password"])));
    $sexo = addslashes(htmlspecialchars(strip_tags($_POST["sexo"])));
    $ip = $_SERVER["REMOTE_ADDR"];


    $consulta = "SELECT email FROM usuarios WHERE email='$email'";
    $resultado = $conexion->query($consulta);
    $fila = $resultado->fetch_array();
    if ($fila > 0) {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[0] . "</strong>
</div>";
        return;
    }

    $filtrar = new InputFilter();
    $nombre = $filtrar->process($nombre);
    $apellidos = $filtrar->process($apellidos);
    $email = $filtrar->process($email);
    $password = $filtrar->process($password);
    $codigo_array = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f");
    $codigo_verificacion = "";
    for ($x = 0; $x < 16; $x++) {
        $codigo_verificacion .= $codigo_array[rand(0, count($codigo_array) - 1)];
    }
    $activo = 0;
    $fecha = date("Y-m-d");

    if (!preg_match("/^[0-9a-zA-Z·ÈÌÛ˙‡ËÏÚ˘¿»Ã“Ÿ¡…Õ”⁄Ò—¸‹_]+$/", $nick)) {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[1] . "</strong>
</div>";
        return;
    }

    if (strlen($nick) < 3 || strlen($nick) > 25) {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[1] . "</strong>
</div>";
        return;
    }

    $consulta_nick = "SELECT nick FROM usuarios WHERE nick='$nick'";
    $resultado_nick = $conexion->query($consulta_nick);
    $fila_nick = $resultado_nick->fetch_array();

    if ($fila_nick > 0) {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[1] . "</strong>
</div>";
        return;
    }

    if ($sexo == "") {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[2] . "</strong>
</div>";
        return;
    }

    /* Intentamos pillar el avatar de gravatar, por si tiene uno ya, si no, usamos los que hay por defecto */
    $mail_hash = md5(strtolower(trim($email)));
    $size_avatar = 279;
    $rand = rand(10000, 99999);
    $cad = $rand . "-" . $nick . ".jpg";
    if (copy("http://www.gravatar.com/avatar/" . $mail_hash . "?s=" . $size_avatar . "&d=404", "imagenes/avatares/" . $cad)) {
        $avatar = "imagenes/avatares/" . $cad;
    } else {
        $avatar = $sexo == "chico" ? "imagenes/avatares/chico.jpg" : "imagenes/avatares/chica.jpg";
    }


    $elemento = $nombre;
    $buscar = "/^[a-zA-Z·ÈÌÛ˙‡ËÏÚ˘¿»Ã“Ÿ¡…Õ”⁄Ò—¸‹\s]+$/";
    if ($elemento == "") {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[1] . "</strong>
</div>";
        return;
    } else if (!preg_match($buscar, $elemento) || strlen($elemento) > 50) {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[1] . "</strong>
</div>";
        return;
    }

    $elemento = $apellidos;
    $buscar = "/^[a-zA-Z·ÈÌÛ˙‡ËÏÚ˘¿»Ã“Ÿ¡…Õ”⁄Ò—¸‹\s]+$/";
    if ($elemento == "") {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[1] . "</strong>
</div>";
        return;
    } else if (!preg_match($buscar, $elemento) || strlen($elemento) > 50) {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[1] . "</strong>
</div>";
        return;
    }

    $elemento = $email;
    $buscar = "/^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/";
    if ($elemento == "") {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[1] . "</strong>
</div>";
        return;
    } else if (!preg_match($buscar, $elemento) || strlen($elemento) > 80) {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[1] . "</strong>
</div>";
        return;
    }

    $elemento = $password;
    $buscar = "/^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i";
    if ($elemento == "") {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[1] . "</strong>
</div>";
        return;
    } else if (!preg_match($buscar, $elemento) || strlen($elemento) < 8 || strlen($elemento) > 16) {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[1] . "</strong>
</div>";
        return;
    }

    $elemento = $repetir_password;
    if ($elemento != $password) {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[1] . "</strong>
</div>";
        return;
    } else {
        /* Encrypt pass to query the DB */
        $password = sha1($password);
        $consulta = "INSERT INTO usuarios(nombre, apellidos, email, nick, password, sexo, avatar, codigo_verificacion, activo, fecha_registro, ip)";
        $consulta .= " VALUES('$nombre', '$apellidos', '$email', '$nick', '$password', '$sexo', '$avatar', '$codigo_verificacion', '$activo', '$fecha', '$ip')";
        $resultado = $conexion->query($consulta);

        if ($resultado) {
            require("system/phpmailer/class.phpmailer.php");

            /* ADMINISTRADOR */
            if ($notificacion_registro == "on") {
                $fecha = date("d-m-Y");
                $hora = date("H:m:s");
                $titulo = "" . $pro_registro[3] . " $title_foro";
                $mensaje = "
<b>" . $pro_registro[4] . " <a href='$url_foro'>$title_foro</a> ...</b>
<br><br>
" . $pro_registro[5] . ":
<br><br>
" . $pro_registro[6] . ": $fecha<br>
" . $pro_registro[7] . ": $hora<br>
" . $pro_registro[8] . ": $nombre<br>
" . $pro_registro[9] . ": $apellidos<br>
Nick: $nick<br>
Whois: <a href='http://whois.arin.net/rest/ip/$ip'>http://whois.arin.net/rest/ip/$ip</a>
<br><br>
" . $pro_registro[10] . " <a href='" . $url_foro . "admin/'>" . $pro_registro[11] . "</a>.
<br><br>
" . $pro_registro[12] . ".
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
            $titulo = "" . $pro_registro[13] . " - $title_foro";
            $mensaje = "<b>$nombre " . $pro_registro[14] . " <a href='$url_foro'>$title_foro</a> ...</b>
<br><br> 
" . $pro_registro[15] . "
<br><br>
" . $pro_registro[16] . "
<a href='" . $url_foro . "index.php?action=activar'>" . $pro_registro[17] . "</a>
" . $pro_registro[18] . ": <b>$codigo_verificacion</b>
<br><br>
" . $pro_registro[19] . "
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

            if ($mail->Send()) {
                $msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[20] . "</strong>
</div>";
            } else {
                $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_registro[21] . "</strong>
</div>";
            }
        }
    }
}
?>