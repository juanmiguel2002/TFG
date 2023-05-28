<?php 
   define('ruta','http://localhost/CronistaGata/'); 
   require_once('../database/base_de_datos.php');

   $exito ="";
   $error = "";
  
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $_SESSION['nombre'] = $_POST['nombre'];
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['texto'] = $_POST['texto'];
      $_SESSION['imagenes'] = $_FILES['imagenes'];
      $fecha = date('Y-m-d');
    if (!isset($_POST['suscrito'])) {// comprobamos si no existe el checkbox de suscrito
      $sentencia = $pdo->prepare('INSERT INTO suscriptores (id, nombre, email,fecha) VALUES (DEFAULT, :nombre, :email,:fecha)'); 
      $sentencia->bindValue(':nombre', $_POST['nombre']);
      $sentencia->bindValue(':email', $_POST['email']);
      $sentencia->bindValue(':fecha', $fecha);
      $sentencia->execute();

    } else {// si existe el suscrito se inserta en la tabla de suscriptores con suscrito = 1
      
      $_SESSION['suscrito'] = $_POST['suscrito'];
      $sentencia = $pdo->prepare("INSERT INTO suscriptores (id, nombre, email, suscrito, fecha) VALUES (DEFAULT, :nombre, :email, :suscrito,:fecha)");  
      $sentencia->bindValue(':nombre', $_POST['nombre']);
      $sentencia->bindValue(':email', $_POST['email']);
      $sentencia->bindValue(':suscrito', $_SESSION['suscrito']);
      $sentencia->bindValue(':fecha', $fecha);
      $sentencia->execute();
      
    } 
    $sentencia = $pdo->prepare("SELECT id FROM suscriptores order by id desc");//seleccionamos el id de la tabla suscriptores 
    $sentencia->execute();
    $id = $sentencia->fetch(PDO::FETCH_OBJ)->id;
    $_SESSION['id'] = $id;
  
    require('../utils/classes/enviarEmail.php');
  } 
?>

<html>
<head>
  <title>Cronista de Gata - Contacte</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <link href="<?=ruta?>css/contact.css" rel="stylesheet" type='text/css'/>
  <link href="<?=ruta?>css/menu.css" rel="stylesheet" type='text/css'/>
  <link rel="shortcut icon" href="<?= ruta?>img/periodic1.jpg" type="image/jpg"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>
  <header>
    <h1 class="titulo">Cronista de Gata de Gorgos</h1>
  </header>

  <nav class="navbar navbar-expand-lg">
    <a href="javascript:history.back();" class="btn btn-default">
      <span class="glyphicon glyphicon-chevron-left"></span> Volver
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
      aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="fa fa-bars"></span> Menu
    </button>
    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav">
        <li class="nav-item active"><a href="<?= ruta?>index.php" class="nav-link">Home</a></li>
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
            <input type="text" placeholder="Nom" name="nombre" required>
          </div>
          <div class="input-box">
            <input type="email" placeholder="Email" required name="email">
          </div>
          <div class="input-box message-box">
              <textarea rows="4" cols="50" placeholder="text" name="texto"></textarea>
          </div>
          <div class="form-group">
            <label for="subirimg">Puja les imatges</label>
            <input type="file" id="imagen" name="imagenes[]" multiple> 
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" name="suscrito"> Suscribiste al blog.
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" name="check" required><a href="politica.view.php"> Acepte les Condicions </a> 
          </div>
          <?php $resultado = isset($sentencia) ? 
          '<div class="alert alert-success" role="alert">'. $exito.'</div>' : ""; ?>        
          <div class="button">
            <input type="submit" value="Enviar" />
          </div>
        </form>
    </article>
    </section>
  </main>

  <footer class="container">
    <h4 class="text-center">© Copyright 2022-2023 <a href="../index.php"> Cronistadegata</a> | By Juanmi</h4>
  </footer>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>