<div>
    <!-- <div class="col-xs-12 col-sm-6">
      <p>Mostrando <?php //echo $registros_por_pagina ?> de <?php //echo $total_registros ?> Artículs Disponibles</p>
    </div> -->
    <div class="col-xs-12 col-sm-6">
      <p>Página <?php echo $pagina_actual ?> de <?php echo $total_paginas ?> </p>
    </div>
</div>
<nav>

  <ul class="pagination">
  <?php 
  $id = "";
  if (isset($temas)){

    $id = "&id=". $temas;
  }
  ?>

    <!-- Si la página actual es igual a uno, no mostramos el botón para ir una página atrás de lo contrario si lo mostramos -->
    <?php if ($pagina_actual == 1) { ?>
      <li>
        <a href="#" aria-disabled="false">
          <span aria-hidden="true" >&laquo;</span>
        </a>
      </li>
    <?php } else{ ?>
      <li>
        <a href="?pagina=<?php echo $pagina_actual - 1 . $id?> ">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
    <?php } ?>

    <!-- Mostramos enlaces para ir a todas las páginas. Es un simple ciclo for-->
    <?php
      for ($i = $rango_inicio; $i <= $rango_fin; $i++) {
        if ($i == $pagina_actual || $i == $rango_inicio) {
          echo '<li class="active"><a href="#">' . $i . '</a></li>';
        } else {
          echo '<li><a href="?pagina=' . $i . $id.'">' . $i . '</a></li>';
        }
      }
    ?>

    <!-- Si la página actual es igual al total de páginas, mostramos un botón para ir una página adelante desactivado, de lo contrario le sumamos 1 a la pagina_actual -->
    <?php if ($pagina_actual == $total_paginas) { ?>
      <li>
        <a href="#" aria-disabled="false">
          <span aria-hidden="true" >&raquo;</span>
        </a>
      </li>
    <?php }else {?>
      <li>
        <a href="?pagina=<?php echo $pagina_actual + 1 ?><?php echo $id?> ">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
      
    <?php } ?>
  </ul>
</nav>