<?php
if ($_GET["action"] == "themes") {
    include_once "" . $url_foro . "admin/system/restricted.php";

    function listar_directorios_ruta($ruta) {
        // abrir un directorio y listarlo recursivo
        if (is_dir($ruta)) {
            if ($dh = opendir($ruta)) {
                while (($file = readdir($dh)) !== false) {
                    //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
                    //mostraría tanto archivos como directorios
                    //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
                    if (is_dir($ruta . $file) && $file != "." && $file != ".." && $file != "img") {
                        //solo si el archivo es un directorio, distinto que "." y ".."
                        echo "<option value='$file'>$file</option>";
                        listar_directorios_ruta($ruta . $file . "/");
                    }
                }
                closedir($dh);
            }
        }
    }

    $consulta_selected = "SELECT theme FROM detalles_foro";
    $resultado_selected = $conexion->query($consulta_selected);
    $fila_selected = $resultado_selected->fetch_array();
    $theme_selected = $fila_selected["theme"];
    ?>
    <h3><?php echo $inc_themes_adm[0]; ?></h3>

    <div class="btn-group">
        <button class="btn" id="btn_temas"><?php echo $inc_themes_adm[1]; ?></button>
        <button class="btn" id="btn_instalar_tema"><?php echo $inc_themes_adm[2]; ?></button>
        <button class="btn" id="btn_icono"><?php echo $inc_themes_adm[3]; ?></button>
        <button class="btn" id="btn_cabecera"><?php echo $inc_themes_adm[4]; ?></button>
        <button class="btn" id="btn_piedepagina"><?php echo $inc_themes_adm[21]; ?></button>
        <button class="btn" id="btn_custom_css"><?php echo $inc_themes_adm[24]; ?></button>
    </div>

    <div id="box_temas" class="box-hide">
        <br>
        <h4><?php echo $inc_themes_adm[5]; ?></h4>
    <?php echo $inc_themes_adm[6]; ?> <a href="http://www.judicms.com/index.php?action=buscar-themes" target="_blank">THEMES</a>
        <br><br>
        <form method="post">
            <select name='theme' multiple="multiple" size="10">
                <?php
                listar_directorios_ruta("../bootstrap/themes/");
                ?>
            </select>
            <button type="submit" class="btn"><?php echo $inc_themes_adm[7]; ?></button>
            <button type="button" class="btn init-box-hide"><span class=" icon-remove-circle"></span> <?php echo $inc_themes_adm[8]; ?></button>
        </form>
    </div>

    <div id="box_icono" class="box-hide">
        <br><br>
        <strong><?php echo $inc_themes_adm[9]; ?>:</strong> <img src="<?php echo $url_foro . "imagenes/" . $icono_foro ?>">
        <form method="post" enctype="multipart/form-data">
            <b><?php echo $inc_themes_adm[10]; ?>:</b>
            <input type='file' name='file'> 
            <input type="hidden" name="icono">
            <span class="font-size-10">Max. 1Mb | .ico</span>
            <br><br>
            <button type="submit" class="btn"><?php echo $inc_themes_adm[11]; ?></button>
            <button type="button" class="btn init-box-hide"><span class=" icon-remove-circle"></span> <?php echo $inc_themes_adm[12]; ?></button>
        </form>
    </div>

    <div id="box_instalar_tema" class="box-hide">
        <br>
        <h3><?php echo $inc_themes_adm[13]; ?></h3>
    <?php echo $inc_themes_adm[14]; ?> <a href="http://www.judicms.com/index.php?action=buscar-themes" target="_blank">THEMES</a>
        <br><br>
        <form method="post" action="" class="form-search">
    <?php echo $inc_themes_adm[15]; ?>: <input type="text" name="instalar_tema">
            <button type="submit" class="btn"><?php echo $inc_themes_adm[16]; ?></button>
            <button type="button" class="btn init-box-hide"><span class=" icon-remove-circle"></span> <?php echo $inc_themes_adm[17]; ?></button>
        </form>
    </div>

    <div id="box_cabecera" class="box-hide">
        <br>
        <h4><?php echo $inc_themes_adm[18]; ?></h4>
        <form method="post">
            <textarea rows='8' style="width: 90%; font-family: 'Lucida Console'; font-size: 12px;" id='editar_cabecera' name='editar_cabecera'>
    <?php include "../system/procesos/include-cabecera.php"; ?>
            </textarea>
            <br><br>
            <button type="submit" class="btn"><?php echo $inc_themes_adm[19]; ?></button>
            <button type="button" class="btn init-box-hide"><span class=" icon-remove-circle"></span> <?php echo $inc_themes_adm[20]; ?></button>
        </form>
    </div>

    <div id="box_piedepagina" class="box-hide">
        <br>
        <h4><?php echo $inc_themes_adm[22]; ?></h4>
        <form method="post">
            <textarea rows='8' style="width: 90%; font-family: 'Lucida Console'; font-size: 12px;" id='editar_piedepagina' name='editar_piedepagina'>
    <?php include "../system/procesos/include-piedepagina.php"; ?>
            </textarea>
            <br><br>
            <button type="submit" class="btn"><?php echo $inc_themes_adm[19]; ?></button>
            <button type="button" class="btn init-box-hide"><span class=" icon-remove-circle"></span> <?php echo $inc_themes_adm[20]; ?></button>
        </form>
    </div>
    
    <div id="box_custom_css" class="box-hide">
        <br>
        <h4><?php echo $inc_themes_adm[25]; ?></h4>
        <form method="post">
            <textarea rows='8' style="width: 90%; font-family: 'Lucida Console'; font-size: 12px;" id='editar_custom_css' name='editar_custom_css'>
    <?php include "../bootstrap/css/style.css"; ?>
            </textarea>
            <br><br>
            <button type="submit" class="btn"><?php echo $inc_themes_adm[19]; ?></button>
            <button type="button" class="btn init-box-hide"><span class=" icon-remove-circle"></span> <?php echo $inc_themes_adm[20]; ?></button>
        </form>
    </div>

    <script>
        
        /* 
         * David Torres
         * Para eliminar repeticiones, creamos esta función y luego la llamamos desde cada elemento */
        function showHide(id) {
            var boxes = ["temas", "icono", "instalar_tema", "cabecera","piedepagina", "custom_css"];
            for(var i in boxes){
                if(boxes[i]==id){
                    $("#box_"+boxes[i]).show();
                    $("#btn_"+boxes[i]).addClass("active");
                } else {
                     $("#box_"+boxes[i]).hide();
                     $("#btn_"+boxes[i]).removeClass("active");
                }
            }
        }

        $(function()
        {
            	//iniciar con los boxes ocultos
         $(".box-hide").hide();
		 
            $("#btn_temas").click(function()
            {
                showHide("temas");
            });

            $("#btn_instalar_tema").click(function()
            {
                showHide("instalar_tema");
            });

            $("#btn_icono").click(function()
            {
                showHide("icono");
            });

            $("#btn_cabecera").click(function()
            {
                showHide("cabecera");
            });

            $("#btn_piedepagina").click(function()
            {
                showHide("piedepagina");
            });
            
            $("#btn_custom_css").click(function()
            {
                showHide("custom_css");
            });
            
            /* 
             * David Torres
             * Para que repetir, en una misma funcion añadimos todos 
			 * Mejor a partir de clases para la disminucion de codigo
			*/
			 
            $(".init-box-hide").click(function()
            {
                $(".box-hide").fadeOut(1000);
            });

            $("select option").each(function(index) {
                if ($("select option:eq(" + index + ")").val() == "<?php echo $theme_selected; ?>")
                {
                    $("select option:eq(" + index + ")").attr("selected", true);
                }
            });

        });
        
    </script>
    <?php
}
?>