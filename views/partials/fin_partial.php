<?php
  // treurer els fk_Temas de la BBDD i fer un foreach per a posar-ho / posiblement gastar la clase temas.php
  //require_once 'database/Connection.php';
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
          foreach ($articulos as $tema) {
            if (!in_array($tema->getTema(), $temas)) { // Comprobamos si el tema ya existe en el array
              echo '<li><a href="views/temas.view.php?id=' . $tema->getFk_temas() . '" title="' . $tema->getTema() . '">' . $tema->getTema() . '</a></li>';
              $temas[] = $tema->getTema(); // Añadimos el tema al array auxiliar
            }
          }
        ?>
        
      </ul>
    </article>

    <section class="card">
      <h3>Enllaços</h3><br>
      <div class="social">
        <a title="Facebook" href="https://www.facebook.com/cronista.degata.5" target="_blank">
          <img src="<?=ruta ?>img/facebook-logo.png" class="foto" alt="Facebook">
        </a>
        <a title="Instagram" href="https://www.instagram.com/cronistagata/" target="_blank">
          <img src="<?=ruta ?>img/instagram.png" class="foto" alt="Instagram"/>
        </a>
      </div>
    </section>
  </section>
</main>
  <footer>
    <h4>© Copyright 2022 <a href="<?=ruta ?>">Cronistadegata</a> | By Juanmi</h4>
  </footer>
  <script src="<?=ruta?>js/cargando.js"></script>
  </body>
</html>