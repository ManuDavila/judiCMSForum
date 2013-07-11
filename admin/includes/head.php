<?php 
$meta_title = addslashes($title_foro);
$meta_description = addslashes("");
$meta_keywords = addslashes("");
$meta_robots = "noindex, nofollow";
?>
	<title><?php echo $meta_title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link rel="shortcut icon" href="../imagenes/<?php echo $icono_foro; ?>" type="image/x-icon">
	<meta name="title" content="<?php echo $meta_title; ?>">
	<meta name="description" content="<?php echo $meta_description; ?>">
	<meta name="keywords" content="<?php echo $meta_keywords; ?>">
	<meta name="language" content="<?php echo $head_adm[0]; ?>">
	<meta name="robot" content="<?php echo $meta_robots; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="../bootstrap/datepicker/css/datepicker.css" rel="stylesheet">
	<link href="../bootstrap/themes/<?php echo $theme_foro; ?>/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<script src="../bootstrap/js/jquery-1.10.1.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="js/datepicker/js/<?php echo $head_adm[1]; ?>"></script>
	<script src="js/<?php echo $head_adm[2]; ?>"></script>