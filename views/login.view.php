<?php
//define('ruta', 'http://localhost/CronistaGata/');
//abres una session
session_start();
// función para hacer el saludo cordial.
function buenosque($formulas)
{
    $hora = date("H");

    foreach ($formulas as $formula) {
        if ($hora > $formula[0] && $hora < $formula[1]) return $formula[2];
    }
}
$formulas = array(
    array(-1, 7, "Bona nit"),
    array(6, 15, "Bon dia"),
    array(14, 21, "Bona tarda"),
    array(20, 24, "Bona nit")
);
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administració</title>
    <!-- Icono del navegador -->
    <link rel="shortcut icon" href="../img/periodic1.jpg" type="image/jpg"/>
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
                <h1 class="font-weight-bold mb-3"><?= buenosque($formulas) ?> Cronista <strong>Oficial de GATA de GORGOS</strong></h1>
                <p id="mensaje"></p>
                <form action="../utils/panelControl.php" method="POST" enctype="multipart/form-data" id="form">
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
    var email_admin;
    var pwd_admin;
    //función que lee los usuarios para acceder al sitio.
    async function leerUsuarios() {
        const response = await fetch("../json/user_admin.json");//duta donde estan las claves para entrar.
        datos = await response.json();

        email_admin = datos.user;
        pwd_admin = datos.pwd;
    }
    
    leerUsuarios();

    //validación por parte del cliente.
    $(document).ready(function() {
        $('button').click(function(e) {
            e.preventDefault();

            var email = $("#email").val();
            var pwd = $("#pwd").val();
            var pattern_email = /^[a-zA-z0-9._-]+@[a-zA-z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if (pwd.length == 0 || !pattern_email.test(email)) { //comprobamos lo que el usuario pasa
                $('#mensaje').text("Por favor, rellena todos los campos.");
            } else if (pwd.length < 8) { //comprobamos la longitud de la contraseña
                $('#mensaje').text("Contraseña no tiene 8 caracteres");
            } else if ((email != email_admin) || (pwd != pwd_admin)) {//comprobamos la contraseña y el email
                $('#mensaje').text("Email o contraseña no coinciden");
            } else {
                $('#form').submit();
            }
        });
    });
</script>