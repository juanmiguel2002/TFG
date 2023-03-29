<!--VISTA DE LOS ARTICULOS QUE PASAMOS EL ID DEL TEMA SELECCIONADO-->
<?php
  require_once 'partials/inicio_partial.php';
  require_once '../database/Connection.php';
  require_once '../utils/classes/articulo.php';

  try {
    $temas = $_GET['id'];
    $connection = Connection::make();

    $sql = "SELECT * FROM v_articulos WHERE fk_temas = $temas";
    
    $pdoStatment = $connection->prepare($sql);
    
    if($pdoStatment->execute() === false){
        echo "No se ha podido acceder a la BBDD";
    }else{
        $articulos = $pdoStatment->fetchAll(PDO::FETCH_CLASS, 'articulo');
        //print_r($articulos);
    } 

  }catch(Exception $e){
    echo $e->getMessage();
  }
?>
<main class="row">
  <section class="leftcolumn"> 
    <?php foreach ($articulos as $articulo) :?>
    <article class="card">
        <h2><?php echo $articulo->getFecha() ." ".'<a class="link" href="views/articulo.view.php?id='. $articulo->getId(). '">'.$articulo->getTitulo().'</a>'?></h2>
        <h5 class="temas">en <strong><a class="link" href="<?= $articulo->getFk_temas()?>" title="<?= $articulo->getTema(); ?>"><?= $articulo->getTema(); ?></a></h5></strong>
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