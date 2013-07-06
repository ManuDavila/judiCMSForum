	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="index.php"><?php echo $title_foro; ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
                    <li <?php if($_GET["action"] == "detalles" || $_GET["action"] == "indice" || $_GET["action"] == "subindice" || $_GET["action"] == "temas" || $_GET["action"] == "usuario") {echo "class='dropdown active'";} else{echo "class='dropdown'";} ?>>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administración<b class="caret"></b></a>
                <ul class="dropdown-menu">
				<li><a href="index.php?action=detalles">Detalles</a></li>
                <li><a href="index.php?action=indice">Índices</a></li>
				<li><a href="index.php?action=subindice">Subíndices</a></li>
				<li><a href="index.php?action=temas">Temas</a></li>
				<li><a href="index.php?action=usuario&id_usuario=0">Usuarios</a></li>
                </ul>
              </li>
			  <li <?php if($_GET["action"] == "themes"){echo "class='active'";} ?>><a href="index.php?action=themes">Diseño</a></li>
			  <li <?php if($_GET["action"] == "servidor"){echo "class='active'";} ?>><a href="index.php?action=servidor">Servidor</a></li>
			  <li <?php if($_GET["action"] == "estadisticas"){echo "class='active'";} ?>><a href="index.php?action=estadisticas">Estadísticas</a></li>
			  <li><a href="<?php echo $url_foro; ?>" target="_blank">Ir al Foro</a></li>
            </ul>
			<?php echo $session; ?>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>