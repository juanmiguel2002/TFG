<?php
  define('ruta', 'http://localhost/CronistaGata/');
  require '../database/base_de_datos.php';

  // Definir las opciones del select
  $opciones = array(
    "0" => "No suscritos",
    "1" => "Suscrito"
  );

  // Obtener la opción seleccionada
  $orden = isset($_GET["orden"]) ? $_GET["orden"] : "";
  
  // Comprobar si la opción es válida
  if (!array_key_exists($orden, $opciones)) {
      $orden = "";
  }

  // Construir la consulta SQL
  $sql = "SELECT * FROM suscriptores ";
  if ($orden != "") {
    $sql .= " where suscrito = $orden";
  }

  $resultado = $pdo->query($sql);
  $suscriptores = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <title>Cronista de Gata de Gorgos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?= ruta ?>css/panelc.css" rel="stylesheet" type='text/css' />
  <link rel="shortcut icon" href="<?= ruta ?>img/periodic1.jpg" type="image/jpg" />
  <!-- Links a fonts y Bootstrap -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">  
</head>

<body style="padding-bottom:4px;align-items:center">
  <header>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?= ruta?>">CronistadeGata</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="panelControl.php">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user dropdown"></span> Miguel</a>
          </li>
          <li><a href="CerrarSession.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- CONTENEDOR DONDE SE MOSTRARAN TODOS LOS ARTICULOS -->
  <div class="container">    
    <div class="row">
      <div class="col-md-6">
        <form class="form-inline float-right">
            <div class="form-group">
              <label for="orden">Ordenar por:</label>
              <select name="orden" id="orden" class="form-control ml-2" onchange="this.form.submit()">
                  <option value="">Seleccione una opción</option>
                  <?php foreach ($opciones as $valor => $texto): ?>
                      <option value="<?php echo $valor; ?>" <?php if ($orden == $valor) echo "selected"; ?>>
                          <?php echo $texto; ?>
                      </option>
                  <?php endforeach; ?>
              </select>
            </div>
        </form>
      </div>
    </div>
    <table class="table table-responsive">
      <thead>
          <tr>
              <th>id</th>
              <th>Nom</th>
              <th>Correu</th>
              <th>Fecha</th>
          </tr>
      </thead>
      <tbody>
      <?php for ($i = 0 ; $i< count($suscriptores); $i++): $fecha = isset($suscriptores[$i]['fecha']) ? date('d-m-Y', strtotime($suscriptores[$i]['fecha'])) : "";?>
        <tr>
          <td><?=$suscriptores[$i]['id']?></td>
          <td><?=$suscriptores[$i]['nombre']?></td>
          <td><?=$suscriptores[$i]['email']?></td>
          <td><?= $fecha ?></td>
        </tr>
      <?php endfor;?>
      </tbody>
    </table>
  </div>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>