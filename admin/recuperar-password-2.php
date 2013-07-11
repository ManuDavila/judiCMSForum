<?php 
error_reporting("E_NOTICE");
include "../system/conexion.php";
include "system/no_xss/class.inputfilter.php";
include "system/procesos/detalles-foro.php";
include "/system/language/$language_foro.php";
include "system/procesos/antirobots.php";
include "system/procesos/msg_box.php";
include "system/banear_ip/banear-ip.php";
include "system/procesos/recuperar-password-2.php"; 
?>
<!DOCTYPE html>
<html lang="es">
  <head>
	<title><?php echo $recuperar_password_2_adm[0]; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link rel="shortcut icon" href="../imagenes/<?php echo $icono_foro; ?>" type="image/x-icon">
	<meta name="title" content="">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="language" content="<?php echo $recuperar_password_2_adm[1]; ?>">
	<meta name="robot" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="../bootstrap/datepicker/css/datepicker.css" rel="stylesheet">
	<link href="../bootstrap/themes/<?php echo $theme_foro; ?>/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<script src="../bootstrap/js/jquery-1.10.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="js/datepicker/js/<?php echo $recuperar_password_2_adm[2]; ?>"></script>
	<script src="js/<?php echo $recuperar_password_2_adm[3]; ?>"></script>
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
          <a class="brand" href="#"><?php echo $recuperar_password_2_adm[4]; ?></a>
        </div>
      </div>
    </div>
  <div class="container">
	<center>
	<br><br><br><br>
	<?php echo $msg_box; ?>
<center>
    <form method="post" id="form_recuperar_2">
    <fieldset>
    <legend><?php echo $recuperar_password_2_adm[5]; ?>:</legend>
	<table class="table table-hover" style="width: auto;">
	<td class="text-right">Email:</td><td><input type="text" name="email" id="email" placeholder="Email"><label id="e_email"></label></td>
	</tr>
	<tr>
	<td class="text-right"><?php echo $recuperar_password_2_adm[6]; ?>:</td><td><input type="password" name="password" id="password" placeholder="<?php echo $recuperar_password_2_adm[6]; ?>"><label id="e_password"></label></td>
	</tr>
    <tr>
	<td class="text-right"><?php echo $recuperar_password_2_adm[7]; ?>:</td><td><input type="password" name="repetir_password" id="repetir_password" placeholder="<?php echo $recuperar_password_2_adm[7]; ?>"><label id="e_repetir_password"></label></td>
	</tr>
	<tr>
	<td class="text-right"><?php echo $recuperar_password_2_adm[8]; ?>:</td><td><input type="password" name="codigo_verificacion" id="codigo_verificacion" placeholder="<?php echo $recuperar_password_2_adm[8]; ?>"><label id="e_codigo_verificacion"></label></td>
	</tr>	
	</table>
    <button type="button" class="btn" id="button_recuperar_2"><?php echo $recuperar_password_2_adm[9]; ?></button>
	<input type="hidden" name="recuperar_password_2">
    </fieldset>
    </form>
	<div id="error"></div>
</center>
			  <a href="admin.php"><?php echo $recuperar_password_2_adm[10]; ?></a>
			  <br><br>
			  <a href="../index.php"><?php echo $recuperar_password_2_adm[11]; ?></a>
			  <br><br>
			</center>
			</div>
	  <footer>
	  <div class="text-center">
		  <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.<?php echo $footer_adm[0]; ?>"><img alt="Licencia de Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Judi CMS Forum</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.judicms.com" property="cc:attributionName" rel="cc:attributionURL">@judi</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.es_ES">Creative Commons 3.0 Unported License</a>.<br /> <a xmlns:dct="http://purl.org/dc/terms/" href="http://www.judicms.com" rel="dct:source">JUDI CMS FORUM</a>.
	</div>
	<br><br>
	</footer>
  </body>
</html>