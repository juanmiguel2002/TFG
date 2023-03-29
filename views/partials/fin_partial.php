<?php
  
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
        <?php echo '<li><a href='.'views/temas.view.php?id=1'. $articulo->getFk_temas() .' title="250 ANYS: ERMITA I CRIST">250 ANYS: ERMITA I CRIST</a></li>'?>
        <li><a href="" title="ACTES">ACTES</a></li>
        <li><a href="" title="AHIR...HUI, SEMPRE GATA">AHIR...HUI, SEMPRE GATA</a></li>
        <li><a href="" title="ARTICLES DESTACATS">ARTICLES DESTACATS</a></li>
        <li><a href="" title="ARTICLES FESTES">ARTICLES FESTES</a></li>
        <li><a href="" title="Notícies del poble de 1987 a ara">COM ERA GATA FA...</a></li>
        <li><a href="" title="">COM ES VA FER...?</a></li>
        <li><a href="" title="">COSTUMS</a></li>
        <li><a href="" title="">CRONISTA...FA UN ANY</a></li>
        <li><a href="" title="">CRONISTA</a></li>
        <li><a href="" title="">DIARI GATER DE 33 ANYS (1987-2020)</a></li>
        <li><a href="" title="">EL GUARDIÁ DEL MONTGÓ</a></li>
        <li><a href="" title="">ELECCIONS 2011</a></li>
        <li><a href="" title="">ELECCIONS 2015</a></li>
        <li><a href="" title="">ELECCIONS 2016</a></li>
        <li><a href="" title="">ELECCIONS 2019,1</a></li>
        <li><a href="" title="">ELECCIONS 2019,2</a></li>
        <li><a href="" title="">ELS NOSTRES CARRERS I PLACES</a></li>
        <li><a href="" title="">ESPORTS</a></li>
        <li><a href="" title="">FESTES</a></li>
        <li><a href="" title="Gata en el record">FOTOS ANTIGUES...I D'ABANS</a></li>
        <li><a href="" title="">GATERS DESTACATS</a></li>
        <li><a href="" title="">GATERS FORA</a></li>
        <li><a href="" title="">HISTÓRIA LOCAL</a></li>
        <li><a href="" title="">IMATGES CURIOSES</a></li>
        <li><a href="" title="">IMATGES DE FESTA</a></li>
        <li><a href="" title="">MIRADES URBANES</a></li>
        <li><a href="">NOTÍCIES</a></li>
        <li><a href="">OBITUARIS</a></li>
        <li><a href="" title="">PUBLICACIONS OFICIALS</a></li>
        <li><a href="" title="">RACÓ LITERARI GATER</a></li>
        <li><a href="" title="">RECORDEM...UN ANY...</a></li>
        <li><a href="" title="">RECORDS: Gata i món</a></li>
        <li><a href="">RUTES</a></li>
        <li><a href="" title="">SANTS I REFRANYS</a></li>
        <li><a href="" title="">TEMPS DE BETLEMS, ARBRES,...</a></li>
        <li><a href="">TEMPS</a></li>
        <li><a href="" title="">UN MOSSET D'HISTÓRIA GATERA CADA DIA</a></li>
        <li><a href="" title="">SABIEU...?</a></li>
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