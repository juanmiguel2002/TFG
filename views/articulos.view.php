<?php 
  // require_once 'database/Connection.php';
  // require_once 'utils/classes/articulo.php';

  // try {
  //   $connection = Connection::make();

  //   $sql = "SELECT *
  //   FROM v_articulos";
    
  //   $pdoStatment = $connection->prepare($sql);
    
  //   if($pdoStatment->execute() === false){
  //       echo "No se ha podido acceder a la BBDD";
  //   }else{
  //       $articulos = $pdoStatment->fetchAll(PDO::FETCH_CLASS,'articulo');
  //   }

  // }catch(Exception $e){
  //     echo $e->getMessage();
  // }
  //coger 255 caracteres, buscar el ultimo punto
?>

<main class="row">
  <section class="leftcolumn"> 
    <?php foreach ($articulos as $articulo) :?>
    <article class="card">
        <h2><?php echo $articulo->getFecha() ." ".'<a class="link" href="views/articulo.view.php?id='. $articulo->getId(). '">'.$articulo->getTitulo().'</a>'?></h2>
        <h5 class="temas">en <strong><a  class="link" href="<?= $articulo->getTema()?>" title=""><?= $articulo->getTema(); ?></a></h5></strong>
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
        
        ?></p>
      </article>
    <?php endforeach;?>
  </section>