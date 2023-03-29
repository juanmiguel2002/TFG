<!-- VISTA DE TODOS LOS ARTICULOS DE LA BASE DE DATOS -->

<main class="row">
  <section class="leftcolumn"> 
    <?php foreach ($articulos as $articulo) :?>
    <article class="card">
        <h2><?php echo $articulo->getFecha() ." ".'<a class="link" href="views/articulo.view.php?id='. $articulo->getId(). '">'.$articulo->getTitulo().'</a>'?></h2>
        <h5 class="temas">en <strong><?php echo '<a class="link" href="views/temas.view.php?id='. $articulo->getFk_temas(). '"'.'title=" $articulo->getTema();">'. $articulo->getTema(). '</a>'?></h5></strong>
        <div class="fakeimg">
          <?php 
            if($articulo->getImagen() != "sin_imagen.jpg"){
              echo '<img  class="lazy" data-src="'. $articulo->getUrlGallery() .'" alt="'.$articulo->getUrlGallery() .'" style="width: 50%; "/>';
            }
          ?>
        </div>
        <p style="font-size: 16px;">
          <?php
            if ($articulo->getTexto() != "") {
              echo $articulo->getTexto();
            }
          ?>
        </p>
      </article>
    <?php endforeach;?>
  </section>