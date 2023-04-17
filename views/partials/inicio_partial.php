<?php define('ruta','http://localhost/CronistaGata/'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Cronista de Gata de Gorgos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?=ruta?>css/style.css" rel="stylesheet" type='text/css'/>
  <link href="<?=ruta?>css/menu.css" rel="stylesheet" type='text/css'/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="<?=ruta?>img/periodic1.jpg" type="image/jpg"/>

</head>
<body>
  <header>
    <h1 class="titulo">Cronista de Gata de Gorgos</h1>
  </header>
  <nav class="navbar">
    <a class="navbar-brand" href="<?=ruta?>index.php"><img class="logo" src="<?=ruta?>img/logo1.png" width="69" alt="CronistadeGata"/></a>	
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
      aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="fa fa-bars"></span> Menu
    </button>
    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav">
        <li class="nav-item active"><a href="<?=ruta?>index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Destacats</a></li>
        <li class="nav-item"><a href="<?=ruta?>views/contacto.view.php" class="nav-link">Contacte</a></li>
        <li class="nav-item right"><a href="views/login.view.php" class="nav-link">Admin</a></li>
      </ul>                            
    </div>
  </nav>
  <a class="ir-arriba" javascript:void(0) title="Volver arriba">
    <span class="fa-stack">
      <i class="fa fa-circle fa-stack-2x"></i>
      <i class="fa fa-arrow-up fa-stack-1x fa-inverse"></i>
    </span>
    
  </a>
  <script src="<?=ruta?>js/jquery.min.js"></script>
	<script src="<?=ruta?>js/popper.js"></script>
	<script src="<?=ruta?>js/bootstrap.min.js"></script>
	<script src="<?=ruta?>js/main.js"></script>