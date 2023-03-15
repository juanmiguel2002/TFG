<?php
    require_once 'views/partials/inicio_partial.php';
    require_once 'database/Connection.php';
    require_once 'utils/classes/articulo.php';

    try {
        $connection = Connection::make();

        $sql = "SELECT id,titulo,fecha, concat(substr(texto,1,255),'...') as texto,tema,imagen
        FROM v_articulos
        order by 1
        limit 1000";
        
        $pdoStatment = $connection->prepare($sql);
        
        if($pdoStatment->execute() === false){
            echo "No se ha podido acceder a la BBDD";
        }else{
            $articulos = $pdoStatment->fetchAll(PDO::FETCH_CLASS,'articulo');
        }

        include 'views/articulos.view.php';

    }catch(Exception $e){
        echo $e->getMessage();
    }
    require_once 'views/partials/fin_partial.php';
    //
?>