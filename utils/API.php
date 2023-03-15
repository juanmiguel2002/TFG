<?php
    // Ruta a la carpeta que contiene las imágenes
    define('upload', __DIR__ . '/img/');

    // Obtener el nombre de la imagen solicitada a través de la URL
    $imageName = $_GET['image'];

    // Comprobar si la imagen existe
    if (file_exists(upload . $imageName)) {
        // Configurar la cabecera de la respuesta HTTP para indicar que se devuelve una imagen
        header('Content-Type: image/jpeg');
        header('Content-Length: ' . filesize(upload . $imageName));

        // Devolver la imagen
        readfile(upload . $imageName);
    } else {
        // Devolver un error si la imagen no existe
        header('HTTP/1.1 404 Not Found');
        echo 'Image not found';
    }
?>