<!--VISTA DE LOS ARTICULOS QUE PASAMOS EL ID DEL TEMA SELECCIONADO FALLO AL HACER LA PAGINACIÓN-->
<?php
  //define('ruta', 'http://localhost/CronistaGata/');
  require_once "../database/base_de_datos.php";
  require_once '../utils/classes/articulo.php';
  require_once '../utils/classes/Paginacion.php'; 
  require_once '../utils/classes/contador.php'; 
  require_once 'partials/inicio_partial.php';

  $temas = $_GET['id'];//recogemos el id del tema para sacar los articulos del tema pasado

  $sentencia = $pdo->query("SELECT count(*) AS conteo FROM v_articulos where fk_temas = $temas"); // contamos el total de articulos del tema
  $total_registros = $sentencia->fetchObject()->conteo;

  $registros_por_pagina = 40; #Cuántos registros mostrar por página
  $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

  $paginas_a_mostrar = 10; #paginas a mostrar por página 
  $paginacion = new Paginacion($total_registros, $registros_por_pagina, $pagina_actual, $paginas_a_mostrar);
  $offset = $paginacion->getOffset(); # El offset es saltar X productos que viene dado por multiplicar la página - 1 * los productos por página
  
  $limit = $paginacion->getRegistrosPorPagina(); # El límite es el número de productos por página
  $total_paginas = $paginacion->getTotalPaginas();
  //$pagina_actual = $paginacion->getPaginaActual();
  $paginas_a_mostrar = $paginacion->getPaginasAMostrar();

  $rango_inicio = max($pagina_actual - floor($paginas_a_mostrar / 2), 1);
  $rango_fin = min($rango_inicio + $paginas_a_mostrar - 1, $total_paginas);
  
    # Ahora obtenemos los productos usando ya el OFFSET y el LIMIT
  $sentencia = $pdo->prepare("SELECT id, titulo, fecha, concat(substr(texto,1,255),'...') as texto, tema, imagen FROM v_articulos WHERE fk_temas = $temas order by 1 desc LIMIT ? OFFSET ?");
  $sentencia->execute([$limit, $offset]);
  $articulos = $sentencia->fetchAll(PDO::FETCH_CLASS,'articulo');
  
?>

<main class="row">
<?php include "paginacion.view.php";?>
  <section class="leftcolumn"id="buscador"> <!-- Contenedor donde se mostraran los resultados de la busqueda-->
    <?php foreach ($articulos as $articulo) :?>
    <article class="card">
        <h2><?php echo $articulo->getFecha() ." ".'<a class="link" href="articulo.view.php?id='. $articulo->getId(). '">'.$articulo->getTitulo().'</a>'?></h2>
        <h5 class="temas">en <strong><a class="link" href="<?= $articulo->getFk_temas()?>" title="<?= $articulo->getTema(); ?>"><?= $articulo->getTema(); ?></a></h5></strong>
        <div class="fakeimg">
          <?php 
            if($articulo->getImagen() !== "sin_imagen.jpg"){
              echo '<img loading="lazy" class="lazy" data-src="'.ruta. $articulo->getUrlGallery() .'" alt="'.$articulo->getImagen() .'"   "/>';
            }
          ?>
        </div>
        <p style="font-size: 16px;">
          <?php
          if ($articulo->getTexto() != "") {
            echo $articulo->getTexto() . '<a class="link" href="articulo.view.php?id=' . $articulo->getId() . '"> Llegir més </a>';
          }
        ?>
        </p>
      </article>
      <?php endforeach; 
      include "paginacion.view.php" ?>
</section>
<?= require_once 'partials/fin_partial.php';