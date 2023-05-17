<?php 
    require_once '../database/base_de_datos.php';
    $id = $_GET['id'];
    $sentencia = $pdo->prepare("SELECT COUNT(*) as total FROM articulos");
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
    $total = $resultado['total'];
    if (!is_numeric($id) || $id < 1 || $id <= $total) {
        header("HTTP/1.0 404 Not Found");
        include("404.php");
        exit();
    }else{

        $sentencia = $pdo->prepare("DELETE from articulos where id = '$id'");
        $sentencia->execute();

        // Crear la sentencia SQL para actualizar el valor del contador de identificación
        $sql = "ALTER TABLE articulos AUTO_INCREMENT = 14157";

        // Ejecutar la sentencia SQL
        $pdo->exec($sql);
        header('Location: panelControl.php');
        exit();
    }  
?>