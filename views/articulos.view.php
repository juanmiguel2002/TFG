<!-- VISTA DE TODOS LOS ARTICULOS DE LA BASE DE DATOS -->

<section class="leftcolumn" id="buscador"><!-- Contenedor donde se mostraran los resultados de la busqueda -->
  
  <?php foreach ($articulos as $articulo) : ?>
    <article class="card">
      <h2><?php echo $articulo->getFecha() . " " . '<a class="link"href="views/articulo.view.php?id=' . $articulo->getId() . '">' . $articulo->getTitulo() .'</a>'?> </h2>
      <p class="temas">en <strong><?php echo '<a class="link" href="views/temas.view.php?id=' . $articulo->getFk_temas() . '"' . 'title=" $articulo->getTema();">' . $articulo->getTema() . '</a>' ?></p></strong>
      <div class="fakeimg">
        <?php
          if ($articulo->getImagen() != "sin_imagen.jpg") { //comprobamos que la imagen no esta vacia  y esta le asignamos sin_imagen.jpg
            echo '<img loading="lazy" data-src="' . $articulo->getUrlGallery() . '" alt="' . $articulo->getImagen() . '"/>';
          }
        ?>
      </div>
      <p class="texto">
        <?php #comprobamos que el texto no esta vacio
          if ($articulo->getTexto() != "") {
            echo $articulo->getTexto() . '<a class="link" href="views/articulo.view.php?id=' . $articulo->getId() . '"> Llegir més </a>';
          }
        ?>
      </p>
    </article>
  
  <?php endforeach;

  include "paginacion.view.php"; ?>
</section>

<?php include_once "partials/fin_partial.php"; ?>
