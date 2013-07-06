<?php 
error_reporting("E_NOTICE");
include "../system/conexion.php"; 
include "system/procesos/detalles-foro.php"; 
include "system/procesos/antirobots.php"; 
include "system/no_xss/class.inputfilter.php"; 
include "system/banear_ip/banear-ip.php";
include "system/procesos/iniciar-sesion.php"; 

session_start();
if ($_SESSION["admin"] == true)
{
header("location: index.php");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<title>Iniciar Sesión</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link rel="shortcut icon" href="../imagenes/<?php echo $icono_foro; ?>" type="image/x-icon">
	<meta name="title" content="">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="language" content="spanish">
	<meta name="robot" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="../bootstrap/datepicker/css/datepicker.css" rel="stylesheet">
	<link href="../bootstrap/themes/<?php echo $theme_foro; ?>/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<script src="../bootstrap/js/jquery-1.10.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="js/datepicker/js/bootstrap-datepicker-es.js"></script>
	<script src="js/javascript.js"></script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">FORO JUDI CMS - PANEL DE ADMINISTRACIÓN</a>
        </div>
      </div>
    </div>

    <div class="container">
	<center>
	<br><br><br><br>
             <form method="post" id="form_sesion">
			 <label><strong>Iniciar sesión:</strong></label>
			 <table>
			 <tr>
			 <td style="text-align: right;">Usuario:</td>
			 <td>
              <input class="span2" name="admin" id="admin" type="text" placeholder="Usuario">
			  <label id="e_admin"></label>
			  </td>
			  </tr>
			  <tr>
			  <td style="text-align: right;">Password:</td>
			  <td>
              <input class="span2" name="password" id="password" type="password" placeholder="Password">
			  <label id="e_password"></label>
			  </td>
			  </tr>
			  <tr>
			  <td><input type="hidden" name="iniciar_sesion"></td>
			  <td>
              <button type="button" id="button_sesion" class="btn">Iniciar sesión</button>
			  </td>
			  </tr>
			  </table>
			  </form>
			  <a href="recuperar-password-1.php">Olvide mi contraseña</a>
			  <br><br>
			  <a href="../index.php">Regresar al Foro</a>
			  <br><br>
			  </center>
			  </div>
	  <footer>
	  <div class="text-center">
		  <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.es_ES"><img alt="Licencia de Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Judi CMS Forum</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.judicms.com" property="cc:attributionName" rel="cc:attributionURL">@judi</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.es_ES">Creative Commons Reconocimiento-CompartirIgual 3.0 Unported License</a>.<br />Creado a partir de la obra en <a xmlns:dct="http://purl.org/dc/terms/" href="http://www.judicms.com" rel="dct:source">http://www.judicms.com</a>.
	</div>
	<br><br>
	</footer>
  </body>
</html>