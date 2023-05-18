<?php
    require_once '../database/base_de_datos.php';

    $titulo = '';
    $exito = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'];
        $sentencia = $pdo->prepare("INSERT INTO temas VALUES (DEFAULT, :titulo)"); 
        $sentencia->bindParam(':titulo', $titulo);
        if ($sentencia->execute() === false) {
            $error = "Error al insertar datos.";
        } else {
            $exito = "Datos ingresados correctamente.";
            sleep(5);
            header('Location: temas.php'); 
        }
    }    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nou Artícle</title>
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
            <div class="card-header"><a class="btn btn-primary" href="javascript:history.back();" role="button">Atras</a>
                Escriu un nou Tema 
            </div>
            <div class="card-body">
                <?php
                if ($exito) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $exito ?>
                    </div>
                <?php } ?>

                <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-4 row">
                        <label for="titol" class="col-sm-2 col-form-label">Títul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $titulo ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <a class="btn btn-primary" href="javascript:history.back();" role="button">Atras</a>
                        <input type="submit" name="subir" value="Publicar" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>