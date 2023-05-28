<?php
  require '../database/base_de_datos.php';
  include 'classes/Paginacion.php';
  include 'classes/articulo.php';
//Si se ha pulsado el botón de buscar

if (isset($_POST['txtbusca'])) {
  $busqueda = $_POST['txtbusca'];//guardamos el campo busqueda pasado por el usuario

  $sentencia = $pdo->query("SELECT COUNT(*) AS conteo FROM articulos WHERE titulo LIKE '%$busqueda%' OR id LIKE '%$busqueda%' AND borrador = 0");
  $total_registros = $sentencia->fetchObject()->conteo;

  $registros_por_pagina = 30;//registros por pagina
  $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

  $paginas_a_mostrar = 10;
  $paginacion = new Paginacion($total_registros, $registros_por_pagina, $pagina_actual, $paginas_a_mostrar);
  $offset = $paginacion->getOffset();
  $limit = $paginacion->getRegistrosPorPagina();
  $total_paginas = $paginacion->getTotalPaginas();
  $pagina_actual = $paginacion->getPaginaActual();
  $paginas_a_mostrar = $paginacion->getPaginasAMostrar();

  $rango_inicio = max($pagina_actual - floor($paginas_a_mostrar / 2), 1);
  $rango_fin = min($rango_inicio + $paginas_a_mostrar - 1, $total_paginas);

  $sql = "SELECT id, titulo, fecha,tema FROM v_articulos WHERE (titulo LIKE '%$busqueda%' OR id LIKE '%$busqueda%') AND borrador = 0 ORDER BY id DESC LIMIT ? OFFSET ?";
  $sentencia = $pdo->prepare($sql);
  $sentencia->execute([$limit, $offset]);

  if ($sentencia !== false) {
    $articulos = $sentencia->fetchAll(PDO::FETCH_CLASS, 'articulo');
  }

?>
  <?php foreach ($articulos as $articulo) : $id = $articulo->getId(); ?>
    <tr>
        <td><?=$articulo->getFecha()?></td>
        <td><?=$articulo->getTitulo()?>
            <br /><strong><i>Publicat en <?= $articulo->getTema()?></i></strong>
        </td>
        <td>
        <?php 
            $sentencia = $pdo->prepare("SELECT borrador from articulos where id = :id");
            $sentencia->bindParam(':id', $id);
    
            if($sentencia->execute()){
                $borrador = $sentencia->fetch(PDO::FETCH_ASSOC);
                $_SESSION['borrador'] = $borrador['borrador'];
                if ($borrador['borrador'] != 1) { ?>
                <a href="editar.php?id=<?= $articulo->getId() ?>" class="btn btn-warning" role="button">Editar</a>
            <?php }else{ ?>
                <a href="editar.php?id=<?= $articulo->getId()?>" role="button"><button class="btn btn-dark">Borrador</button></a>
            <?php  
                }
            }
        ?>
        <a href="eliminar.php?id=<?= $articulo->getId()?>" onclick="return confirm('Vols eliminar l`article?')" class="btn btn-danger" role="button">Eliminar</a> 
        </td>
      </tr>
  <?php endforeach; ?>
<?php
}else{
  //Si no hay registros encontrados
  echo '<tr>';
  echo '<p>No se encuentran resultados con los criterios de búsqueda.</p>';
}
?>