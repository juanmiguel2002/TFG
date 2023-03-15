<?php define('ruta','http://localhost/CronistaGata/'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Cronista de Gata</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <link href="<?=ruta?>css/contact.css" rel="stylesheet" type='text/css'/>
  <link rel="shortcut icon" href="<?=ruta?>img/periodic1.jpg" type="image/jpg"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <header>
    <h1 class="titulo">Cronista de Gata de Gorgos</h1>
  </header>
  <nav class="navbar" id="myTopnav">
      <img class="logo" src="<?=ruta?>img/logo1.png" width="76" alt="Cronistadegata"/>
      <a href="<?=ruta?>index.php">Home</a>
      <a href="articulosDesta.html">Destacats</a>
      <a href="contact.html">Contacte</a>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
  </nav>
  <main class="container">
    <section class="content">
      <article class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i> 
          <div class="topic">Direcció</div>
          <div class="text-two">Gata de Gorgos, Alacant</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Teléfon</div>
          <div class="text-one">+34 636 03 97 24</div>
          <div class="text-two">+34 686 80 02 71</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">mivisig@gmail.com</div>
          <div class="text-two">juanmi0802@gmail.com</div>
        </div>
      </article>
      <article class="right-side">
        <div class="topic-text">Envian's un Correu</div>
        <p>Si vols colaborar o aportar alguna informació/imatges no duptes en contactar en el Cronistadegata.</p>
      <form action="#">
        <div class="input-box">
          <input type="text" placeholder="Nom">
        </div>
        <div class="input-box">
          <input type="email" placeholder="Email" required>
        </div>
        <div class="input-box message-box">
            <textarea rows="4" cols="50" placeholder="text"></textarea>
        </div>
        <div class="button">
          <input type="submit" value="Enviar" >
        </div>
      </form>
    </article>
    </section>
  </main>

  <footer class="container">
    <h4>© Copyright 2022 <a href="index.html">Cronistadegata</a> | By Juanmi</h4>
  </footer>

  <script src="<?=ruta?>js/menu.js"></script>
</body>
</html>