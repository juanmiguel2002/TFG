<?php
define('ruta', 'http://localhost/CronistaGata/');

require_once '../database/base_de_datos.php';
require_once 'classes/articulo.php';
require 'classes/File.php';

$titulo = "";
$temes = "";
$exito = "";
$error = "";
$texto = "";
$nombreImagen = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {// nuevo articulo

  $titulo = $_POST['titulo'];
  $fk_temas = $_POST['temes'];
  $texto = $_POST['texto'];
  $borrador = $_POST['borrador'] ? $borrador = 1 : 0;//recogemos el boton de borrador.
  // $borrador = 1;
  try{
    if ($_FILES['imagen']['tmp_name'] != ""){
      $imagen = new File('imagen');//llamamos a la clase File y le pasamos los datos
      $imagen->saveUploadFile('../upload/');// Asignamos la ruta donde se almacenará la img
      $nombreImagen = $imagen->getFileName();
    }
  }catch (FileException $fileException) {
    $error = $fileException->getMessage();
  }

  $fecha = date('Y-m-d');
  $sentencia = $pdo->prepare("INSERT INTO articulos (titulo, fecha, texto, imagen, fk_temas, borrador) VALUES (:titulo, :fecha, :texto, :imagen, :fk_temas,:borrador)");
  $sentencia->bindParam(':titulo', $titulo);
  $sentencia->bindParam(':texto', $texto);
  $sentencia->bindParam(':fecha', $fecha);
  $sentencia->bindParam(':imagen', $nombreImagen);
  $sentencia->bindParam(':fk_temas', $fk_temas);
  $sentencia->bindParam(':borrador', $borrador);

  if ($sentencia->execute() === false) {
    $error = "Error al insertar datos.";
  } else {
    $exito = "Datos ingresados correctamente.";
    header('Location:' . "panelControl.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Article</title>
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
  <header>
    <div class="mx-auto">
      <!-- untuk memasukkan data -->
      <div class="card">

        <div class="card-header"><a class="btn btn-primary" href="javascript:history.back();" role="button">Atras</a>
          Editar Artícle
        </div>
        <div class="card-body">
          
          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <!-- <input type="hidden" name="id" value="<?=""//$id ?>"> id que le pasamos para recoger en el post -->
            <div class="mb-3 row">
              <label for="Títol" class="col-sm-2 col-form-label">Títul</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $titulo ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="temas" class="col-sm-2 col-form-label">Temas</label>
              <div class="col-sm-10">
                <select class="form-control" name="temes" id="temes">
                  <option value="">- Selecciona -</option>
                  <?php
                  $sentencia = $pdo->query("SELECT * FROM temas");
                  $sentencia->execute();
                  $temas = $sentencia->fetchAll(PDO::FETCH_CLASS, 'articulo');
                  foreach ($temas as $tema) :
                  ?>
                    <option value="<?= $tema->getId() ?>" <?php if ($temes == $tema->getId()) echo "selected" ?>><?= $tema->getTema() ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="imagen" class="col-sm-2 col-form-label">Imatge</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="imagen" value="<?= $nombreImagen ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="direccion" class="col-sm-2 col-form-label">Descripción</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="texto" name="texto" rows="3" value="<?= $texto ?>"> <?= $texto ?> </textarea>
              </div>
            </div>

            <div class="col-12">
              <a class="btn btn-primary" href="javascript:history.back();" role="button">Atras</a>
              <input type="submit" name="subir" value="Publicar" class="btn btn-success" />
              <input type="submit" name="borrador" value="Borrador" class="btn btn-secondary" />
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