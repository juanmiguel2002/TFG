<?php

  include_once "views/partials/inicio_partial.php";
  require_once "database/base_de_datos.php"; # Incluimos la conexión
  require_once 'utils/classes/articulo.php';
  require_once 'utils/classes/Paginacion.php'; 

  $sentencia = $pdo->query("SELECT count(*) AS conteo FROM articulos");
  $total_registros = $sentencia->fetchObject()->conteo;

  $registros_por_pagina = 50; #Cuántos registros mostrar por página
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
  
  # Ahora obtenemos los productos usando ya el OFFSET y el LIMIT
  $sentencia = $pdo->prepare("SELECT id, titulo, fecha, concat(substr(texto,1,258),'... ') as texto, fk_temas, tema, imagen FROM v_articulos order by 1 desc LIMIT ? OFFSET ?");
  $sentencia->execute([$limit, $offset]);
  $articulos = $sentencia->fetchAll(PDO::FETCH_CLASS,'articulo');

?>
    <main class="row">
        <?php include 'views/articulos.view.php'; ?>