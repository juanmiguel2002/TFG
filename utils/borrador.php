<?php
    require_once '../database/base_de_datos.php';

    // Marcar el artículo con ID 1 como borrador
    $id = $_GET['id'];
    $sql = "UPDATE artículos SET borrador = 1 WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $exito = "El artículo ha sido marcado como borrador.";
?>