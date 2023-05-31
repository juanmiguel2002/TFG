<?php define('ruta', 'http://localhost/CronistaGata/'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <title>Qui soc - Cronista de Gata </title>
     <!-- Icono del navegador -->
    <link rel="shortcut icon" href="<?=ruta?>img/periodic1.jpg" type="image/jpg"/>
    <style>
        .animate__animated {
        animation-duration: 2s;
        animation-fill-mode: forwards;
        }

        .animate__delay-1s {
        animation-delay: 3s;
        }

        .animate__fadeInLeft {
        animation-name: fadeInLeft;
        }

        .animate__fadeInRight {
        animation-name: fadeInRight;
        }

        @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
        }

        @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
        }
    </style>
</head>

<body>
    <div class="container">
    <div class="row">
      <div class="col-12 text-center mt-3">
        <div class="col-1">
            <a href="javascript:history.back()" class="btn btn-light">
            volver
            </a>
        </div>
       
        <h1 class="animate__animated animate__fadeIn">Qui soc</h1>
        <hr>
      </div>
    </div>

        <div class="row">
            <div class="col-md-6 animate__animated animate__fadeInLeft">
                <img src="<?=ruta?>img/fotoperfil.jpg" alt="Perfil" class="img-fluid rounded-circle">
            </div>
            <div class="col-md-6 animate__animated animate__fadeInRight">
                <h2>Miguel Vives Signes</h2>
                <h4>Cronista de Gata de Gorgos</h4><br>
                <p>Soy Miguel Vives Signes, cronista oficial de Gata de Gorgos (Alicante) desde 2007. 
                    Con esta remodelación de la pàgina, del blog, pretendo aportar la història, costumbres, tradición y noticias del pueblo de la Marina Alta donde nací y vivo. </p>
                
                <p>La página va dirigida a todos los vecinos, forasteros residentes, nuevos, visitantes y curiosos de las redes, 
                    para que puedan seguir los testimonios más directos de lo que un día fue y lo que hoy es Gata.</p>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>