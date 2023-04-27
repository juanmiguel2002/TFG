<?php
  // treurer els fk_Temas de la BBDD i fer un foreach per a posar-ho / posiblement gastar la clase temas.php
  //zinclude '../../database/Connection.php';
  // require_once ruta.'utils/classes/articulo.php';

  try {

    $connection = Connection::make();

    $sql = "SELECT * from temas";//selecionamos todo los datos para mostrarlos en la página principal
    
    $pdoStatment = $connection->prepare($sql);
    
    if($pdoStatment->execute() === false){
        echo "No se ha podido acceder a la BBDD";
    }else{
        $articulos = $pdoStatment->fetchAll(PDO::FETCH_CLASS , "articulo");
    } 
    
  }catch(Exception $e){
    echo $e->getMessage();
  }
?>

<section class="rightcolumn">
    <article class="card">
      <h2>Quí soc?</h2>
      <div>
        <img src="<?= ruta ?>img/portada.jpg" alt="portada" class="imagen" />
      </div>
      <cite>Estimant el nostre poble i a la nostra gent</cite>
    </article>
    <!--Temes-->
    <article class="card">
      <h3>Temes</h3>
      <ul id="temas">
        <?php
          $temas = array(); // Array auxiliar para comprobar temas repetidos
          $i=1;
          foreach ($articulos as $tema) {
            if (!in_array($tema->getTema(), $temas)) { // Comprobamos si el tema ya existe en el array
              echo '<li><a href="'.ruta.'views/temas.view.php?id=' . $i. '" title="' . $tema->getTema() . '">' . $tema->getTema() . '</a></li>';
              $i++;
              $temas[] = $tema->getTema(); // Añadimos el tema al array auxiliar
            }
          }
        ?>
        
      </ul>
    </article>

    <article class="card">
      <h3>Enllaços</h3><br>
      <div class="social">
        <a title="Facebook" href="https://www.facebook.com/cronista.degata.5" target="_blank">
          <img src="<?=ruta ?>img/facebook-logo.png" class="foto" alt="Facebook">
        </a>
        <a title="Instagram" href="https://www.instagram.com/cronistagata/" target="_blank">
          <img src="<?=ruta ?>img/instagram.png" class="foto" alt="Instagram"/>
        </a>
      </div>
    </article>

    <article class="card">
      <h3>El temps</h3><br>
      <div id="tiempo_dbe0547377eb129ef65e90b1154bcfb4">
        <div></div>
        <div> 
          <img src="//www.tiempo.es/build/img/logo/tiempo133.png" width="50" height="18" alt="tiempo.es"> 
        </div> 
        <script type="text/javascript" src="//www.tiempo.es/widload/ca/ver/290/339/111/es0al0068/dbe0547377eb129ef65e90b1154bcfb4.js"></script>
      </div>
    </article>
  </section>
</main>
  <footer>
    <h4>© Copyright 2022-2023 <a href="<?=ruta ?>">Cronistadegata</a> | By Juanmi</h4>
  </footer>
  <script src="<?=ruta?>js/cargando.js"></script>
  </body>
</html>