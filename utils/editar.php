<?php
define('ruta', 'http://localhost/CronistaGata/');
include '../utils/acciones.php';
require_once '../database/base_de_datos.php';
require_once 'classes/articulo.php';

// $titulo = "";
$temes = "";
$exito = "";
$error = "";
$texto = "";

if (!isset($_POST['id'])) {
  $id = $_GET['id'];
  $sentencia = $pdo->prepare("SELECT * from v_articulos where id = '$id'"); //SELECCIONAMOS TODOS LOS TEMAS.
  $sentencia->execute();
  $articulos = $sentencia->fetchAll(PDO::FETCH_CLASS, 'articulo');
  $titulo = $articulos[0]->getTitulo();

}


if (isset($_POST['subir'])) { //comprobamos si ha apretado el boton de enviar 

  $titulo = $_POST['titulo'];
  $temes = $_POST['temes'];
  $texto = $_POST['texto'];
  $sentencia = $pdo->prepare("UPDATE v_articulos set titulo = '$titulo', texto='$texto' where id = '$id'");
  $sentencia->execute();

  if ($sentencia) {
    $exito = "Datos actualizados correctamente";
    header('Location:'. ruta);
  } else {
    $error  = "No se pudieron actualizar los datos";
  }
} else {
  $error = "Por favor ingresa todos los datos";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Datos del Empleado</title>
  <link href="../css/panelc.css" rel="stylesheet" type='text/css' />
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
  <header>
    <div class="mx-auto">
      <!-- untuk memasukkan data -->
      <div class="card">
        
        <div class="card-header">
          Editar Artícle
        </div>
        <div class="card-body">
          <?php if ($error) : ?>
            <div class="alert alert-danger" role="alert">
              <?= $error ?>
            </div>
          <?php else : ?>
            <div class="alert alert-success" role="alert">
              <?= $exito ?>
            </div>
          <?php endif ?>
          <form action="" method="POST">
            <div class="mb-3 row">
              <label for="Títol" class="col-sm-2 col-form-label">Títul</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $titulo ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="temas" class="col-sm-2 col-form-label">Temes</label>
              <div class="col-sm-10">
                <select class="form-control" name="temes" id="temes">
                  <option value="">- Selecciona -</option>
                  <option value="<?= $articulos[0]->getTema() ?>" <?php if ($articulos[0]->getTema()) echo "selected" ?>><?= $articulos[0]->getTema() ?></option>
                </select>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="direccion" class="col-sm-2 col-form-label">Descripción</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="texto" name="texto" rows="3" value="<?= $articulos[0]->getTexto() ?>"> <?= $articulos[0]->getTexto() ?> </textarea>
              </div>
            </div>

            <div class="col-12">
              <input type="submit" name="subir" value="Aceptar" class="btn btn-primary" />
            </div>
          </form>
        </div>
        </div>
      </div>
    </div>
</body>

<script src="https://cdn.tiny.cloud/1/t2537jv6fs00yo0ry56l6ry7mb53wmv1bydm5ruxsslormaa/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: 'textarea#texto',
    plugins: 'image code',
    toolbar: 'undo redo | link image | code',
    /* enable title field in the Image dialog*/
    image_title: true,
    /* enable automatic uploads of images represented by blob or data URIs*/
    automatic_uploads: true,
    /*
      URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
      images_upload_url: 'postAcceptor.php',
      here we add custom filepicker only to Image dialog
    */
    file_picker_types: 'upload',
    /* and here's our custom image picker*/
    file_picker_callback: (cb, value, meta) => {
      const input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.setAttribute('accept', 'image/*');

      input.addEventListener('change', (e) => {
        const file = e.target.files[0];

        const reader = new FileReader();
        reader.addEventListener('load', () => {
          /*
            Note: Now we need to register the blob in TinyMCEs image blob
            registry. In the next release this part hopefully won't be
            necessary, as we are looking to handle it internally.
          */
          const id = 'blobid' + (new Date()).getTime();
          const blobCache = tinymce.activeEditor.editorUpload.blobCache;
          const base64 = reader.result.split(',')[1];
          const blobInfo = blobCache.create(id, file, base64);
          blobCache.add(blobInfo);

          /* call the callback and populate the Title field with the file name */
          cb(blobInfo.blobUri(), {
            title: file.name
          });
        });
        reader.readAsDataURL(file);
      });

      input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
  });
</script>

</html>