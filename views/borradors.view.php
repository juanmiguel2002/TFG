<?php
  define('ruta', 'http://localhost/CronistaGata/');
  session_start();
  if (((isset($_POST['usuario'])  && $_POST['usuario'] != "") && ($_POST['password'] != "" && isset($_POST['password'])))) {
    $_SESSION['user'] = $_POST['usuario'];
    $_SESSION['contra'] = $_POST['password'];
  }

  require '../database/base_de_datos.php';
  require_once '../utils/classes/Paginacion.php'; 
  require_once '../utils/classes/articulo.php';

  $sentencia = $pdo->query("SELECT count(*) AS conteo FROM articulos");
  $total_registros = $sentencia->fetchObject()->conteo;

  $registros_por_pagina = 50; #Registros mostrar por página.
  $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

  $paginas_a_mostrar = 15;
  $paginacion = new Paginacion($total_registros, $registros_por_pagina, $pagina_actual, $paginas_a_mostrar);
  $offset = $paginacion->getOffset(); # El offset es saltar X productos que viene dado por multiplicar la página - 1 * los productos por página
  
  $limit = $paginacion->getRegistrosPorPagina(); # El límite es el número de productos por página
  $total_paginas = $paginacion->getTotalPaginas();
  $pagina_actual = $paginacion->getPaginaActual();
  $paginas_a_mostrar = $paginacion->getPaginasAMostrar();

  $rango_inicio = max($pagina_actual - floor($paginas_a_mostrar / 2), 1);
  $rango_fin = min($rango_inicio + $paginas_a_mostrar - 1, $total_paginas);
  
    # Ahora obtenemos los productos usando ya el OFFSET y el LIMIT
  $sentencia = $pdo->prepare("SELECT DISTINCT id, titulo, fecha, tema FROM v_articulos where borrador = 1 order by 1 desc LIMIT ? OFFSET ?");
  $sentencia->execute([$limit, $offset]);
  $articulos = $sentencia->fetchAll(PDO::FETCH_CLASS,'articulo');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <title>Cronista de Gata de Gorgos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?= ruta ?>css/panelc.css" rel="stylesheet" type='text/css' />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="<?= ruta ?>img/periodic1.jpg" type="image/jpg" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">  
</head>

<body style="padding-bottom:2px;align-items:center">
  <header>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?=ruta?>">CronistadeGata</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="panelControl.php">Home</a></li>
          <li><a href="nuevo.articulo.php">Escriu nou</a></li>
          <li><a href="temas.php">Temes</a></li>
          <li><a href="../views/borradors.view.php">Borradors</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user dropdown"></span>Miguel</a>
            <ul class="dropdown-menu">
              <li><a href="#">Conter</a></li>
              <li><a href="#">Opcions</a></li>
            </ul>
          </li>
          <li><a href="../utils/CerrarSession.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
      </div>
    </nav>
    <!-- BOTON HACIA ARRIBA -->
    <a class="ir-arriba" javascript:void(0) title="Volver arriba">
      <span class="fa-stack">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-arrow-up fa-stack-1x fa-inverse"></i>
      </span>
    </a>
  </header>
  <!-- CONTENEDOR DONDE SE MOSTRARAN TODOS LOS ARTICULOS -->
  <div class="container">
    <div class="form-inline my-2 my-lg-0" >
      <input class="form-control mr-sm-2" type="text" name="campo" id="campo" placeholder="Buscar">
      
      <!-- <button class="btn btn-outline-success my-2 my-sm-0">Buscar</button> -->
    </div>
    <table class="table table-responsive" >
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
            <td><?=$articulo->getTitulo()?>
              <br><strong><i>Publicat en <?= $articulo->getTema()?></i></strong>
            </td>
            <td>
            <a href="editar.php?id=<?= $articulo->getId() ?>"><button type="button" class="btn btn-warning">Editar</button></a>
            <a href="eliminar.php?id=<?= $articulo->getId() ?>" onclick="return confirm('Vols eliminar l`article?')"><button type="button" class="btn btn-danger">Eliminar</button></a>      
            <a href="borrador.php?id=<?= $articulo->getId()?>" class="btn btn-secondary">Borrador</a>
            </td>
          </tr>
          <?php endforeach;?>
      </tbody>
    </table>
    <?php include "paginacion.view.php"; ?>
  </div>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
  <script src="<?= ruta ?>js/main.js"></script>
  <!-- <script src="<?= ruta ?>js/load.js"></script> -->
</body>
</html>