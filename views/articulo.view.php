<!--VISTA DE LOS ARTICULOS QUE PASAMOS EL ID DEL ARTICULO SELECCIONADO-->
<?php
  require_once 'partials/inicio_partial.php';
  require_once "../database/base_de_datos.php";
  require_once '../utils/classes/articulo.php';

  $id = $_GET['id'];

  $sentencia = $pdo->prepare("SELECT * FROM v_articulos WHERE id = $id");
  $sentencia->execute();
  $articulos = $sentencia->fetchAll(PDO::FETCH_CLASS,'articulo');
  if (!is_numeric($id) || $id < 1 || $id > 15000) {
    header("HTTP/1.0 404 Not Found");
    include("./utils/404.php");
    exit();
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
                  echo '<img src="'. ruta.$articulo->getUrlGallery() .'" alt="'.$articulo->getImagen() .'"/>';
                }
              ?>
            </a>
          </div><hr>
          <div class="texto">
            <p class="primero"> <?= $articulo->getTexto();?></p>
          </div>
        <?php endforeach;?>
      </article>
    </section>
<?php include 'partials/fin_partial.php';?>