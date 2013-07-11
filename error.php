<?php 
error_reporting("E_NOTICE");
include "system/conexion.php"; 
include "system/procesos/detalles-foro.php"; 
?>
<!DOCTYPE html>
<html>
  <head>
	<title>ERROR</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link rel="shortcut icon" href="imagenes/<?php echo $icono_foro; ?>" type="image/x-icon">
	<meta name="title" content="">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="language" content="spanish">
	<meta name="robot" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="bootstrap/datepicker/css/datepicker.css" rel="stylesheet">
	<link href="bootstrap/themes/<?php echo $theme_foro; ?>/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<script src="bootstrap/js/jquery-1.10.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">

      /* Sticky footer styles
      -------------------------------------------------- */
      html,
      body {
        height: 100%;
        /* The html and body elements cannot have any padding or margin. */
      }

      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -60px;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 60px;
      }
      #footer {
        background-color: #f5f5f5;
      }

      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }



      /* Custom page CSS
      -------------------------------------------------- */
      /* Not required for template or sticky footer method. */

      .container {
        width: auto;
        max-width: 680px;
      }
      .container .credit {
        margin: 20px 0;
      }

    </style>
  </head>

  <body>
    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>ERROR</h1>
        </div>
        <p class="lead">An error occurred Page not found.</p>
        <p>Registered error in the <a href="http://whois.arin.net/rest/ip/<?php echo $_SERVER["REMOTE_ADDR"]; ?>" target="_blank"> ip</a> <?php echo $_SERVER["REMOTE_ADDR"]; ?>.</p>
      </div>

      <div id="push"></div>
    </div>

   	  <footer>
	  <div class="text-center">
        <strong>
		<a href="index.php">BACK TO FORUM</a>
        </strong>
	</div>
	<br><br>
	</footer>
  </body>
</html>
