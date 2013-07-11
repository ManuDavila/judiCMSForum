<?php 
error_reporting("E_NOTICE");
include "../system/conexion.php"; 
include "system/procesos/detalles-foro.php"; 
include "/system/language/$language_foro.php";
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
<html>
  <head>
	<title><?php echo $admin_adm[0]; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link rel="shortcut icon" href="../imagenes/<?php echo $icono_foro; ?>" type="image/x-icon">
	<meta name="title" content="">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="language" content="<?php echo $admin_adm[1]; ?>">
	<meta name="robot" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="../bootstrap/datepicker/css/datepicker.css" rel="stylesheet">
	<link href="../bootstrap/themes/<?php echo $theme_foro; ?>/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<script src="../bootstrap/js/jquery-1.10.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="js/datepicker/js/<?php echo $admin_adm[2]; ?>"></script>
	<script src="js/<?php echo $admin_adm[3]; ?>"></script>
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
          <a class="brand" href="#"><?php echo $admin_adm[4]; ?></a>
        </div>
      </div>
    </div>

    <div class="container">
	<center>
	<br><br><br><br>
             <form method="post" id="form_sesion">
			 <label><strong><?php echo $admin_adm[5]; ?>:</strong></label>
			 <table>
			 <tr>
			 <td style="text-align: right;"><?php echo $admin_adm[6]; ?>:</td>
			 <td>
              <input class="span2" name="admin" id="admin" type="text" placeholder="<?php echo $admin_adm[6]; ?>">
			  <span id="e_admin"></span>
			  </td>
			  </tr>
			  <tr>
			  <td style="text-align: right;"><?php echo $admin_adm[7]; ?>:</td>
			  <td>
              <input class="span2" name="password" id="password" type="password" placeholder="<?php echo $admin_adm[7]; ?>">
			  <span id="e_password"></span>
			  </td>
			  </tr>
			  <tr>
			  <td><input type="hidden" name="iniciar_sesion"></td>
			  <td>
              <button type="button" id="button_sesion" class="btn"><?php echo $admin_adm[8]; ?></button>
			  </td>
			  </tr>
			  </table>
			  </form>
			  <a href="recuperar-password-1.php"><?php echo $admin_adm[9]; ?></a>
			  <br><br>
			  <a href="../index.php"><?php echo $admin_adm[10]; ?></a>
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