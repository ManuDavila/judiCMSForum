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
              <li <?php if($_GET["action"]!= "ayuda" && $_GET["action"] != "normas" && $_GET["action"] != "recuperar-1" && $_GET["action"] != "recuperar-2" && $_GET["action"] != "contacto") echo "class='active'"; ?>><a href="index.php">Foro</a></li>
                    <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Índices<b class="caret"></b></a>
                <ul class="dropdown-menu">
			<?php 
			$consulta_indices = "SELECT * FROM categorias";
			$resultado_indices = $conexion->query($consulta_indices);
			while ($fila_indices = $resultado_indices->fetch_array())
			{
			echo "<li><a href='index.php?action=categoria&categoria=".$fila_indices["id_categoria"]."'>".$fila_indices["categoria"]."</a></li>";
			}
			?>
                </ul>
              </li>
			  <li <?php if($_GET["action"]== "ayuda" || $_GET["action"] == "normas" || $_GET["action"] == "recuperar-1" || $_GET["action"] == "recuperar-2")echo "class='active'"; ?>><a href="index.php?action=ayuda"><span class="icon-white icon-question-sign"></span></a></li>
			  <li <?php if($_GET["action"] == "contacto") echo "class='active'"; ?>><a href="index.php?action=contacto"><span class="icon-white icon-envelope"></span></a></li>
            </ul>
			<?php echo $session; ?>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>