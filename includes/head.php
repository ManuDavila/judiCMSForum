<?php 
switch ($_GET["action"])
{
case "inicio":
$meta_title = addslashes($title_foro);
$meta_description = addslashes($description_foro);
$meta_keywords = addslashes($keywords_foro);
$meta_robots = "all";
break;

case "":
$meta_title = addslashes($title_foro);
$meta_description = addslashes($description_foro);
$meta_keywords = addslashes($keywords_foro);
$meta_robots = "all";
break;

case "categoria": //categoria
$consulta_meta = "SELECT * FROM categorias WHERE id_categoria=".$_GET["categoria"]."";
$resultado_meta = $conexion->query($consulta_meta);
$fila_meta = $resultado_meta->fetch_array();
$meta_title = addslashes($fila_meta["title"]);
$meta_description = addslashes($fila_meta["description"]);
$meta_keywords = addslashes($fila_meta["keywords"]);
$meta_robots = "all";
break;

case "temas": //Subcategoria
$consulta_meta = "SELECT * FROM subcategorias WHERE id_subcategoria=".$_GET["subcategoria"]."";
$resultado_meta = $conexion->query($consulta_meta);
$fila_meta = $resultado_meta->fetch_array();
$meta_title = addslashes($fila_meta["title"]);
$meta_description = addslashes($fila_meta["description"]);
$meta_keywords = addslashes($fila_meta["keywords"]);
$meta_robots = "all";
break;

case "tema":
$consulta_meta = "SELECT * FROM temas WHERE id_tema=".$_GET["tema"]."";
$resultado_meta = $conexion->query($consulta_meta);
$fila_meta = $resultado_meta->fetch_array();
$meta_title = addslashes($fila_meta["tema"]);
$meta_description = strip_tags(addslashes($fila_meta["mensaje"]));
$keywords = explode(" ", $meta_title);
for ($x = 0; $x < count($keywords); $x++)
{
$keyw .= $keywords[$x].",";
}
$meta_keywords = addslashes($keyw);
$meta_robots = "all";
break;

case "registro":
$meta_title = "Regístrate en el foro";
$meta_description = "Regístrate en el foro";
$meta_keywords = "";
$meta_robots = "noindex, nofollow";
break;

case "activar":
$meta_title = "Activar usuario";
$meta_description = "Activar usuario";
$meta_keywords = "";
$meta_robots = "noindex, nofollow";
break;

case "recuperar-1":
$meta_title = "Recuperar password";
$meta_description = "Recuperar password";
$meta_keywords = "";
$meta_robots = "noindex, nofollow";
break;

case "recuperar-2":
$meta_title = "Recuperar password";
$meta_description = "Recuperar password";
$meta_keywords = "";
$meta_robots = "noindex, nofollow";
break;

case "ayuda":
$meta_title = "Sección de ayuda del foro";
$meta_description = "Sección de ayuda del foro";
$meta_keywords = "";
$meta_robots = "noindex, nofollow";
break;

case "contacto":
$meta_title = "Contacto";
$meta_description = "Contacto";
$meta_keywords = "";
$meta_robots = "noindex, nofollow";
break;

case "normas":
$meta_title = "Normas del foro";
$meta_description = "Normas del foro";
$meta_keywords = "";
$meta_robots = "noindex, nofollow";
break;

case "panel-usuario":
$meta_title = "Panel de usuario";
$meta_description = "Panel de usuario";
$meta_keywords = "";
$meta_robots = "noindex, nofollow";
break;

case "user":
$meta_title = $nombre_usuario." ".$apellido_1_usuario." ".$apellido_2_usuario;
$meta_description = addslashes($description_user);
$meta_keywords = addslashes($description_user);
$meta_robots = "all";
break;
}
?>
	<title><?php echo $meta_title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link rel="shortcut icon" href="imagenes/<?php echo $icono_foro; ?>" type="image/x-icon">
	<meta name="title" content="<?php echo $meta_title; ?>">
	<meta name="description" content="<?php echo $meta_description; ?>">
	<meta name="keywords" content="<?php echo $meta_keywords; ?>">
	<meta name="language" content="spanish">
	<meta name="robot" content="<?php echo $meta_robots; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="bootstrap/themes/<?php echo $theme_foro; ?>/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/css/icons.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<script src="bootstrap/js/jquery-1.10.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/javascript.js"></script>
	</head>