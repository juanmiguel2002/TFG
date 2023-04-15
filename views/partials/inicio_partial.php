<?php define('ruta','http://localhost/CronistaGata/'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Cronista de Gata de Gorgos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?=ruta?>css/style.css" rel="stylesheet" type='text/css'/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="<?=ruta?>img/periodic1.jpg" type="image/jpg"/>

</head>
<body>
  <header>
    <h1 class="titulo">Cronista de Gata de Gorgos</h1>
  </header>
  <nav class="navbar">
      <img class="logo" src="<?=ruta?>img/logo1.png" width="69" alt="Cronistadegata"/>
      <a href="<?=ruta?>index.php">Home</a>
      <a href="articulosDesta.html">Destacats</a>
      <a href="<?=ruta?>views/contacto.view.php">Contacte</a>
      <a class="right" href="views/login.view.php">Admin</a>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
  </nav>