<?php
/*
* Script: Cargar datos de lado del servidor con PHP y MySQL
* Autor: Marco Robles
* Team: Códigos de Programación
*/
require '../database/base_de_datos.php';

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id', 'titulo', 'fecha', 'texto', 'tema'];

$table = "v_articulos";/* Nombre de la tabla */

$id = 'id';/* id de la vista */

$campo = isset($_POST['campo']) ? $_POST['campo'] : null;

/* Filtrado */

$where = '';
if (basename(dirname(__FILE__)) == 'views') {
    $where = "WHERE titulo LIKE '%$campo%' OR fecha LIKE '%$campo%' OR tema LIKE '%$campo%'";
}else{
    $where = "WHERE (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

/* Limit */
$limit = isset($_POST['registros']) ? $_POST['registros'] : 10;
$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : 1;

$inicio = ($pagina - 1) * $limit;

$sLimit = "LIMIT $inicio , $limit";

/* Consulta */
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . "
FROM $table
$where
$sLimit";
$resultado = $pdo->query($sql);
$num_rows = $resultado->rowCount();

/* Consulta para total de registro filtrados */
$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $pdo->query($sqlFiltro);
$resFiltro->execute();
$row_filtro = $resFiltro->fetch(PDO::FETCH_NUM);
$totalFiltro = $row_filtro[0];

/* Consulta para total de registro filtrados */
$sqlTotal = "SELECT count($id) FROM $table $where";
$resTotal = $pdo->query($sqlTotal);
$resTotal->execute();
$row_total = $resTotal->fetch(PDO::FETCH_NUM);
$totalRegistros = $row_total[0];

/* Mostrado resultados */
$output = [];
$output['totalRegistros'] = $totalRegistros;
$output['totalFiltro'] = $totalFiltro;
$output['data'] = '';
$output['paginacion'] = '';

if ($num_rows > 0) {
    foreach ($resultado as $row) {
        $output['data'] .= '<div class="card">';
        $output['data'] .= '<h3>'. $row['fecha'] . " " .  $row['titulo'] . '</h3>';
        $output['data'] .= '<p>en ' . $row['tema'] . '</p>';
        $output['data'] .= '<p>' . $row['texto'] . '</p>';
        $output['data'] .= '</div>';
    }
} else {
    $output['data'] .= '<div>';
    $output['data'] .= '<p colspan="7">Sin resultados</p>';
    $output['data'] .= '</div>';
}

// PAGINACIÓN
if ($output['totalRegistros'] > 0) {
    $totalPaginas = ceil($output['totalRegistros'] / $limit);

    $output['paginacion'] .= '<nav>';
    $output['paginacion'] .= '<ul class="pagination">';

    $numeroInicio = 1;

    if(($pagina - 4) > 1){
        $numeroInicio = $pagina - 4;
    }

    $numeroFin = $numeroInicio + 9; 

    if($numeroFin > $totalPaginas){
        $numeroFin = $totalPaginas;
    }

    for ($i = $numeroInicio; $i <= $numeroFin; $i++) {
        if ($pagina == $i) {
            $output['paginacion'] .= '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            $output['paginacion'] .= '<li class="page-item"><a class="page-link" href="#" onclick="nextPage(' . $i . ')">' . $i . '</a></li>';
        }
    }

    $output['paginacion'] .= '</ul>';
    $output['paginacion'] .= '</nav>';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);