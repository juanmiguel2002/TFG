<?php 
    require_once '../database/base_de_datos.php';

    // $id = $_GET['id']; // seleccionamos el id del articulo
    // $sentencia = $pdo->prepare("SELECT COUNT(*) as total FROM articulos"); // hacemos un count para contar el maximo de articulos 
    // $sentencia->execute();
    // $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
    // $total = $resultado['total'];
    // if (!is_numeric($id) || $id < 1 || $id < $total) { // comprobamos que no nos pasa ninguna letra o numero por debajo de 1 y el total
    //     header("HTTP/1.0 404 Not Found");
    //     include("404.php");//llamamos a la pagina de error 
    //     exit();
    // }else{ // si no se cumple borramos el articulo con el id pasado
    //     $sentencia = $pdo->prepare("DELETE from articulos where id = '$id'");
    //     $sentencia->execute();
        
    //     header('Location: panelControl.php'); 
    // }  
    
    $id = $_GET['id'];

    $sentencia = $pdo->prepare("SELECT COUNT(*) as total FROM articulos"); // hacemos un count para contar el máximo de artículos 
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
    $total = $resultado['total'];
  
    if (!isset($_GET['op'])) {
        $sentencia = $pdo->prepare("DELETE FROM articulos WHERE id = :id");  
        header('Location: panelControl.php');             
    }else{
        $sentencia = $pdo->prepare("DELETE FROM temas WHERE id = :id");
        header('Location: temas.php'); 
        
    }
    $sentencia->bindParam(':id', $id);
    $sentencia->execute();
    exit();  

    if ((!is_numeric($id) || $id < 1 || $id > $total)) {//comprobamos que no nos pasa ninguna letra o numero por debajo de 1
        header("HTTP/1.0 404 Not Found");
        include("404.php");
        exit();
    }
?>