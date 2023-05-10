<?php 
  define('ruta','http://localhost/CronistaGata/'); 
  require '../database/Connection.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Cronista de Gata</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <link href="<?=ruta?>css/contact.css" rel="stylesheet" type='text/css'/>
  <link href="<?=ruta?>css/menu.css" rel="stylesheet" type='text/css'/>
  <link rel="shortcut icon" href="<?=ruta?>img/periodic1.jpg" type="image/jpg"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
</head>

<body>
  <header>
    <h1 class="ti tulo">Cronista de Gata de Gorgos</h1>
  </header>

  <nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="<?=ruta?>index.php"><img class="logo" src="<?=ruta?>img/logo1.png" width="69" alt="CronistadeGata"/></a>	
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
      aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="fa fa-bars"></span> Menu
    </button>
    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav">
        <li class="nav-item active"><a href="<?=ruta?>index.php" class="nav-link">Home</a></li>
      </ul>                            
    </div>
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
          <div class="text-one"><a href="mailto:mivisig@gmail.com">mivisig@gmail.com</a></div>
          <div class="text-two"><a href="mailto:juanmi0802@gmail.com">juanmi0802@gmail.com</a></div>
        </div>
      </article>
      <article class="right-side">
        <div class="topic-text">Envian's un Correu</div>
        <p>Si vols colaborar o aportar alguna informació/imatges no duptes en contactar en el Cronistadegata.</p>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
        <div class="input-box">
          <input type="text" placeholder="Nom" name="nom">
        </div>
        <div class="input-box">
          <input type="email" placeholder="Email" required name="email">
        </div>
        <div class="input-box message-box">
            <textarea rows="4" cols="50" placeholder="text" name="texto"></textarea>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" name="check"> Acepta les Condicions 
        </div>
        
        <div class="button">
          <input type="submit" value="Enviar" >
        </div>
      </form>
      <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['nom'] = $_POST['nom'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['texto'] = $_POST['texto'];
        
        require_once '../utils/classes/enviarMail.php';
      }
      ?>
    </article>
    </section>
  </main>

  <footer class="container">
    <h4>© Copyright 2022-2023<a href="../index.php">Cronistadegata</a> | By Juanmi</h4>
  </footer>
  <script src="<?=ruta?>js/jquery.min.js"></script>
	<script src="<?=ruta?>js/popper.js"></script>
	<script src="<?=ruta?>js/bootstrap.min.js"></script>
	<script src="<?=ruta?>js/main.js"></script>
</body>
</html>