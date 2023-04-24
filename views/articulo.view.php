<!--VISTA DE LOS ARTICULOS QUE PASAMOS EL ID DEL ARTICULO SELECCIONADO-->
<?php
  require_once 'partials/inicio_partial.php';
  require_once '../database/Connection.php';
  require_once '../utils/classes/articulo.php';

  try {
    $id = $_GET['id'];
    $connection = Connection::make();

    $sql = "SELECT * FROM articulos WHERE id = $id";
    
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
      <article class="card">
        <?php foreach($articulos as $articulo) :?>
          <strong class="date"><?= $articulo->getFecha()?></strong>
          <div class="cartel">
          <h2><?= $articulo->getTitulo() ?></h2>
            <strong class="temas">en <a class="link" href="<?= ruta.'views/temas.view.php?id='.$articulo->getFk_temas()?>" title="<?= $articulo->getTema(); ?>"><?= $articulo->getTema(); ?></a></strong>
          </div><br>
          <div class="fakeimg"> 
            <a href="<?= ruta .$articulo->getUrlGallery()?>" target="_blank">
              <?php 
                if($articulo->getImagen() !== "sin_imagen.jpg"){
                  echo '<img src="'. ruta.$articulo->getUrlGallery() .'" alt="'.$articulo->getImagen() .'" style="width: 50%; "/>';
                }
              ?>
            </a>
          </div><hr>
          <div class="texto">
            <p><?= $articulo->getTexto();?></p>
          </div>
        <?php endforeach;?>
      </article>
    </section>
<?= include 'partials/fin_partial.php';?>