<?php
  require '../database/base_de_datos.php';

$buscador = $pdo->prepare("SELECT fecha, titulo from articulos where texto like Lower('%".$_POST["buscar"]."%') OR titulo Like Lower('%".$_POST["buscar"]."%')");
$buscador->execute();
$num = $buscador->rowCount();
// if (!empty($_POST)) {
//   $buscar = explode(" ", $_POST['q']);

//   $stmt = $pdo->prepare("SELECT * FROM articulos WHERE titulo LIKE '%" . $buscar[0] . "%'");
//   $stmt->execute();

//   echo "<br>Has buscat la paraula:<b> " . $_POST['q'] . "</b>";

//   if ($stmt->rowCount() > 0) { 
//     echo "<br><br>Resultados encontrados: <br>";
//     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//       echo "<tr><td>" . $row['fecha'] . " </td>
//             <td>" . $row['titulo'] . "</td>
//       ";
//       echo '<td>
//         <a href="'. ruta.'/utils/editar.php?id='. $row['id'] .'"><button type="button" class="btn btn-warning">Editar</button></a>
//         <a href="'. ruta.'/utils/eliminar.php?id='.  $row['id'] .'" onclick="return confirm("Vols eliminar l`article?")"><button type="button" class="btn btn-danger">Eliminar</button></a>      
//         </td>
//       </tr>';
//     }
//   } else {
//     echo "<br>Resultados encontrados: Ninguno";
//   }
//   }
$i = 1;
?>
<h5 class="card-title">Resultados encontrados (<?= $num ?>)</h5>

<?php while($resultado = $buscador->fetch(PDO::FETCH_ASSOC)) { ?>
  <tr>
    <td><?=$i++?></td>
    <td><?=$resultado['fecha']?></td>
    <td><?=$resultado['titulo']?></td>
    <td>
      <!-- <a href="<?=ruta?>/utils/editar.php?id=<?= $articulo->getId() ?>"><button type="button" class="btn btn-warning">Editar</button></a>
      <a href="<?=ruta?>/utils/eliminar.php?id=<?=  $articulo->getId() ?>" onclick="return confirm('Vols eliminar l`article?')"><button type="button" class="btn btn-danger">Eliminar</button></a>       -->
    </td>
  </tr>
         
<?php } ?>
