<?php
  define('ruta', 'http://localhost/CronistaGata/');
  session_start();
  if (((isset($_POST['usuario'])  && $_POST['usuario'] != "") && ($_POST['password'] != "" && isset($_POST['password'])))) {
    $_SESSION['user'] = $_POST['usuario'];
    $_SESSION['contra'] = $_POST['password'];
  }

  require '../database/Connection.php';
  require_once '../utils/classes/articulo.php';
  try {
        
    $connection = Connection::make();
    $page = isset($_POST['pagina']);
    
    $sql = "SELECT DISTINCT id, titulo, fecha, tema
    FROM v_articulos
    order by 1 desc
    limit 100";
    
    $pdoStatment = $connection->prepare($sql);
    
    if($pdoStatment->execute() === false){
        echo "No se ha podido acceder a la BBDD";
    }else{
        $articulos = $pdoStatment->fetchAll(PDO::FETCH_CLASS,'articulo');
    }

  }catch(Exception $e){
      echo $e->getMessage();
  }
?>
<!DOCTYPE html>
<html>

<head>
  <title>Cronista de Gata de Gorgos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?= ruta ?>css/panelc.css" rel="stylesheet" type='text/css' />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="<?= ruta ?>img/periodic1.jpg" type="image/jpg" />
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="<?= ruta ?>utils/richtexteditor/rte_theme_default.css" />
</head>

<body style="padding-bottom:3px;align-items:center">
  <header>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">CronistadeGata</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Escriu nou</a></li>
          <li><a href="#">Artículs</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user dropdown"></span>Miguel</a>
            <ul class="dropdown-menu">
              <li><a href="#">Conter</a></li>
              <li><a href="#">Opcions</a></li>
            </ul>
          </li>
          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- CONTENEDOR DONDE SE MOSTRARAN TODOS LOS ARTICULOS -->
  <div class="container">
      <table class="table table-responsive">
        <thead>
            <tr>
                <th>Data</th>
                <th>Articles</th>
                <th>Opcions</th>
            </tr>
        </thead>
        <tbody>
            <?php
              foreach ($articulos as $articulo) : ?>
              <tr>
              <td><?=$articulo->getFecha()?></td>
                <td><?=$articulo->getTitulo()?></td>
                <td><a href="">Editar</a><br>
                <a href="http://">Eliminar</a><br>
                <a href="http://">Borrador</a>
                </td>
              </tr>
                
              <?php endforeach;?>
        </tbody>
      </table>
  </div>



  <div style="margin:auto;padding:12px 6px 36px;max-width:960px;">
    <div class="hs-docs-content-divider">
      <!--Include the JS & CSS-->
      <script type="text/javascript" src="<?= ruta ?>utils/richtexteditor/rte.js"></script>
      <script type="text/javascript" src='<?= ruta ?>utils/richtexteditor/plugins/all_plugins.js'></script>
      <!-- 
      <div id="div_editor1">
      </div> -->

      <script>
        var editor1 = new RichTextEditor("#div_editor1");
        //editor1.setHTMLCode("Use inline HTML or setHTMLCode to init the default content.");
      </script>
      <script>
        RTE_DefaultConfig.url_base = 'richtexteditor'
      </script>
    </div>
  </div>
  <script src="<?= ruta ?>js/editor.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> -->
</body>

</html>