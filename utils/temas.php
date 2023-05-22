<!-- PAGINA PARA VER, EDITAR Y AÑADIR LOS TEMAS DE LA WEB -->
<?php
  define('ruta', 'http://localhost/CronistaGata/');
  require '../database/base_de_datos.php';
  require_once '../utils/classes/articulo.php';

  // Definir las opciones del select
  $opciones = array(
    "asc" => "Ascendente",
    "desc" => "Descendente"
  );

  // Obtener la opción seleccionada
  $orden = isset($_GET["orden"]) ? $_GET["orden"] : "";

  // Comprobar si la opción es válida
  if (!array_key_exists($orden, $opciones)) {
      $orden = "";
  }

  // Construir la consulta SQL
  $sql = "SELECT * FROM temas";
  if ($orden != "") {
    $sql .= " ORDER BY id $orden";
  }

  $resultado = $pdo->query($sql);
  $temas = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Cronista de Gata de Gorgos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?= ruta ?>img/periodic1.jpg" type="image/jpg" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <header>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?= ruta ?>">CronistadeGata</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="panelControl.php" class="btn btn-default">
              <span class="glyphicon glyphicon-chevron-left"></span> Volver
            </a></li>
          <li><a href="nuevo.tema.php">Escriu nou</a></li> <!-- Podemos crear otro tema a partir de este link-->
          <li><a href="#">Temes</a></li>
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user dropdown"></span>Miguel</a>
            <ul class="dropdown-menu">
              <li><a href="#">Conter</a></li>
              <li><a href="#">Opcions</a></li>
            </ul>
          </li>
          <li><a href="CerrarSession.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- CONTENEDOR DONDE SE MOSTRARAN TODOS LOS TEMAS -->
  <div class="container">
    <div class="row">
      <div class="col-md-6">
          <a class="btn btn-primary float-left" href="nuevo.tema.php" role="button">Nuevo tema</a>
      </div>
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
                <th>ID</th>
                <th>NOMBRE</th>
                <th>Opcions</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0 ; $i< count($temas); $i++): ?>
                <tr>
                    <td><?=$temas[$i]['id']?></td>
                    <td><?=$temas[$i]['tema']?></td>
                    <td><a href="editar.tema.php?id=<?= $temas[$i]['id']?>" class="btn btn-warning" role="button">Editar</a><br>
                        <a href="eliminar.php?id=<?= $temas[$i]['id']?>&op=tema" onclick="return confirm('Vols eliminar el tema?')" class="btn btn-danger" role="button">Eliminar</a>
                        </td>
                </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>
</body>
</html>