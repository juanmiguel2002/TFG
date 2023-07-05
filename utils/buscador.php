<?php
  require '../database/base_de_datos.php';
  include 'classes/Paginacion.php';
  include 'classes/articulo.php';
//Si se ha pulsado el botón de buscar

if(isset($_POST['txtbusca'])):

  $sentencia = $pdo->query("SELECT count(*) AS conteo FROM articulos");
  $total_registros = $sentencia->fetchObject()->conteo;

  $registros_por_pagina = 40; #Cuántos registros mostrar por página
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
  
  $sql = "SELECT id, titulo, fecha, concat(substr(texto,1,258),'... ') as texto, fk_temas, tema, imagen 
  FROM v_articulos WHERE titulo like '%".$_POST['txtbusca']."%' and borrador = 0 order by 1 desc  LIMIT ? OFFSET ?";
  $sentencia = $pdo->prepare($sql);
  $sentencia->execute([$limit, $offset]);
  if ($sentencia !== false)
    $articulos = $sentencia->fetchAll(PDO::FETCH_CLASS,'articulo');
  ?>

  <?php foreach ($articulos as $articulo) : ?>
    <article class="card">
      <h2><?php echo $articulo->getFecha() . " " . '<a class="link"href="views/articulo.view.php?id=' . $articulo->getId() . '">' . $articulo->getTitulo() .'</a>'?> </h2>
      <p class="temas">en <strong><?php echo '<a class="link" href="views/temas.view.php?id=' . $articulo->getFk_temas() . '"' . 'title=" $articulo->getTema();">' . $articulo->getTema() . '</a>' ?></p></strong>
      <div class="fakeimg">
        <?php
          if ($articulo->getImagen() != "sin_imagen.jpg") {
            echo '<img src="' . $articulo->getUrlGallery() . '" alt="' . $articulo->getImagen() . '"/>';
          }
        ?>
      </div>
      <p class="texto">
        <?php
          if ($articulo->getTexto() != "") {
            echo $articulo->getTexto() . '<a class="link" href="views/articulo.view.php?id=' . $articulo->getId() . '"> Llegir més </a>';
          }
        ?>
      </p>
    </article>
  <?php endforeach; ?>
<?php
else:?>
  <article class="card">
  <h2>No se encuentran resultados con los criterios de búsqueda.</h2>
  </article>
<?php endif; ?>