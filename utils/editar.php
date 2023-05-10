<?php

    define('ruta', 'http://localhost/CronistaGata/');
    $id = $_GET['id'];
    require_once '../database/base_de_datos.php';
    require_once '../utils/classes/articulo.php';
    
    $sentencia = $pdo->query("SELECT texto FROM v_articulos where id = $id");
    $sentencia->execute();
    $articulos = $sentencia->fetchAll(PDO::FETCH_CLASS,'articulo');
    //print_r($articulos[0]->getTexto());
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Artícul</title>
        <link rel="stylesheet" href="<?= ruta ?>utils/richtexteditor/rte_theme_default.css" />
    </head>
    <body>
    
    <div style="margin:auto;padding:12px 6px 36px;max-width:960px;">
        <div class="hs-docs-content-divider">
          <!--Include the JS & CSS-->
          <script type="text/javascript" src="<?= ruta ?>utils/richtexteditor/rte.js"></script>
          <script type="text/javascript" src='<?= ruta ?>utils/richtexteditor/plugins/all_plugins.js'></script>
          
          <div id="div_editor1">
          </div>
    
          <script>
            var editor1 = new RichTextEditor("#div_editor1");
            editor1.setHTMLCode("<?= $articulos[0]->getTexto() ?>");      
            //editor1.collapse(false);
            
          </script>
          <script>
            RTE_DefaultConfig.url_base = 'richtexteditor'
          </script>
        </div>
      </div>
      <script src="<?= ruta ?>js/editor.js"></script>
    </body>
    </html>