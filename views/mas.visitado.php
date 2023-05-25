<?php 
    require 'partials/inicio_partial.php';
    require_once "../database/base_de_datos.php";
    require_once '../utils/classes/articulo.php';
    require_once '../utils/classes/Paginacion.php'; 
    require_once '../utils/classes/contador.php'; 
    $contador = new Contador($pdo);
    $sentencia = $pdo->query("SELECT count(*) AS conteo FROM articulos");
    $total_registros = $sentencia->fetchObject()->conteo;

    $registros_por_pagina = 20; #Cuántos registros mostrar por página
    $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    $paginas_a_mostrar = 10;
    $paginacion = new Paginacion($total_registros, $registros_por_pagina, $pagina_actual, $paginas_a_mostrar);
    $offset = $paginacion->getOffset(); # El offset es saltar X productos que viene dado por multiplicar la página - 1 * los productos por página
    
    $limit = $paginacion->getRegistrosPorPagina(); # El límite es el número de productos por página
    $total_paginas = $paginacion->getTotalPaginas();
    $pagina_actual = $paginacion->getPaginaActual();
    $paginas_a_mostrar = $paginacion->getPaginasAMostrar();

    $rango_inicio = max($pagina_actual - floor($paginas_a_mostrar / 2), 1);
    $rango_fin = min($rango_inicio + $paginas_a_mostrar - 1, $total_paginas);

    $sentencia = $pdo->prepare("SELECT id, titulo, fecha, concat(substr(texto,1,250),'... ') as texto, fk_temas, tema, imagen FROM v_articulos order by visitas desc LIMIT ? OFFSET ?");
    $sentencia->execute([$limit, $offset]);
    $articulos = $sentencia->fetchAll(PDO::FETCH_CLASS,'articulo');

?>
<?php 
  include "paginacion.view.php"; ?>
<main class="row">
<section class="leftcolumn" >
  <?php foreach ($articulos as $articulo) : ?>
    <article class="card">
        <p class="contador"> <?=$contador->obtenerVisitas($articulo->getId()). " visites"?></p> 
      <h2><?php echo $articulo->getFecha() . " " . '<a class="link" href="articulo.view.php?id=' . $articulo->getId() . '">' . $articulo->getTitulo() . '</a> '?></h2>
      <h5 class="temas">en <strong><?php echo '<a class="link" href="temas.view.php?id=' . $articulo->getFk_temas() . '"' . 'title=" $articulo->getTema();">' . $articulo->getTema() . '</a>' ?></h5></strong>
      <div class="fakeimg">
        <?php
            if ($articulo->getImagen() != "sin_imagen.jpg") {
            echo '<img class="lazy" loading="lazy" data-src="'. ruta . $articulo->getUrlGallery() . '" alt="' . $articulo->getImagen() . '"/>';
            }
        ?>
      </div>
      <p class="texto">
        <?php
            if ($articulo->getTexto() != "") {
            echo $articulo->getTexto() . '<a class="link" href="articulo.view.php?id=' . $articulo->getId() . '"> Llegir més </a>';
            }
        ?>
      </p>
    </article>
  <?php endforeach; 
  include "paginacion.view.php"; ?>
</section>
<?php include 'partials/fin_partial.php'; ?>