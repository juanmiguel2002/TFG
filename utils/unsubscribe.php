<?php
    define('ruta', 'http://localhost/CronistaGata/');
    require_once('../database/base_de_datos.php');
 
    if ((isset($_GET['id']) && is_numeric($_GET['id'])) || $_GET['id'] == 1) {
        $id = $_GET['id'];//recogemos el id del usuario
       // Verificar si se ha enviado el formulario
        if (isset($_POST['submit'])) {

            // Actualizar el campo "suscrito" a 0 para el usuario correspondiente
            $sentencia = $pdo->prepare("UPDATE suscriptores SET suscrito = 0 WHERE id = $id order by suscrito desc limit 1");
            $sentencia->execute();
            if ($sentencia) {
                echo '<script type="text/javascript">
                        alert("Baja OK.");
                            </script>';
                    header("Location:". ruta);
            }else{
                echo'<script type="text/javascript">
                    alert("Ha ocurrido un error, intentar de nuevo.");
                </script>';
            }
        }
    }else{
        echo '<script type="text/javascript">
            alert("ya estas dado de baja.");
            </script>';
        header("Location:". ruta);
    }
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donar-se de Baixa</title>
    <link href="../css/panelc.css" rel="stylesheet" type='text/css' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 50px;
        }

        @media (max-width: 576px) {
            .mx-auto {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <div class="card-body">
                <h3>DONAR-SE DE BAIXA</h3>
                <form action="" method="POST">
                    <div class="col-12">   
                    <a class="btn btn-primary" href="<?= ruta ?>" role="button">Atras</a>
                        <input type="submit" name="submit" value="Donar-se de baixa" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body> 
</html>

