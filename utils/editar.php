<?php

  require_once '../database/base_de_datos.php';
  require_once 'classes/articulo.php';

  $titulo = "";
  $temes = "";
  $exito = "";
  $error = "";
  $texto = "";

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sentencia = $pdo->prepare("SELECT * from v_articulos where id = :id"); // SELECCIONAMOS EL ARTICULO PASADO POR EL ID.
    $sentencia->bindParam(':id', $id);
    $sentencia->execute();
    $articulos = $sentencia->fetchAll(PDO::FETCH_CLASS, 'articulo');
  
    if (count($articulos) > 0) {//comprobamos si los datos estan actualizados correctamente
      $articulo = $articulos[0];
      $titulo = $articulo->getTitulo(); // RECOGEMOS EL TITULO DE LA BBDD 
      $temes = $articulo->getFk_temas(); // RECOGEMOS EL ID DE TEMAS DE LA BBDD 
  
      if (isset($_POST['subir'])) { // Comprobamos si se ha pulsado el botón de enviar
        $nuevoTitulo = $_POST['titulo'];
        $nuevoTexto = $_POST['texto'];
  
        if (isset($_SESSION['borrador'])) { // Comprobamos si el borrador existe 
          $borrador = 0;
        }
  
        $sentencia = $pdo->prepare("UPDATE articulos SET titulo = :titulo, texto = :texto, borrador = :borrador WHERE id = :id");
        $sentencia->bindParam(':titulo', $nuevoTitulo);
        $sentencia->bindParam(':texto', $nuevoTexto);
        $sentencia->bindParam(':borrador', $borrador);
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();
  
        if ($sentencia->rowCount() > 0) {
          $exito = "Datos actualizados correctamente";
          header('Location: ../views/articulo.view.php?id=' . $id);
          exit;
        } else {
          $error = "No se pudieron actualizar los datos";
        }
      } else {
        $error = "Por favor, edita el artículo";
      }
    } else {
      $error = "El artículo con ID $id no existe";
    }
  } else {
    $error = "No se ha proporcionado un ID de artículo";
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Article</title>
  <!-- Icono del navegador -->
  <link rel="shortcut icon" href="../img/periodic1.jpg" type="image/jpg"/>
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
      <div class="card-header">
        <a class="btn btn-primary" href="panelControl.php" role="button">Atras</a>
        Editar Artículo
      </div>
      <div class="card-body">
        <?php if ($error) : ?>
          <div class="alert alert-danger" role="alert">
            <?= $error ?>
          </div>
        <?php elseif ($exito) : ?>
          <div class="alert alert-success" role="alert">
            <?= $exito ?>
          </div>
        <?php endif ?>
        <form action="" method="POST">
          <div class="mb-3 row">
            <label for="titulo" class="col-sm-2 col-form-label">Título</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $titulo ?>">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="temes" class="col-sm-2 col-form-label">Temas</label>
            <div class="col-sm-10">
              <select class="form-control" name="temes" id="temes">
                <option value="">- Selecciona -</option>
                <?php 
                $sentencia = $pdo->query("SELECT * FROM temas");
                $sentencia->execute();
                $temas = $sentencia->fetchAll(PDO::FETCH_CLASS, 'articulo');
                foreach ($temas as $tema) : ?>
                  <option value="<?= $tema->getId() ?>" <?php if ($temes == $tema->getId()) echo "selected" ?>><?= $tema->getTema() ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="texto" class="col-sm-2 col-form-label">Descripción</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="texto" name="texto" rows="3"><?= $articulo->getTexto() ?></textarea>
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
    selector: 'textarea#texto',
    plugins: 'image code',
    toolbar: 'undo redo | blocks | ' +
    'bold italic backcolor | alignleft aligncenter ' +
    'alignright alignjustify | bullist numlist outdent indent | ' +
    'removeformat | help',
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