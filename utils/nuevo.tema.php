<?php
    require_once '../database/base_de_datos.php';

    $titulo = '';

    try {
        
        if ($titulo !== "" && $temes !== "") {
            $titulo = $_POST['titulo'];
            $fk_temas = $_POST['temes'];
            $texto = $_POST['texto'];
            $fecha = date('Y-m-d');
            $tiposAceptados = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];//le pasamos los tipos aceptados que queremos subir
            $imagen = new File('imagen', $tiposAceptados);//llamamos a la clase File y le pasamos los datos

            $imagen->saveUploadFile('../upload/');// Asignamos la ruta donde se almacenará la img
            $nombreImagen = $imagen->getFileName();//asignamos el nombre de la imagen
            
            $sentencia = $pdo->prepare("INSERT INTO articulos (titulo, fecha, texto, imagen, fk_temas) VALUES (:titulo, :fecha, :texto, :imagen, :fk_temas)"); 
            
            $paraneters = [':titulo' => $titulo, ':fecha' => $fecha, ':texto' => $texto, ':imagen' => $nombreImagen, ':id' => $fk_temas];

            if ($sentencia->execute($paraneters) === false) {
                $error = "Error al insertar datos.";
            } else {
                $exito = "Datos ingresados correctamente.";
                header('Location:'."../views/articulo.view.php?id=". $fk_temas);
            }
        } else {
            $error = "Por favor ingresa todos los datos.";
        }   
            
    } catch (FileException $fileException) {
        $error = $fileException->getMessage();
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
                if (isset($error)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    //header("refresh:5;url=index.php"); //5 : detik
                }elseif ($exito) { ?>
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

<script src="https://cdn.tiny.cloud/1/t2537jv6fs00yo0ry56l6ry7mb53wmv1bydm5ruxsslormaa/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
    selector: 'textarea#texto'
    // plugins: 'image code',
    // toolbar: 'undo redo | link image | code',
    // /* enable title field in the Image dialog*/
    // image_title: true,
    // /* enable automatic uploads of images represented by blob or data URIs*/
    // automatic_uploads: true,
    // /*
    //   URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
    //   images_upload_url: 'postAcceptor.php',
    //   here we add custom filepicker only to Image dialog
    // */
    // file_picker_types: 'upload',
    // /* and here's our custom image picker*/
    // file_picker_callback: (cb, value, meta) => {
    //   const input = document.createElement('input');
    //   input.setAttribute('type', 'file');
    //   input.setAttribute('accept', 'image/*');

    //   input.addEventListener('change', (e) => {
    //     const file = e.target.files[0];

    //     const reader = new FileReader();
    //     reader.addEventListener('load', () => {
    //       /*
    //         Note: Now we need to register the blob in TinyMCEs image blob
    //         registry. In the next release this part hopefully won't be
    //         necessary, as we are looking to handle it internally.
    //       */
    //       const id = 'blobid' + (new Date()).getTime();
    //       const blobCache = tinymce.activeEditor.editorUpload.blobCache;
    //       const base64 = reader.result.split(',')[1];
    //       const blobInfo = blobCache.create(id, file, base64);
    //       blobCache.add(blobInfo);

    //       /* call the callback and populate the Title field with the file name */
    //       cb(blobInfo.blobUri(), {
    //         title: file.name
    //       });
    //     });
    //     reader.readAsDataURL(file);
    //   });

    //   input.click();
    // },
    // content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
  });
</script>

</html>