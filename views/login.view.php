<?php
    //abres una session
    session_start();

    $hora = date('G'); 
    switch ($hora) {
    case (($hora >= 6) AND ($hora < 12)):
        $mensaje = "Bon dia";
        break;
    case (($hora >= 12) AND ($hora < 18)):
        $mensaje = "Bona vesprada"; 
        break;
    case (($hora >= 18) AND ($hora < 20)):
        $mensaje = "Bona vesprada"; 
        break;
    case (($hora >= 21) AND ($hora < 6)):
        $mensaje = "Bona Nit"; 
        break;
    }
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administració</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css"> 
</head>
  
<section class="contact-box">
    <div class="row no-gutters bg-dark">
        <div class="col-xl-5 col-lg-12 register-bg">
        <!-- contenedor de la foto -->
        </div>
        <div class="col-xl-7 col-lg-12 d-flex">
            <div class="container align-self-center p-6">
                <h1 class="font-weight-bold mb-3"><?= $mensaje?> Cronista <strong>Oficial de GATA de GORGOS</strong></h1>
                <p id="mensaje"></p>
                <form action="views/panelControl.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Correo electrónico <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" placeholder="Introdueix el teu correu" id="email">
                    </div>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Contraseña <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="contrasenya" placeholder="Ingresa una contraseña" id="pwd">
                    </div>
                    <button class="btn btn-primary" type="submit">ENTRAR</button>
                    <a class="btn btn-primary btn-lg active" href="../index.php" role="button">Atras</a>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('button').click(function(e) {
            e.preventDefault();
            
            var email = $("#email").val();
            var pwd = $("#pwd").val();
            var pattern_email = /^[a-zA-z0-9._-]+@[a-zA-z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if(pwd.length == 0 || !pattern_email.test(email)) {  //comprobamos lo que el usuario pasa
                $('#mensaje').text("Por favor, rellena todos los campos.");
            }else {
                if (email != email_repe || pwd.length < 8) {//comprobamos el email que no este repetido y la longitud de la pwd y se lo pasamos al post para enviar al otro archivo
                    $('#mensaje').text("Email no coincide y contraseña no tiene 8 caracteres");
                }else{
                    $.post("provincias.php",{

                        correo: email,
                        contrasenya: pwd,
                    },
                    function(respuesta, status) {
                        if(status == "success") {
                            $('#mensaje').text("La conexión al servidor fue correcta.");
                        }else{
                            $('#mensaje').text("Error: "+respuesta+" "+ status);
                        }
                    });
                }
            }
        });
    });
</script>