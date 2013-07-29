<?php

if (isset($_POST["activar_usuario"])) {

    if (empty($_COOKIE["activar_usuario"])) {
        setcookie("activar_usuario", 1, time() + 3600);
    } else {
        setcookie("activar_usuario", $_COOKIE["activar_usuario"] + 1, time() + 3600);
    }
    if ($_COOKIE["activar_usuario"] > $max_activar_cuenta) {
        echo "NO ROBOTS";
        exit();
    }

    $email = addslashes(htmlspecialchars(strip_tags($_POST["email"])));
    $password = addslashes(htmlspecialchars(strip_tags($_POST["password"])));
    /* Encrypt pass to query the DB */
    $password = sha1($password);
    $codigo_verificacion = addslashes(htmlspecialchars(strip_tags($_POST["codigo_verificacion"])));

    $filtrar = new InputFilter();
    $email = $filtrar->process($email);
    $password = $filtrar->process($password);
    $codigo_verificacion = $filtrar->process($codigo_verificacion);

    $consulta = "SELECT * FROM usuarios WHERE email='$email' AND password='$password' AND codigo_verificacion='$codigo_verificacion'";
    $resultado = $conexion->query($consulta);
    $fila = $resultado->fetch_array();

    if ($fila > 0) {
        $consulta = "UPDATE usuarios SET activo='true' WHERE email='$email' AND password='$password' AND codigo_verificacion='$codigo_verificacion'";
        $resultado = $conexion->query($consulta);
        $msg_box = "
<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_activar_usuario[0] . "</strong>
</div>";
    } else {
        $msg_box = "
<div class='alert alert-error'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<strong>" . $pro_activar_usuario[1] . "</strong>
</div>";
    }
}
?>