<?php

  $sentencia = $pdo->prepare("SELECT * FROM temas"); //SELECCIONAMOS TODOS LOS TEMAS.
  $sentencia->execute();
  $articulos = $sentencia->fetchAll(PDO::FETCH_CLASS, 'articulo');
  $page = 1;
?>

  <section class="rightcolumn">
    <article class="card">
      <h2>Qui soc?</h2>
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
          $temas = array(); // Array auxiliar para comprobar temas repetidos.
          $i = 1;
          foreach ($articulos as $tema) {
            if (!in_array($tema->getTema(), $temas)) { // Comprobamos si el tema ya existe en el array
              echo '<li><a href="' . ruta . 'views/temas.view.php?id=' . $i . '" title="' . $tema->getTema() . '">' . $tema->getTema() . '</a></li>';
              $i++;
              $temas[] = $tema->getTema(); // Añadimos el tema al array auxiliar.
            }
          }
        ?>
    
      </ul>
    </article>

    <article class="card">
      <h3>Enllaços</h3><br>
      <div class="social">
        <a title="Facebook" href="https://www.facebook.com/cronista.degata.5" target="_blank">
          <img src="<?= ruta ?>img/facebook-logo.png" class="foto" alt="Facebook">
        </a>
        <a title="Instagram" href="https://www.instagram.com/cronistagata/" target="_blank">
          <img src="<?= ruta ?>img/instagram.png" class="foto" alt="Instagram" />
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
        <script type="text/javascript" src="//www.tiempo.es/widload/ca/ver/280/339/111/es0al0068/dbe0547377eb129ef65e90b1154bcfb4.js"></script>
      </div>
    </article>
  </section>

  </main>

  <footer>
    <h4>© Copyright 2022-2023 <a href="<?= ruta ?>">Cronistadegata</a> | By Juanmi</h4>
  </footer>
  
  <!-- cookies -->
  <div class="cookies hiden">
    <p class="cookiestext">Ús de Cookies: Utilitzem cookies pròpies i
       de tercers per millorar els nostres serveis i mostrar publicitat relacionada amb les seves preferències mitjançant el
       anàlisi dels hàbits de navegació.
       Si continua navegant, considerem que n'accepta l'ús. Podeu obtenir més informació,
       o bé conèixer com canviar la configuració, a les nostres
      <a href="views/politica.view.php" target="_blank">Política de cookies</a>.
    </p>
    <button class="button">Aceptar</button>
  </div>

  <script src="<?= ruta ?>js/main.js"></script>
  <script src="<?= ruta ?>js/cargando.js"></script>
  <script src="<?= ruta ?>js/popper.js"></script>
  <script src="<?= ruta ?>js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>

</html>